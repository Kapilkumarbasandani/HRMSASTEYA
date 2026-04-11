<?php
namespace Leaves\User\Api;

use Classes\BaseService;
use Classes\IceResponse;
use Classes\SubActionManager;
use Leaves\Admin\Api\LeaveUtil;
use Leaves\Common\Model\EmployeeLeave;
use Leaves\Common\Model\EmployeeLeaveDay;
use Leaves\Common\Model\EmployeeLeaveLog;
use Leaves\Common\Model\LeavePeriod;
use Leaves\Common\Model\LeaveType;

class LeavesActionManager extends SubActionManager
{
    public function applyLeave($req)
    {
        $employee = BaseService::getInstance()->getCurrentProfileId();

        $leaveType = new LeaveType();
        $leaveType->Load('id = ?', array($req->leave_type));
        if (empty($leaveType->id)) {
            return new IceResponse(IceResponse::ERROR, 'Invalid leave type');
        }

        $leavePeriod = new LeavePeriod();
        $leavePeriod->Load('id = ?', array($req->leave_period));
        if (empty($leavePeriod->id)) {
            return new IceResponse(IceResponse::ERROR, 'Invalid leave period');
        }

        // Validate dates within leave period
        if ($req->date_start < $leavePeriod->date_start || $req->date_end > $leavePeriod->date_end) {
            return new IceResponse(IceResponse::ERROR, 'Leave dates must be within the selected leave period');
        }

        $leave = new EmployeeLeave();
        $leave->employee = $employee;
        $leave->leave_type = $req->leave_type;
        $leave->leave_period = $req->leave_period;
        $leave->date_start = $req->date_start;
        $leave->date_end = $req->date_end;
        $leave->details = isset($req->details) ? $req->details : '';
        $leave->status = 'Pending';
        $ok = $leave->Save();

        if (!$ok) {
            return new IceResponse(IceResponse::ERROR, 'Error saving leave application');
        }

        // Save leave days
        if (isset($req->days) && is_array($req->days)) {
            foreach ($req->days as $day) {
                $leaveDay = new EmployeeLeaveDay();
                $leaveDay->employee_leave = $leave->id;
                $leaveDay->leave_date = $day->leave_date;
                $leaveDay->leave_type = $day->leave_type;
                $leaveDay->Save();
            }
        } else {
            // Auto-generate leave days (full days between start and end)
            $start = strtotime($req->date_start);
            $end = strtotime($req->date_end);
            for ($date = $start; $date <= $end; $date = strtotime('+1 day', $date)) {
                $dateStr = date('Y-m-d', $date);
                $dayName = date('l', $date);
                $leaveUtil = new LeaveUtil();
                if ($leaveUtil->isWorkDay($dayName) && !$leaveUtil->isHoliday($dateStr)) {
                    $leaveDay = new EmployeeLeaveDay();
                    $leaveDay->employee_leave = $leave->id;
                    $leaveDay->leave_date = $dateStr;
                    $leaveDay->leave_type = 'Full Day';
                    $leaveDay->Save();
                }
            }
        }

        // Log
        $log = new EmployeeLeaveLog();
        $log->employee_leave = $leave->id;
        $log->user_id = BaseService::getInstance()->getCurrentUser()->id;
        $log->data = 'Leave application submitted';
        $log->status_from = 'Pending';
        $log->status_to = 'Pending';
        $log->created = date('Y-m-d H:i:s');
        $log->Save();

        return new IceResponse(IceResponse::SUCCESS, $leave);
    }

    public function getLeaveEntitlement($req)
    {
        $employee = BaseService::getInstance()->getCurrentProfileId();
        $leaveUtil = new LeaveUtil();

        $leaveTypes = $leaveUtil->getAvailableLeaveTypes();
        $currentPeriod = $leaveUtil->getCurrentLeavePeriod();

        if (!$currentPeriod) {
            return new IceResponse(IceResponse::ERROR, 'No active leave period found');
        }

        $entitlements = [];
        foreach ($leaveTypes as $lt) {
            $entitled = $leaveUtil->getEmployeeLeaveEntitlement($employee, $lt->id, $currentPeriod->id);
            $used = $leaveUtil->getEmployeeLeaveDayCount($employee, $lt->id, $currentPeriod->id);
            $entitlements[] = [
                'leave_type_id' => $lt->id,
                'leave_type' => $lt->name,
                'entitled' => $entitled,
                'used' => $used,
                'available' => $entitled - $used,
            ];
        }

        return new IceResponse(IceResponse::SUCCESS, $entitlements);
    }

    public function cancelLeave($req)
    {
        $employee = BaseService::getInstance()->getCurrentProfileId();
        $leave = new EmployeeLeave();
        $leave->Load('id = ? and employee = ?', array($req->id, $employee));

        if (empty($leave->id)) {
            return new IceResponse(IceResponse::ERROR, 'Leave not found');
        }

        if ($leave->status !== 'Pending' && $leave->status !== 'Approved') {
            return new IceResponse(IceResponse::ERROR, 'Only pending or approved leaves can be cancelled');
        }

        $oldStatus = $leave->status;
        if ($leave->status === 'Approved') {
            $leave->status = 'Cancellation Requested';
        } else {
            $leave->status = 'Cancelled';
        }
        $leave->Save();

        $log = new EmployeeLeaveLog();
        $log->employee_leave = $leave->id;
        $log->user_id = BaseService::getInstance()->getCurrentUser()->id;
        $log->data = 'Leave cancellation requested';
        $log->status_from = $oldStatus;
        $log->status_to = $leave->status;
        $log->created = date('Y-m-d H:i:s');
        $log->Save();

        return new IceResponse(IceResponse::SUCCESS, $leave);
    }
}

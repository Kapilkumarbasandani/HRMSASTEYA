<?php
namespace Leaves\Admin\Api;

use Classes\BaseService;
use Classes\IceResponse;
use Classes\SubActionManager;

class LeavesActionManager extends SubActionManager
{
    public function getLeaveDaysForLeave($req)
    {
        $leaveId = $req->id;
        $leaveDay = new \Leaves\Common\Model\EmployeeLeaveDay();
        $days = $leaveDay->Find('employee_leave = ?', array($leaveId));
        return new IceResponse(IceResponse::SUCCESS, $days);
    }

    public function getLeaveEntitlement($req)
    {
        $employeeId = $req->employee;
        $leaveTypeId = $req->leave_type;
        $leavePeriodId = $req->leave_period;

        $leaveUtil = new LeaveUtil();
        $entitlement = $leaveUtil->getEmployeeLeaveEntitlement($employeeId, $leaveTypeId, $leavePeriodId);
        $used = $leaveUtil->getEmployeeLeaveDayCount($employeeId, $leaveTypeId, $leavePeriodId);

        $data = new \stdClass();
        $data->entitlement = $entitlement;
        $data->used = $used;
        $data->available = $entitlement - $used;

        return new IceResponse(IceResponse::SUCCESS, $data);
    }

    public function changeLeaveStatus($req)
    {
        $leaveId = $req->id;
        $status = $req->status;

        $leave = new \Leaves\Common\Model\EmployeeLeave();
        $leave->Load('id = ?', array($leaveId));

        if (empty($leave->id)) {
            return new IceResponse(IceResponse::ERROR, 'Leave not found');
        }

        $oldStatus = $leave->status;
        $leave->status = $status;
        $ok = $leave->Save();

        if (!$ok) {
            return new IceResponse(IceResponse::ERROR, 'Error updating leave status');
        }

        // Log the status change
        $log = new \Leaves\Common\Model\EmployeeLeaveLog();
        $log->employee_leave = $leave->id;
        $log->user_id = BaseService::getInstance()->getCurrentUser()->id;
        $log->data = "Status changed from $oldStatus to $status";
        $log->status_from = $oldStatus;
        $log->status_to = $status;
        $log->created = date('Y-m-d H:i:s');
        $log->Save();

        return new IceResponse(IceResponse::SUCCESS, $leave);
    }
}

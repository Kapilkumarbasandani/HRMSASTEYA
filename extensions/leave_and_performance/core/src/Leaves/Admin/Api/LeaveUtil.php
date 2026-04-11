<?php
namespace Leaves\Admin\Api;

use Classes\BaseService;
use Leaves\Common\Model\EmployeeLeave;
use Leaves\Common\Model\EmployeeLeaveDay;
use Leaves\Common\Model\HoliDay;
use Leaves\Common\Model\LeavePeriod;
use Leaves\Common\Model\LeaveRule;
use Leaves\Common\Model\LeaveType;
use Leaves\Common\Model\WorkDay;

class LeaveUtil
{
    public function getAvailableLeaveTypes()
    {
        $leaveType = new LeaveType();
        return $leaveType->Find('1=1 order by name');
    }

    public function getActiveLeavePeriod()
    {
        $leavePeriod = new LeavePeriod();
        $leavePeriod->Load('status = ?', array('Active'));
        if (!empty($leavePeriod->id)) {
            return $leavePeriod;
        }
        return null;
    }

    public function getActiveLeavePeriods()
    {
        $leavePeriod = new LeavePeriod();
        return $leavePeriod->Find('status = ? order by date_start desc', array('Active'));
    }

    public function getCurrentLeavePeriod()
    {
        $leavePeriod = new LeavePeriod();
        $leavePeriod->Load(
            'date_start <= ? and date_end >= ? and status = ?',
            array(date('Y-m-d'), date('Y-m-d'), 'Active')
        );
        if (!empty($leavePeriod->id)) {
            return $leavePeriod;
        }
        return null;
    }

    public function getEmployeeLeaveEntitlement($employeeId, $leaveTypeId, $leavePeriodId)
    {
        $leaveType = new LeaveType();
        $leaveType->Load('id = ?', array($leaveTypeId));
        if (empty($leaveType->id)) {
            return 0;
        }

        // Check for specific leave rule
        $leaveRule = new LeaveRule();
        $leaveRule->Load(
            'leave_type = ? and employee = ?',
            array($leaveTypeId, $employeeId)
        );

        if (!empty($leaveRule->id)) {
            return floatval($leaveRule->default_per_year);
        }

        return floatval($leaveType->default_per_year);
    }

    public function getEmployeeLeaveDayCount($employeeId, $leaveTypeId, $leavePeriodId)
    {
        $count = 0;
        $employeeLeave = new EmployeeLeave();
        $leaves = $employeeLeave->Find(
            'employee = ? and leave_type = ? and leave_period = ? and status != ?',
            array($employeeId, $leaveTypeId, $leavePeriodId, 'Rejected')
        );

        foreach ($leaves as $leave) {
            $leaveDay = new EmployeeLeaveDay();
            $days = $leaveDay->Find('employee_leave = ?', array($leave->id));
            foreach ($days as $day) {
                if ($day->leave_type === 'Full Day') {
                    $count += 1;
                } else {
                    $count += 0.5;
                }
            }
        }

        return $count;
    }

    public function isHoliday($date, $countryId = null)
    {
        $holiday = new HoliDay();
        if ($countryId) {
            $holiday->Load('dateh = ? and (country = ? or country is null)', array($date, $countryId));
        } else {
            $holiday->Load('dateh = ?', array($date));
        }
        return !empty($holiday->id);
    }

    public function isWorkDay($dayName, $countryId = null)
    {
        $workDay = new WorkDay();
        if ($countryId) {
            $workDay->Load('name = ? and (country = ? or country is null)', array($dayName, $countryId));
        } else {
            $workDay->Load('name = ?', array($dayName));
        }
        if (empty($workDay->id)) {
            return true;
        }
        return $workDay->status !== 'Non-working Day';
    }
}

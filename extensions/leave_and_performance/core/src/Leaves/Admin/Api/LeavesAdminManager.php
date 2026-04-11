<?php
namespace Leaves\Admin\Api;

use Classes\AbstractModuleManager;

class LeavesAdminManager extends AbstractModuleManager
{
    public function initializeUserClasses()
    {
    }

    public function initializeFieldMappings()
    {
        $this->addFieldMapping('LeaveRule', 'leave_type', 'LeaveType', 'id', 'name');
        $this->addFieldMapping('LeaveRule', 'employee', 'Employee', 'id', 'first_name+last_name');
        $this->addFieldMapping('LeaveRule', 'job_title', 'JobTitle', 'id', 'name');
        $this->addFieldMapping('LeaveRule', 'employment_status', 'EmploymentStatus', 'id', 'name');
        $this->addFieldMapping('LeaveRule', 'leave_group', 'LeaveGroup', 'id', 'name');
        $this->addFieldMapping('LeaveRule', 'leave_period', 'LeavePeriod', 'id', 'name');
        $this->addFieldMapping('LeaveRule', 'department', 'CompanyStructure', 'id', 'title');

        $this->addFieldMapping('EmployeeLeave', 'employee', 'Employee', 'id', 'first_name+last_name');
        $this->addFieldMapping('EmployeeLeave', 'leave_type', 'LeaveType', 'id', 'name');
        $this->addFieldMapping('EmployeeLeave', 'leave_period', 'LeavePeriod', 'id', 'name');

        $this->addFieldMapping('LeaveGroupEmployee', 'employee', 'Employee', 'id', 'first_name+last_name');
        $this->addFieldMapping('LeaveGroupEmployee', 'leave_group', 'LeaveGroup', 'id', 'name');

        $this->addFieldMapping('LeaveStartingBalance', 'employee', 'Employee', 'id', 'first_name+last_name');
        $this->addFieldMapping('LeaveStartingBalance', 'leave_type', 'LeaveType', 'id', 'name');
        $this->addFieldMapping('LeaveStartingBalance', 'leave_period', 'LeavePeriod', 'id', 'name');

        $this->addFieldMapping('HoliDay', 'country', 'Country', 'id', 'name');
        $this->addFieldMapping('WorkDay', 'country', 'Country', 'id', 'name');
    }

    public function initializeDatabaseErrorMappings()
    {
        $this->addDatabaseErrorMapping('LeaveType', 'ABORTING: ERROR', 'name', 'A Leave Type with the same name already exists');
    }

    public function setupModuleClassDefinitions()
    {
        $this->addModelClass('LeaveType');
        $this->addModelClass('LeavePeriod');
        $this->addModelClass('LeaveRule');
        $this->addModelClass('LeaveGroup');
        $this->addModelClass('LeaveGroupEmployee');
        $this->addModelClass('LeaveStartingBalance');
        $this->addModelClass('EmployeeLeave');
        $this->addModelClass('HoliDay');
        $this->addModelClass('WorkDay');
    }

    public function setupRestEndPoints()
    {
    }

    public function initialize()
    {
    }
}

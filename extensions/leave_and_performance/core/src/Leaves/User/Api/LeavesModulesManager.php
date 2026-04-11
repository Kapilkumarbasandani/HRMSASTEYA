<?php
namespace Leaves\User\Api;

use Classes\AbstractModuleManager;

class LeavesModulesManager extends AbstractModuleManager
{
    public function initializeUserClasses()
    {
        if (defined('MODULE_TYPE') && MODULE_TYPE != 'admin') {
            $this->addUserClass("EmployeeLeave");
        }
    }

    public function initializeFieldMappings()
    {
        $this->addFieldMapping('EmployeeLeave', 'employee', 'Employee', 'id', 'first_name+last_name');
        $this->addFieldMapping('EmployeeLeave', 'leave_type', 'LeaveType', 'id', 'name');
        $this->addFieldMapping('EmployeeLeave', 'leave_period', 'LeavePeriod', 'id', 'name');
    }

    public function initializeDatabaseErrorMappings()
    {
    }

    public function setupModuleClassDefinitions()
    {
    }
}

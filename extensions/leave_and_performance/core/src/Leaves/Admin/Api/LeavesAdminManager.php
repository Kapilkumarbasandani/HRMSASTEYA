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
    }

    public function initializeDatabaseErrorMappings()
    {
        $this->addDatabaseErrorMapping('Duplicate entry', 'A Leave Type with the same name already exists');
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

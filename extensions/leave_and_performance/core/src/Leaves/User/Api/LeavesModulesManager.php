<?php
namespace Leaves\User\Api;

use Classes\AbstractModuleManager;
use Classes\BaseService;

class LeavesModulesManager extends AbstractModuleManager
{
    public function initializeUserClasses()
    {
        if (defined('MODULE_TYPE') && MODULE_TYPE != 'admin') {
            $user = BaseService::getInstance()->getCurrentUser();
            if ($user->user_level !== 'Admin') {
                $this->addUserClass("EmployeeLeave");
            }
        }
    }

    public function initializeFieldMappings()
    {
    }

    public function initializeDatabaseErrorMappings()
    {
    }

    public function setupModuleClassDefinitions()
    {
        $this->addModelClass('EmployeeLeave');
    }
}

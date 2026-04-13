<?php
namespace Payroll\User\Api;

use Classes\AbstractModuleManager;

class PayrollModulesManager extends AbstractModuleManager
{
    public function initializeUserClasses()
    {
        if (defined('MODULE_TYPE') && MODULE_TYPE != 'admin') {
            $this->addUserClass("PayslipDocument");
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
    }
}

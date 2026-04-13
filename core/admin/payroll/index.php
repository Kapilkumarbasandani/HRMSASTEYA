<?php

use Classes\PermissionManager;
use Payroll\Common\Model\Payroll;
use Payroll\Common\Model\PayrollColumn;
use Payroll\Common\Model\PayrollColumnTemplate;
use Payroll\Common\Model\Deduction;
use Payroll\Common\Model\DeductionGroup;
use Payroll\Common\Model\PayslipTemplate;

$moduleName = 'payroll';
$moduleGroup = 'admin';
define('MODULE_PATH', dirname(__FILE__));
include APP_BASE_PATH.'header.php';
include APP_BASE_PATH.'modulejslibs.inc.php';
?><div class="span9">
    <ul class="nav nav-tabs" id="modTab" style="margin-bottom:0px;margin-left:5px;border-bottom: none;">
        <li class="active"><a id="tabPayroll" href="#tabPagePayroll"><?=t('Payrolls')?></a></li>
        <li><a id="tabPayrollColumn" href="#tabPagePayrollColumn"><?=t('Payroll Columns')?></a></li>
        <li><a id="tabPayrollColumnTemplate" href="#tabPagePayrollColumnTemplate"><?=t('Column Templates')?></a></li>
        <li><a id="tabDeductionGroup" href="#tabPageDeductionGroup"><?=t('Deduction Groups')?></a></li>
        <li><a id="tabDeduction" href="#tabPageDeduction"><?=t('Deductions')?></a></li>
        <li><a id="tabPayslipTemplate" href="#tabPagePayslipTemplate"><?=t('Payslip Templates')?></a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="tabPagePayroll">
            <div id="PayrollTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="PayrollForm"></div>
            <div id="PayrollFilterForm"></div>
        </div>
        <div class="tab-pane" id="tabPagePayrollColumn">
            <div id="PayrollColumnTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="PayrollColumnForm"></div>
        </div>
        <div class="tab-pane" id="tabPagePayrollColumnTemplate">
            <div id="PayrollColumnTemplateTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="PayrollColumnTemplateForm"></div>
        </div>
        <div class="tab-pane" id="tabPageDeductionGroup">
            <div id="DeductionGroupTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="DeductionGroupForm"></div>
        </div>
        <div class="tab-pane" id="tabPageDeduction">
            <div id="DeductionTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="DeductionForm"></div>
        </div>
        <div class="tab-pane" id="tabPagePayslipTemplate">
            <div id="PayslipTemplateTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="PayslipTemplateForm"></div>
        </div>
    </div>

</div>
<div id="dataGroup"></div>
<?php
$moduleData = [
    'user_level' => $user->user_level,
    'permissions' => [
        'Payroll' => PermissionManager::checkGeneralAccess(new Payroll()),
        'PayrollColumn' => PermissionManager::checkGeneralAccess(new PayrollColumn()),
        'PayrollColumnTemplate' => PermissionManager::checkGeneralAccess(new PayrollColumnTemplate()),
        'Deduction' => PermissionManager::checkGeneralAccess(new Deduction()),
        'DeductionGroup' => PermissionManager::checkGeneralAccess(new DeductionGroup()),
        'PayslipTemplate' => PermissionManager::checkGeneralAccess(new PayslipTemplate()),
    ]];
?>
<script>
  initAdminPayroll(<?=json_encode($moduleData)?>);
</script>
<?php include APP_BASE_PATH.'footer.php';?>

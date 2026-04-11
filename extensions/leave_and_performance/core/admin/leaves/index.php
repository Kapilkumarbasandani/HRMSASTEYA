<?php
use Classes\PermissionManager;

$moduleName = 'leaves';
$moduleGroup = 'admin';
define('MODULE_PATH', dirname(__FILE__));
include APP_BASE_PATH.'header.php';
include APP_BASE_PATH.'modulejslibs.inc.php';
?><div class="span9">

    <ul class="nav nav-tabs" id="modTab" style="margin-bottom:0px;margin-left:5px;border-bottom: none;">
        <li class="active"><a id="tabLeaveType" href="#tabPageLeaveType"><?=t('Leave Types')?></a></li>
        <li><a id="tabLeavePeriod" href="#tabPageLeavePeriod"><?=t('Leave Periods')?></a></li>
        <li><a id="tabLeaveRule" href="#tabPageLeaveRule"><?=t('Leave Rules')?></a></li>
        <li><a id="tabLeaveGroup" href="#tabPageLeaveGroup"><?=t('Leave Groups')?></a></li>
        <li><a id="tabLeaveGroupEmployee" href="#tabPageLeaveGroupEmployee"><?=t('Leave Group Employees')?></a></li>
        <li><a id="tabLeaveStartingBalance" href="#tabPageLeaveStartingBalance"><?=t('Starting Balance')?></a></li>
        <li><a id="tabEmployeeLeave" href="#tabPageEmployeeLeave"><?=t('Employee Leaves')?></a></li>
        <li><a id="tabHoliDay" href="#tabPageHoliDay"><?=t('Holidays')?></a></li>
        <li><a id="tabWorkDay" href="#tabPageWorkDay"><?=t('Work Days')?></a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="tabPageLeaveType">
            <div id="LeaveTypeTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="LeaveTypeForm"></div>
            <div id="LeaveTypeFilterForm"></div>
        </div>
        <div class="tab-pane" id="tabPageLeavePeriod">
            <div id="LeavePeriodTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="LeavePeriodForm"></div>
            <div id="LeavePeriodFilterForm"></div>
        </div>
        <div class="tab-pane" id="tabPageLeaveRule">
            <div id="LeaveRuleTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="LeaveRuleForm"></div>
            <div id="LeaveRuleFilterForm"></div>
        </div>
        <div class="tab-pane" id="tabPageLeaveGroup">
            <div id="LeaveGroupTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="LeaveGroupForm"></div>
        </div>
        <div class="tab-pane" id="tabPageLeaveGroupEmployee">
            <div id="LeaveGroupEmployeeTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="LeaveGroupEmployeeForm"></div>
            <div id="LeaveGroupEmployeeFilterForm"></div>
        </div>
        <div class="tab-pane" id="tabPageLeaveStartingBalance">
            <div id="LeaveStartingBalanceTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="LeaveStartingBalanceForm"></div>
            <div id="LeaveStartingBalanceFilterForm"></div>
        </div>
        <div class="tab-pane" id="tabPageEmployeeLeave">
            <div id="EmployeeLeaveTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="EmployeeLeaveForm"></div>
            <div id="EmployeeLeaveFilterForm"></div>
        </div>
        <div class="tab-pane" id="tabPageHoliDay">
            <div id="HoliDayTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="HoliDayForm"></div>
            <div id="HoliDayFilterForm"></div>
        </div>
        <div class="tab-pane" id="tabPageWorkDay">
            <div id="WorkDayTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="WorkDayForm"></div>
        </div>
    </div>

</div>
<script>
var modJsList = [];

modJsList['tabLeaveType'] = new LeaveTypeAdapter('LeaveType','LeaveType','','name');
modJsList['tabLeaveType'].setObjectTypeName('LeaveType');
modJsList['tabLeaveType'].setDataPipe(new IceDataPipe(modJsList['tabLeaveType']));

modJsList['tabLeavePeriod'] = new LeavePeriodAdapter('LeavePeriod','LeavePeriod','','date_start desc');
modJsList['tabLeavePeriod'].setObjectTypeName('LeavePeriod');
modJsList['tabLeavePeriod'].setDataPipe(new IceDataPipe(modJsList['tabLeavePeriod']));

modJsList['tabLeaveRule'] = new LeaveRuleAdapter('LeaveRule','LeaveRule','','leave_type');
modJsList['tabLeaveRule'].setObjectTypeName('LeaveRule');
modJsList['tabLeaveRule'].setDataPipe(new IceDataPipe(modJsList['tabLeaveRule']));

modJsList['tabLeaveGroup'] = new LeaveGroupAdapter('LeaveGroup','LeaveGroup','','name');
modJsList['tabLeaveGroup'].setObjectTypeName('LeaveGroup');
modJsList['tabLeaveGroup'].setDataPipe(new IceDataPipe(modJsList['tabLeaveGroup']));

modJsList['tabLeaveGroupEmployee'] = new LeaveGroupEmployeeAdapter('LeaveGroupEmployee','LeaveGroupEmployee','','leave_group');
modJsList['tabLeaveGroupEmployee'].setObjectTypeName('LeaveGroupEmployee');
modJsList['tabLeaveGroupEmployee'].setDataPipe(new IceDataPipe(modJsList['tabLeaveGroupEmployee']));

modJsList['tabLeaveStartingBalance'] = new LeaveStartingBalanceAdapter('LeaveStartingBalance','LeaveStartingBalance','','leave_type');
modJsList['tabLeaveStartingBalance'].setObjectTypeName('LeaveStartingBalance');
modJsList['tabLeaveStartingBalance'].setDataPipe(new IceDataPipe(modJsList['tabLeaveStartingBalance']));

modJsList['tabEmployeeLeave'] = new EmployeeLeaveAdminAdapter('EmployeeLeave','EmployeeLeave','','date_start desc');
modJsList['tabEmployeeLeave'].setObjectTypeName('EmployeeLeave');
modJsList['tabEmployeeLeave'].setDataPipe(new IceDataPipe(modJsList['tabEmployeeLeave']));

modJsList['tabHoliDay'] = new HoliDayAdapter('HoliDay','HoliDay','','dateh desc');
modJsList['tabHoliDay'].setObjectTypeName('HoliDay');
modJsList['tabHoliDay'].setDataPipe(new IceDataPipe(modJsList['tabHoliDay']));

modJsList['tabWorkDay'] = new WorkDayAdapter('WorkDay','WorkDay','','id');
modJsList['tabWorkDay'].setObjectTypeName('WorkDay');
modJsList['tabWorkDay'].setDataPipe(new IceDataPipe(modJsList['tabWorkDay']));

var modJs = modJsList['tabLeaveType'];

</script>
<?php include APP_BASE_PATH.'footer.php';?>

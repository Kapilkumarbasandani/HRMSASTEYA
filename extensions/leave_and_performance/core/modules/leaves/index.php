<?php
use Classes\BaseService;

$moduleName = 'leaves';
$moduleGroup = 'modules';
define('MODULE_PATH', dirname(__FILE__));
include APP_BASE_PATH.'header.php';
include APP_BASE_PATH.'modulejslibs.inc.php';

$employeeId = BaseService::getInstance()->getCurrentProfileId();
?><div class="span9">

    <ul class="nav nav-tabs" id="modTab" style="margin-bottom:0px;margin-left:5px;border-bottom: none;">
        <li class="active"><a id="tabEmployeeLeave" href="#tabPageEmployeeLeave"><?=t('My Leaves')?></a></li>
        <li><a id="tabSubEmployeeLeave" href="#tabPageSubEmployeeLeave"><?=t('Subordinate Leaves')?></a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="tabPageEmployeeLeave">
            <div id="EmployeeLeaveTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="EmployeeLeaveForm"></div>
            <div id="EmployeeLeaveFilterForm"></div>
        </div>
        <div class="tab-pane" id="tabPageSubEmployeeLeave">
            <div id="SubEmployeeLeaveTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="SubEmployeeLeaveForm"></div>
            <div id="SubEmployeeLeaveFilterForm"></div>
        </div>
    </div>

</div>
<script>
var modJsList = [];

modJsList['tabEmployeeLeave'] = new EmployeeLeaveAdapter('EmployeeLeave','EmployeeLeave','employee=<?=$employeeId?>','date_start desc');
modJsList['tabEmployeeLeave'].setObjectTypeName('EmployeeLeave');
modJsList['tabEmployeeLeave'].setAccess(['get','element','save','delete']);
modJsList['tabEmployeeLeave'].setDataPipe(new IceDataPipe(modJsList['tabEmployeeLeave']));

modJsList['tabSubEmployeeLeave'] = new SubordinateLeaveAdapter('EmployeeLeave','SubEmployeeLeave','','date_start desc');
modJsList['tabSubEmployeeLeave'].setRemoteTable(true);
modJsList['tabSubEmployeeLeave'].setObjectTypeName('EmployeeLeave');
modJsList['tabSubEmployeeLeave'].setAccess(['get','element','save','delete']);
modJsList['tabSubEmployeeLeave'].setDataPipe(new IceDataPipe(modJsList['tabSubEmployeeLeave']));

var modJs = modJsList['tabEmployeeLeave'];

</script>
<?php include APP_BASE_PATH.'footer.php';?>

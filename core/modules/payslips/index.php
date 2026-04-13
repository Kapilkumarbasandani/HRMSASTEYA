<?php

$moduleName = 'payslips';
$moduleGroup = 'modules';
define('MODULE_PATH', dirname(__FILE__));
include APP_BASE_PATH.'header.php';
include APP_BASE_PATH.'modulejslibs.inc.php';
?><div class="span9">
    <ul class="nav nav-tabs" id="modTab" style="margin-bottom:0px;margin-left:5px;border-bottom: none;">
        <li class="active"><a id="tabMyPayslip" href="#tabPageMyPayslip"><?=t('My Payslips')?></a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="tabPageMyPayslip">
            <div id="MyPayslipTable" class="reviewBlock" data-content="List" style="padding-left:5px;"></div>
            <div id="MyPayslipForm"></div>
        </div>
    </div>

</div>
<div id="dataGroup"></div>
<?php
$moduleData = [
    'user_level' => $user->user_level,
    'permissions' => [
        'MyPayslip' => ['get', 'element'],
    ]
];
?>
<script>
  initMyPayslips(<?=json_encode($moduleData)?>);
</script>
<?php include APP_BASE_PATH.'footer.php';?>

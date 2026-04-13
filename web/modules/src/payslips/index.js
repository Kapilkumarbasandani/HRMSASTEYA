import { MyPayslipAdapter } from './lib';
import IceDataPipe from '../../../api/IceDataPipe';

function init(data) {
  const modJsList = {};

  modJsList.tabMyPayslip = new MyPayslipAdapter('PayslipDocument', 'MyPayslip', '', 'date_added desc');
  modJsList.tabMyPayslip.setRemoteTable(true);
  modJsList.tabMyPayslip.setObjectTypeName('Payslip');
  modJsList.tabMyPayslip.setDataPipe(new IceDataPipe(modJsList.tabMyPayslip));
  modJsList.tabMyPayslip.setAccess(data.permissions.MyPayslip);

  window.modJs = modJsList.tabMyPayslip;
  window.modJsList = modJsList;
}

window.initMyPayslips = init;

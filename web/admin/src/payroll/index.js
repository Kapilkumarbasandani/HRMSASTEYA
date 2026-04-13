import {
  PayrollAdapter,
  PayrollColumnAdapter,
  PayrollColumnTemplateAdapter,
  DeductionGroupAdapter,
  DeductionAdapter,
  PayslipTemplateAdapter,
} from './lib';
import IceDataPipe from '../../../api/IceDataPipe';

function init(data) {
  const modJsList = {};

  modJsList.tabPayroll = new PayrollAdapter('Payroll');
  modJsList.tabPayroll.setRemoteTable(true);
  modJsList.tabPayroll.setObjectTypeName('Payroll');
  modJsList.tabPayroll.setDataPipe(new IceDataPipe(modJsList.tabPayroll));
  modJsList.tabPayroll.setAccess(data.permissions.Payroll);

  modJsList.tabPayrollColumn = new PayrollColumnAdapter('PayrollColumn');
  modJsList.tabPayrollColumn.setRemoteTable(true);
  modJsList.tabPayrollColumn.setObjectTypeName('Payroll Column');
  modJsList.tabPayrollColumn.setDataPipe(new IceDataPipe(modJsList.tabPayrollColumn));
  modJsList.tabPayrollColumn.setAccess(data.permissions.PayrollColumn);

  modJsList.tabPayrollColumnTemplate = new PayrollColumnTemplateAdapter('PayrollColumnTemplate');
  modJsList.tabPayrollColumnTemplate.setObjectTypeName('Column Template');
  modJsList.tabPayrollColumnTemplate.setDataPipe(new IceDataPipe(modJsList.tabPayrollColumnTemplate));
  modJsList.tabPayrollColumnTemplate.setAccess(data.permissions.PayrollColumnTemplate);

  modJsList.tabDeductionGroup = new DeductionGroupAdapter('DeductionGroup');
  modJsList.tabDeductionGroup.setObjectTypeName('Deduction Group');
  modJsList.tabDeductionGroup.setDataPipe(new IceDataPipe(modJsList.tabDeductionGroup));
  modJsList.tabDeductionGroup.setAccess(data.permissions.DeductionGroup);

  modJsList.tabDeduction = new DeductionAdapter('Deduction');
  modJsList.tabDeduction.setRemoteTable(true);
  modJsList.tabDeduction.setObjectTypeName('Deduction');
  modJsList.tabDeduction.setDataPipe(new IceDataPipe(modJsList.tabDeduction));
  modJsList.tabDeduction.setAccess(data.permissions.Deduction);

  modJsList.tabPayslipTemplate = new PayslipTemplateAdapter('PayslipTemplate');
  modJsList.tabPayslipTemplate.setObjectTypeName('Payslip Template');
  modJsList.tabPayslipTemplate.setDataPipe(new IceDataPipe(modJsList.tabPayslipTemplate));
  modJsList.tabPayslipTemplate.setAccess(data.permissions.PayslipTemplate);

  window.modJs = modJsList.tabPayroll;
  window.modJsList = modJsList;
}

window.initAdminPayroll = init;

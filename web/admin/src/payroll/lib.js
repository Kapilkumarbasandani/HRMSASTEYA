import React from 'react';
import { Tag } from 'antd';
import ReactModalAdapterBase from '../../../api/ReactModalAdapterBase';

class PayrollAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'name', 'pay_period', 'department', 'date_start', 'date_end', 'status'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Name' },
      { sTitle: 'Pay Frequency' },
      { sTitle: 'Department' },
      { sTitle: 'Start Date' },
      { sTitle: 'End Date' },
      { sTitle: 'Status' },
    ];
  }

  getTableColumns() {
    const statusColors = {
      Draft: 'default',
      Processing: 'processing',
      Processed: 'blue',
      Completing: 'orange',
      Completed: 'green',
    };
    return [
      { title: 'Name', dataIndex: 'name', sorter: true },
      { title: 'Pay Frequency', dataIndex: 'pay_period' },
      { title: 'Department', dataIndex: 'department' },
      { title: 'Start Date', dataIndex: 'date_start', sorter: true },
      { title: 'End Date', dataIndex: 'date_end', sorter: true },
      {
        title: 'Status',
        dataIndex: 'status',
        render: (text) => <Tag color={statusColors[text] || 'default'}>{text}</Tag>,
      },
    ];
  }

  getFormFields() {
    return [
      ['id', { label: 'ID', type: 'hidden' }],
      ['name', { label: 'Name', type: 'text', validation: 'none' }],
      ['pay_period', { label: 'Pay Frequency', type: 'select2', 'remote-source': ['PayFrequency', 'id', 'name'] }],
      ['department', { label: 'Department', type: 'select2', 'remote-source': ['CompanyStructure', 'id', 'title'] }],
      ['column_template', { label: 'Column Template', type: 'select2', 'remote-source': ['PayrollColumnTemplate', 'id', 'name'] }],
      ['date_start', { label: 'Start Date', type: 'date', validation: 'none' }],
      ['date_end', { label: 'End Date', type: 'date', validation: 'none' }],
      ['deduction_group', { label: 'Deduction Group', type: 'select2', 'remote-source': ['DeductionGroup', 'id', 'name'], 'allow-null': true }],
      ['payslipTemplate', { label: 'Payslip Template', type: 'select2', 'remote-source': ['PayslipTemplate', 'id', 'name'], 'allow-null': true }],
      ['columns', { label: 'Columns (JSON)', type: 'textarea' }],
      ['status', {
        label: 'Status',
        type: 'select',
        source: [
          ['Draft', 'Draft'],
          ['Processing', 'Processing'],
          ['Processed', 'Processed'],
          ['Completing', 'Completing'],
          ['Completed', 'Completed'],
        ],
      }],
    ];
  }
}

class PayrollColumnAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'name', 'colorder', 'editable', 'enabled'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Name' },
      { sTitle: 'Order' },
      { sTitle: 'Editable' },
      { sTitle: 'Enabled' },
    ];
  }

  getTableColumns() {
    return [
      { title: 'Name', dataIndex: 'name', sorter: true },
      { title: 'Order', dataIndex: 'colorder', sorter: true },
      { title: 'Editable', dataIndex: 'editable' },
      { title: 'Enabled', dataIndex: 'enabled' },
    ];
  }

  getFormFields() {
    return [
      ['id', { label: 'ID', type: 'hidden' }],
      ['name', { label: 'Name', type: 'text', validation: 'none' }],
      ['colorder', { label: 'Column Order', type: 'text', validation: 'number' }],
      ['editable', { label: 'Editable', type: 'select', source: [['Yes', 'Yes'], ['No', 'No']] }],
      ['enabled', { label: 'Enabled', type: 'select', source: [['Yes', 'Yes'], ['No', 'No']] }],
      ['default_value', { label: 'Default Value', type: 'text' }],
      ['salary_components', { label: 'Salary Components (JSON)', type: 'textarea' }],
      ['deductions', { label: 'Deductions (JSON)', type: 'textarea' }],
      ['add_columns', { label: 'Add Columns (JSON)', type: 'textarea' }],
      ['sub_columns', { label: 'Subtract Columns (JSON)', type: 'textarea' }],
      ['calculation_columns', { label: 'Calculation Columns (JSON)', type: 'textarea' }],
      ['calculation_function', { label: 'Calculation Function', type: 'textarea' }],
      ['function_type', { label: 'Function Type', type: 'select', source: [['Simple', 'Simple'], ['Advanced', 'Advanced']] }],
      ['calculation_hook', { label: 'Calculation Hook', type: 'text' }],
      ['deduction_group', { label: 'Deduction Group', type: 'select2', 'remote-source': ['DeductionGroup', 'id', 'name'], 'allow-null': true }],
    ];
  }
}

class PayrollColumnTemplateAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'name', 'columns'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Name' },
      { sTitle: 'Columns' },
    ];
  }

  getTableColumns() {
    return [
      { title: 'Name', dataIndex: 'name', sorter: true },
      { title: 'Columns', dataIndex: 'columns' },
    ];
  }

  getFormFields() {
    return [
      ['id', { label: 'ID', type: 'hidden' }],
      ['name', { label: 'Name', type: 'text', validation: 'none' }],
      ['columns', { label: 'Columns (JSON)', type: 'textarea' }],
    ];
  }
}

class DeductionGroupAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'name', 'description'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Name' },
      { sTitle: 'Description' },
    ];
  }

  getTableColumns() {
    return [
      { title: 'Name', dataIndex: 'name', sorter: true },
      { title: 'Description', dataIndex: 'description' },
    ];
  }

  getFormFields() {
    return [
      ['id', { label: 'ID', type: 'hidden' }],
      ['name', { label: 'Name', type: 'text', validation: 'none' }],
      ['description', { label: 'Description', type: 'text' }],
    ];
  }
}

class DeductionAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'name', 'deduction_group'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Name' },
      { sTitle: 'Deduction Group' },
    ];
  }

  getTableColumns() {
    return [
      { title: 'Name', dataIndex: 'name', sorter: true },
      { title: 'Deduction Group', dataIndex: 'deduction_group' },
    ];
  }

  getFormFields() {
    return [
      ['id', { label: 'ID', type: 'hidden' }],
      ['name', { label: 'Name', type: 'text', validation: 'none' }],
      ['componentType', { label: 'Component Type (JSON)', type: 'textarea' }],
      ['component', { label: 'Component (JSON)', type: 'textarea' }],
      ['payrollColumn', { label: 'Payroll Column', type: 'select2', 'remote-source': ['PayrollColumn', 'id', 'name'], 'allow-null': true }],
      ['rangeAmounts', { label: 'Range Amounts (JSON)', type: 'textarea' }],
      ['deduction_group', { label: 'Deduction Group', type: 'select2', 'remote-source': ['DeductionGroup', 'id', 'name'], 'allow-null': true }],
    ];
  }
}

class PayslipTemplateAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'name', 'status', 'created', 'updated'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Name' },
      { sTitle: 'Status' },
      { sTitle: 'Created' },
      { sTitle: 'Updated' },
    ];
  }

  getTableColumns() {
    return [
      { title: 'Name', dataIndex: 'name', sorter: true },
      {
        title: 'Status',
        dataIndex: 'status',
        render: (text) => <Tag color={text === 'Show' ? 'green' : 'default'}>{text}</Tag>,
      },
      { title: 'Created', dataIndex: 'created' },
      { title: 'Updated', dataIndex: 'updated' },
    ];
  }

  getFormFields() {
    return [
      ['id', { label: 'ID', type: 'hidden' }],
      ['name', { label: 'Name', type: 'text', validation: 'none' }],
      ['data', { label: 'Template Data (JSON)', type: 'textarea' }],
      ['status', { label: 'Status', type: 'select', source: [['Show', 'Show'], ['Hide', 'Hide']] }],
    ];
  }
}

module.exports = {
  PayrollAdapter,
  PayrollColumnAdapter,
  PayrollColumnTemplateAdapter,
  DeductionGroupAdapter,
  DeductionAdapter,
  PayslipTemplateAdapter,
};

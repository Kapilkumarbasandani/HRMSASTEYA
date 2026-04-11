import React from 'react';
import { Tag, Space } from 'antd';
import { EditOutlined, DeleteOutlined } from '@ant-design/icons';
import ReactModalAdapterBase from '../../../../../../web/api/ReactModalAdapterBase';

class LeaveTypeAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'name', 'default_per_year', 'supervisor_leave_assign', 'employee_can_apply', 'carried_forward', 'leave_accrue'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Name' },
      { sTitle: 'Days Per Year' },
      { sTitle: 'Supervisor Assign' },
      { sTitle: 'Employee Can Apply' },
      { sTitle: 'Carried Forward' },
      { sTitle: 'Accrue' },
    ];
  }

  getTableColumns() {
    return [
      { title: 'Name', dataIndex: 'name', sorter: true },
      { title: 'Days Per Year', dataIndex: 'default_per_year', sorter: true },
      { title: 'Supervisor Assign', dataIndex: 'supervisor_leave_assign' },
      { title: 'Employee Can Apply', dataIndex: 'employee_can_apply' },
      { title: 'Carried Forward', dataIndex: 'carried_forward' },
      { title: 'Accrue', dataIndex: 'leave_accrue' },
    ];
  }

  getFormFields() {
    return [
      ['id', { label: 'ID', type: 'hidden' }],
      ['name', { label: 'Name', type: 'text', validation: 'none' }],
      ['default_per_year', { label: 'Days Per Year', type: 'text', validation: 'float' }],
      ['supervisor_leave_assign', { label: 'Supervisor Can Assign', type: 'select', source: [['Yes', 'Yes'], ['No', 'No']] }],
      ['employee_can_apply', { label: 'Employee Can Apply', type: 'select', source: [['Yes', 'Yes'], ['No', 'No']] }],
      ['apply_beyond_current', { label: 'Apply Beyond Current Period', type: 'select', source: [['Yes', 'Yes'], ['No', 'No']] }],
      ['leave_accrue', { label: 'Leave Accrue', type: 'select', source: [['No', 'No'], ['Yes', 'Yes']] }],
      ['carried_forward', { label: 'Carried Forward', type: 'select', source: [['No', 'No'], ['Yes', 'Yes']] }],
      ['carried_forward_percentage', { label: 'Carried Forward %', type: 'text', validation: 'number' }],
      ['max_carried_forward_amount', { label: 'Max Carried Forward', type: 'text', validation: 'number' }],
      ['propotionate_on_joined_date', { label: 'Proportionate on Joined Date', type: 'select', source: [['No', 'No'], ['Yes', 'Yes']] }],
      ['send_notification_emails', { label: 'Send Notification Emails', type: 'select', source: [['Yes', 'Yes'], ['No', 'No']] }],
      ['leave_color', { label: 'Leave Color', type: 'text' }],
    ];
  }
}

class LeavePeriodAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'name', 'date_start', 'date_end', 'status'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Name' },
      { sTitle: 'Start Date' },
      { sTitle: 'End Date' },
      { sTitle: 'Status' },
    ];
  }

  getTableColumns() {
    return [
      { title: 'Name', dataIndex: 'name', sorter: true },
      { title: 'Start Date', dataIndex: 'date_start', sorter: true },
      { title: 'End Date', dataIndex: 'date_end', sorter: true },
      {
        title: 'Status',
        dataIndex: 'status',
        render: (text) => <Tag color={text === 'Active' ? 'green' : 'default'}>{text}</Tag>,
      },
    ];
  }

  getFormFields() {
    return [
      ['id', { label: 'ID', type: 'hidden' }],
      ['name', { label: 'Name', type: 'text', validation: 'none' }],
      ['date_start', { label: 'Start Date', type: 'date', validation: 'none' }],
      ['date_end', { label: 'End Date', type: 'date', validation: 'none' }],
      ['status', { label: 'Status', type: 'select', source: [['Active', 'Active'], ['Inactive', 'Inactive']] }],
    ];
  }
}

class LeaveRuleAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'leave_type', 'job_title', 'employment_status', 'employee', 'default_per_year'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Leave Type' },
      { sTitle: 'Job Title' },
      { sTitle: 'Employment Status' },
      { sTitle: 'Employee' },
      { sTitle: 'Days Per Year' },
    ];
  }

  getTableColumns() {
    return [
      { title: 'Leave Type', dataIndex: 'leave_type', sorter: true },
      { title: 'Job Title', dataIndex: 'job_title' },
      { title: 'Employment Status', dataIndex: 'employment_status' },
      { title: 'Employee', dataIndex: 'employee' },
      { title: 'Days Per Year', dataIndex: 'default_per_year', sorter: true },
    ];
  }

  getFormFields() {
    return [
      ['id', { label: 'ID', type: 'hidden' }],
      ['leave_type', { label: 'Leave Type', type: 'select2', 'remote-source': ['LeaveType', 'id', 'name'] }],
      ['job_title', { label: 'Job Title', type: 'select2', 'allow-null': true, 'remote-source': ['JobTitle', 'id', 'name'] }],
      ['employment_status', { label: 'Employment Status', type: 'select2', 'allow-null': true, 'remote-source': ['EmploymentStatus', 'id', 'name'] }],
      ['employee', { label: 'Employee', type: 'select2', 'allow-null': true, 'remote-source': ['Employee', 'id', 'first_name+last_name'] }],
      ['department', { label: 'Department', type: 'select2', 'allow-null': true, 'remote-source': ['CompanyStructure', 'id', 'title'] }],
      ['default_per_year', { label: 'Days Per Year', type: 'text', validation: 'float' }],
      ['supervisor_leave_assign', { label: 'Supervisor Can Assign', type: 'select', source: [['Yes', 'Yes'], ['No', 'No']] }],
      ['employee_can_apply', { label: 'Employee Can Apply', type: 'select', source: [['Yes', 'Yes'], ['No', 'No']] }],
      ['apply_beyond_current', { label: 'Apply Beyond Current Period', type: 'select', source: [['Yes', 'Yes'], ['No', 'No']] }],
      ['leave_accrue', { label: 'Leave Accrue', type: 'select', source: [['No', 'No'], ['Yes', 'Yes']] }],
      ['carried_forward', { label: 'Carried Forward', type: 'select', source: [['No', 'No'], ['Yes', 'Yes']] }],
      ['carried_forward_percentage', { label: 'Carried Forward %', type: 'text', validation: 'number' }],
      ['max_carried_forward_amount', { label: 'Max Carried Forward', type: 'text', validation: 'number' }],
      ['propotionate_on_joined_date', { label: 'Proportionate on Joined Date', type: 'select', source: [['No', 'No'], ['Yes', 'Yes']] }],
      ['leave_group', { label: 'Leave Group', type: 'select2', 'allow-null': true, 'remote-source': ['LeaveGroup', 'id', 'name'] }],
      ['leave_period', { label: 'Leave Period', type: 'select2', 'allow-null': true, 'remote-source': ['LeavePeriod', 'id', 'name'] }],
    ];
  }
}

class LeaveGroupAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'name', 'details'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Name' },
      { sTitle: 'Details' },
    ];
  }

  getTableColumns() {
    return [
      { title: 'Name', dataIndex: 'name', sorter: true },
      { title: 'Details', dataIndex: 'details' },
    ];
  }

  getFormFields() {
    return [
      ['id', { label: 'ID', type: 'hidden' }],
      ['name', { label: 'Name', type: 'text', validation: 'none' }],
      ['details', { label: 'Details', type: 'textarea' }],
    ];
  }
}

class LeaveGroupEmployeeAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'employee', 'leave_group'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Employee' },
      { sTitle: 'Leave Group' },
    ];
  }

  getTableColumns() {
    return [
      { title: 'Employee', dataIndex: 'employee', sorter: true },
      { title: 'Leave Group', dataIndex: 'leave_group', sorter: true },
    ];
  }

  getFormFields() {
    return [
      ['id', { label: 'ID', type: 'hidden' }],
      ['employee', { label: 'Employee', type: 'select2', 'remote-source': ['Employee', 'id', 'first_name+last_name'] }],
      ['leave_group', { label: 'Leave Group', type: 'select2', 'remote-source': ['LeaveGroup', 'id', 'name'] }],
    ];
  }
}

class LeaveStartingBalanceAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'employee', 'leave_type', 'leave_period', 'amount'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Employee' },
      { sTitle: 'Leave Type' },
      { sTitle: 'Leave Period' },
      { sTitle: 'Amount' },
    ];
  }

  getTableColumns() {
    return [
      { title: 'Employee', dataIndex: 'employee', sorter: true },
      { title: 'Leave Type', dataIndex: 'leave_type', sorter: true },
      { title: 'Leave Period', dataIndex: 'leave_period', sorter: true },
      { title: 'Amount', dataIndex: 'amount', sorter: true },
    ];
  }

  getFormFields() {
    return [
      ['id', { label: 'ID', type: 'hidden' }],
      ['employee', { label: 'Employee', type: 'select2', 'remote-source': ['Employee', 'id', 'first_name+last_name'] }],
      ['leave_type', { label: 'Leave Type', type: 'select2', 'remote-source': ['LeaveType', 'id', 'name'] }],
      ['leave_period', { label: 'Leave Period', type: 'select2', 'remote-source': ['LeavePeriod', 'id', 'name'] }],
      ['amount', { label: 'Amount', type: 'text', validation: 'float' }],
      ['note', { label: 'Note', type: 'textarea' }],
    ];
  }
}

class EmployeeLeaveAdminAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'employee', 'leave_type', 'leave_period', 'date_start', 'date_end', 'status'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Employee' },
      { sTitle: 'Leave Type' },
      { sTitle: 'Leave Period' },
      { sTitle: 'Start Date' },
      { sTitle: 'End Date' },
      { sTitle: 'Status' },
    ];
  }

  getTableColumns() {
    const statusColors = {
      Approved: 'green',
      Pending: 'orange',
      Rejected: 'red',
      Cancelled: 'default',
      'Cancellation Requested': 'volcano',
    };
    return [
      { title: 'Employee', dataIndex: 'employee', sorter: true },
      { title: 'Leave Type', dataIndex: 'leave_type', sorter: true },
      { title: 'Leave Period', dataIndex: 'leave_period' },
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
      ['employee', { label: 'Employee', type: 'select2', 'remote-source': ['Employee', 'id', 'first_name+last_name'] }],
      ['leave_type', { label: 'Leave Type', type: 'select2', 'remote-source': ['LeaveType', 'id', 'name'] }],
      ['leave_period', { label: 'Leave Period', type: 'select2', 'remote-source': ['LeavePeriod', 'id', 'name'] }],
      ['date_start', { label: 'Start Date', type: 'date', validation: 'none' }],
      ['date_end', { label: 'End Date', type: 'date', validation: 'none' }],
      ['details', { label: 'Details', type: 'textarea' }],
      ['status', {
        label: 'Status',
        type: 'select',
        source: [
          ['Approved', 'Approved'],
          ['Pending', 'Pending'],
          ['Rejected', 'Rejected'],
          ['Cancelled', 'Cancelled'],
          ['Cancellation Requested', 'Cancellation Requested'],
        ],
      }],
    ];
  }
}

class HoliDayAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'name', 'dateh', 'status', 'country'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Name' },
      { sTitle: 'Date' },
      { sTitle: 'Status' },
      { sTitle: 'Country' },
    ];
  }

  getTableColumns() {
    return [
      { title: 'Name', dataIndex: 'name', sorter: true },
      { title: 'Date', dataIndex: 'dateh', sorter: true },
      {
        title: 'Status',
        dataIndex: 'status',
        render: (text) => <Tag color={text === 'Full Day' ? 'green' : 'orange'}>{text}</Tag>,
      },
      { title: 'Country', dataIndex: 'country' },
    ];
  }

  getFormFields() {
    return [
      ['id', { label: 'ID', type: 'hidden' }],
      ['name', { label: 'Name', type: 'text', validation: 'none' }],
      ['dateh', { label: 'Date', type: 'date', validation: 'none' }],
      ['status', { label: 'Status', type: 'select', source: [['Full Day', 'Full Day'], ['Half Day', 'Half Day']] }],
      ['country', { label: 'Country', type: 'select2', 'allow-null': true, 'remote-source': ['Country', 'id', 'name'] }],
    ];
  }
}

class WorkDayAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'name', 'status', 'country'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Day' },
      { sTitle: 'Status' },
      { sTitle: 'Country' },
    ];
  }

  getTableColumns() {
    return [
      { title: 'Day', dataIndex: 'name', sorter: true },
      {
        title: 'Status',
        dataIndex: 'status',
        render: (text) => {
          const color = text === 'Full Day' ? 'green' : text === 'Half Day' ? 'orange' : 'red';
          return <Tag color={color}>{text}</Tag>;
        },
      },
      { title: 'Country', dataIndex: 'country' },
    ];
  }

  getFormFields() {
    return [
      ['id', { label: 'ID', type: 'hidden' }],
      ['name', { label: 'Day', type: 'text', validation: 'none' }],
      ['status', {
        label: 'Status',
        type: 'select',
        source: [
          ['Full Day', 'Full Day'],
          ['Half Day', 'Half Day'],
          ['Non-working Day', 'Non-working Day'],
        ],
      }],
      ['country', { label: 'Country', type: 'select2', 'allow-null': true, 'remote-source': ['Country', 'id', 'name'] }],
    ];
  }
}

export {
  LeaveTypeAdapter,
  LeavePeriodAdapter,
  LeaveRuleAdapter,
  LeaveGroupAdapter,
  LeaveGroupEmployeeAdapter,
  LeaveStartingBalanceAdapter,
  EmployeeLeaveAdminAdapter,
  HoliDayAdapter,
  WorkDayAdapter,
};

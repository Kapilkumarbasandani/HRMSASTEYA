import React from 'react';
import { Tag } from 'antd';
import ReactModalAdapterBase from '../../../../../../web/api/ReactModalAdapterBase';

class EmployeeLeaveAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'employee', 'leave_type', 'leave_period', 'date_start', 'date_end', 'details', 'status'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Employee', bVisible: false },
      { sTitle: 'Leave Type' },
      { sTitle: 'Leave Period' },
      { sTitle: 'Start Date' },
      { sTitle: 'End Date' },
      { sTitle: 'Details' },
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
      { title: 'Leave Type', dataIndex: 'leave_type', sorter: true },
      { title: 'Leave Period', dataIndex: 'leave_period' },
      { title: 'Start Date', dataIndex: 'date_start', sorter: true },
      { title: 'End Date', dataIndex: 'date_end', sorter: true },
      { title: 'Details', dataIndex: 'details' },
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
      ['leave_type', { label: 'Leave Type', type: 'select2', 'remote-source': ['LeaveType', 'id', 'name'] }],
      ['leave_period', { label: 'Leave Period', type: 'select2', 'remote-source': ['LeavePeriod', 'id', 'name'] }],
      ['date_start', { label: 'Start Date', type: 'date', validation: 'none' }],
      ['date_end', { label: 'End Date', type: 'date', validation: 'none' }],
      ['details', { label: 'Reason', type: 'textarea' }],
      ['status', { label: 'Status', type: 'placeholder', default: 'Pending' }],
    ];
  }
}

class SubordinateLeaveAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return ['id', 'employee', 'leave_type', 'leave_period', 'date_start', 'date_end', 'details', 'status'];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Employee' },
      { sTitle: 'Leave Type' },
      { sTitle: 'Leave Period' },
      { sTitle: 'Start Date' },
      { sTitle: 'End Date' },
      { sTitle: 'Details' },
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
      ['details', { label: 'Reason', type: 'textarea' }],
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

export {
  EmployeeLeaveAdapter,
  SubordinateLeaveAdapter,
};

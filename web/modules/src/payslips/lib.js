import React from 'react';
import ReactModalAdapterBase from '../../../api/ReactModalAdapterBase';
import { Space, Tag } from 'antd';
import { DownloadOutlined } from '@ant-design/icons';

class MyPayslipAdapter extends ReactModalAdapterBase {
  getDataMapping() {
    return [
      'id',
      'document',
      'date_added',
      'details',
      'attachment',
    ];
  }

  getHeaders() {
    return [
      { sTitle: 'ID', bVisible: false },
      { sTitle: 'Document' },
      { sTitle: 'Date Added' },
      { sTitle: 'Details' },
    ];
  }

  getTableColumns() {
    return [
      {
        title: 'Payslip',
        dataIndex: 'document',
        sorter: true,
      },
      {
        title: 'Date Added',
        dataIndex: 'date_added',
        sorter: true,
      },
      {
        title: 'Details',
        dataIndex: 'details',
      },
    ];
  }

  getFormFields() {
    return [
      ['id', { label: 'ID', type: 'hidden' }],
    ];
  }

  getTableActionButtonJsx(adapter) {
    return (text, record) => {
      return (
        <Space size="middle">
          <Tag color="green" onClick={() => download(record.attachment)} style={{ cursor: 'pointer' }}>
            <DownloadOutlined />
            {` ${adapter.gt('Download Payslip')}`}
          </Tag>
        </Space>
      );
    };
  }
}

export { MyPayslipAdapter };

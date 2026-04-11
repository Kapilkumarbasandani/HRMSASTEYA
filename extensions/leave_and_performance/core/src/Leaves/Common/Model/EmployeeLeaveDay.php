<?php
namespace Leaves\Common\Model;

use Model\BaseModel;

class EmployeeLeaveDay extends BaseModel
{
    public $table = 'EmployeeLeaveDays';

    public function getAdminAccess()
    {
        return array('get', 'element', 'save', 'delete');
    }

    public function getManagerAccess()
    {
        return array('get', 'element');
    }

    public function getUserAccess()
    {
        return array('get', 'element');
    }
}

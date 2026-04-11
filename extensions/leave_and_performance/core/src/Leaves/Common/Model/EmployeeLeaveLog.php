<?php
namespace Leaves\Common\Model;

use Model\BaseModel;

class EmployeeLeaveLog extends BaseModel
{
    public $table = 'EmployeeLeaveLog';

    public function getAdminAccess()
    {
        return array('get', 'element');
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

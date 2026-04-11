<?php
namespace Leaves\Common\Model;

use Classes\ModuleAccess;
use Model\BaseModel;

class LeaveType extends BaseModel
{
    public $table = 'LeaveTypes';

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

    public function getModuleAccess()
    {
        return [
            new ModuleAccess('leaves', 'admin'),
            new ModuleAccess('leaves', 'user'),
        ];
    }
}

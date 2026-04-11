<?php
namespace Leaves\Common\Model;

use Classes\ModuleAccess;
use Model\BaseModel;

class EmployeeLeave extends BaseModel
{
    public $table = 'EmployeeLeaves';

    public function getAdminAccess()
    {
        return array('get', 'element', 'save', 'delete');
    }

    public function getManagerAccess()
    {
        return array('get', 'element', 'save', 'delete');
    }

    public function getUserAccess()
    {
        return array('get', 'element');
    }

    public function getUserOnlyMeAccess()
    {
        return array('get', 'element', 'save', 'delete');
    }

    public function getModuleAccess()
    {
        return [
            new ModuleAccess('leaves', 'admin'),
            new ModuleAccess('leaves', 'user'),
        ];
    }
}

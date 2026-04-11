<?php
namespace Leaves\Common\Model;

use Classes\ModuleAccess;
use Model\BaseModel;

class LeaveStartingBalance extends BaseModel
{
    public $table = 'LeaveStartingBalance';

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
        return array();
    }

    public function getModuleAccess()
    {
        return [
            new ModuleAccess('leaves', 'admin'),
        ];
    }
}

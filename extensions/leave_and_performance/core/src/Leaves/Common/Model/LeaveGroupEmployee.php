<?php
namespace Leaves\Common\Model;

use Classes\ModuleAccess;
use Model\BaseModel;

class LeaveGroupEmployee extends BaseModel
{
    public $table = 'LeaveGroupEmployees';

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

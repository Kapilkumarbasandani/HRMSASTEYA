<?php
namespace Leaves\Common\Model;

use Classes\ModuleAccess;
use Model\BaseModel;

class LeavePeriod extends BaseModel
{
    public $table = 'LeavePeriods';

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

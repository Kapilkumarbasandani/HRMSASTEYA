<?php
namespace Leaves\Common\Model;

use Classes\ModuleAccess;
use Model\BaseModel;

class WorkDay extends BaseModel
{
    public $table = 'WorkDays';

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

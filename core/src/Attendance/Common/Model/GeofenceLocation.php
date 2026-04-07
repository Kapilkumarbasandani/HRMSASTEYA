<?php
namespace Attendance\Common\Model;

use Classes\ModuleAccess;
use Model\BaseModel;

class GeofenceLocation extends BaseModel
{
    public $table = 'GeofenceLocations';

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
            new ModuleAccess('attendance', 'admin'),
        ];
    }
}

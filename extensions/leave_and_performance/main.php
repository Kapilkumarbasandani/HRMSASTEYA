<?php

class ProModuleConfig
{
    private static $proModules = [
        'admin' => ['leaves'],
        'modules' => ['leaves'],
    ];

    public static function isProModule($group, $name)
    {
        return isset(self::$proModules[$group]) && in_array($name, self::$proModules[$group]);
    }

    public static function getProModulePath($group, $name)
    {
        $basePath = dirname(__FILE__) . '/core/';
        return $basePath . $group . '/' . $name;
    }
}

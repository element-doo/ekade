<?php
namespace NGS;

abstract class Project
{
    public static $path;
    public static $ID;
    public static $username;
    public static $apiUrl;

    public static function init()
    {
        $path = defined('NGS_DSL_PROJECT_INI_PATH')
            ? NGS_DSL_PROJECT_INI_PATH
            : __DIR__.'/../project.ini';

        $config = parse_ini_file($path);
        if ($config === false) {
            throw new \Exception('Could not read project configuration file: '.$path);
        }

        if (!isset($config['project-id'])) {
            throw new \Exception('Could not locate project ID in file: '.$path);
        }
        self::$ID = $config['project-id'];

        self::$username = $config['username'];
        self::$apiUrl = $config['api-url'];
        self::$path = $path;
    }
}

Project::init();

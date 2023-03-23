<?php

/**
 * Класс для регистрации классов
 */
class Autoloader
{
    public static function register()
    {
        spl_autoload_extensions(".php");
        spl_autoload_register();
        spl_autoload_register(array(__CLASS__, 'load'));
    }

    public static function load($class_name)
    {
        $class_name = ltrim($class_name, '\\');
        $file_name = '';
        $namespace = '';

        if ($last_ns_pos = strrpos($class_name, '\\')) {
            $namespace = substr($class_name, 0, $last_ns_pos);
            $class_name = substr($class_name, $last_ns_pos + 1);
            $file_name = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }

        $file_name .= str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';
        $path = __DIR__ . DIRECTORY_SEPARATOR . $file_name;

        if (file_exists($path)) {
            require_once $path;
        }
    }

    public static function loadAll($path = '.')
    {
        $files = scandir($path);

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $file_path = $path . DIRECTORY_SEPARATOR . $file;

            if (is_dir($file_path)) {
                self::loadAll($file_path);
            } elseif (pathinfo($file_path, PATHINFO_EXTENSION) === 'php') {
                $class_name = pathinfo($file_path, PATHINFO_FILENAME);
                self::load($class_name);
            }
        }
    }
}

Autoloader::register();
Autoloader::loadAll(__DIR__ . '/base');
Autoloader::loadAll(__DIR__ . '/models');
Autoloader::loadAll(__DIR__ . '/controller');
Autoloader::loadAll(__DIR__ . '/helper');

<?php

/**
 * Класс для регистрации классов
 */
class Loader {

    static function registerPath($path) 
    {
        $files = glob("$path/*.php");
        
        foreach ($files as $value) {
            $class = str_replace('.php', '', $value);

            spl_autoload($class);
        }
    }
}

Loader::registerPath('base');
Loader::registerPath('models');
Loader::registerPath('controller');
Loader::registerPath('helper');
<?php

spl_autoload_register(function ($class) {
    //$class = 'Zoom\\' . $class;
    require_once str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
});
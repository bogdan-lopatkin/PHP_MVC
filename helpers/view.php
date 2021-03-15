<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

if (!function_exists('view')) {

    function view(string $path, array $data = [])
    {
        $loader = new FilesystemLoader(__DIR__.'/../resources/views');

        $twig = new Environment($loader);

        return $twig->render("{$path}.twig", $data );

    }

}
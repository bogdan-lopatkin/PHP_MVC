<?php

if (!function_exists('config')) {
    function config(string $path)
    {
        $pathSections = explode('.', $path);
        $toReturn = include __DIR__ . "/../config/" . array_shift($pathSections) . ".php";

        foreach ($pathSections as $section) {
            $toReturn = $toReturn[$section];
        }

        if (is_array($toReturn)) {
            $result = "";

            foreach ($toReturn as $key => $value) {
                $result .= "{$key}={$value};";
            }

            return $result;
        }

        return $toReturn;
    }
}
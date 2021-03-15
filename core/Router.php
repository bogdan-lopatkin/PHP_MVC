<?php

namespace Core;

class Router
{
    private static $instance = null;

    protected $routes = [];

    protected $params = [];

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function get(string $route, array $params)
    {
        $params['method'] = 'GET';

        self::getInstance()->add($route, $params);
    }

    public static function post(string $route, array $params)
    {
        $params['method'] = 'POST';

        self::getInstance()->add($route, $params);

    }

    /**
     * @param string $route The route URL
     * @param array  $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public function add($route, $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>\d+|[a-z-]+)', $route);

        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @param string $url
     *
     * @return boolean
     */
    public function match($url): bool
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Get named capture group values
                $params['data'] = [];
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params['data'][$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param string $url
     *
     * @return void
     */
    public static function dispatch($url)
    {
        $instance = self::getInstance();
        $url = $instance->removeQueryStringVariables($url);

        if ($instance->match($url)) {
            $controller = $instance->params['controller'];
            $controller = $instance->convertToStudlyCaps($controller);
            $controller = $instance->getNamespace() . $controller;
            if ($_SERVER['REQUEST_METHOD'] === $instance->params['method']) {

                if (class_exists($controller)) {
                    $controller_object = new $controller($instance->params);

                    $action = $instance->params['action'];
                    $action = $instance->convertToCamelCase($action);

                    if (preg_match('/action$/i', $action) == 0) {
                        echo $controller_object->$action(new Request($instance->params));
                    } else {
                        throw new \Exception("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method");
                    }
                } else {
                    throw new \Exception("Controller class $controller not found");
                }
            } else {
                throw new \Exception("Method ${_SERVER['REQUEST_METHOD']} not allowed on this route. Allowed method - {$instance->params['method']}");
            }
        } else {
            echo view('404');
        }
    }


    /**
     * @param string $string
     *
     * @return string
     */
    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * @param string $string
     *
     * @return string
     */
    protected function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    /**
     * @param string $url
     *
     * @return string
     */
    protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

    /**
     * @return string
     */
    protected function getNamespace()
    {
        $namespace = 'App\Controllers\\';

        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }

        return $namespace;
    }
}
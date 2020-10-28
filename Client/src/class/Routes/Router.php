<?php

namespace App\Routes;


require (dirname(__DIR__, 3)) . "/vendor/autoload.php";


class Router
{
    private $viewPath;
    private $router;

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->router = new \AltoRouter();
    }

    public function get(string $url, string $view, ?string $name = null)
    {
        $this->router->map('GET', $url, $view, $name);
        return $this;
    }

    public function post(string $url, string $view, ?string $name = null)
    {
        $this->router->map('POST', $url, $view, $name);
        return $this;
    }


    public function run(): self
    {
        $match = $this->router->match();
        $view = $match['target'];


        ob_start();
        require $this->viewPath . DIRECTORY_SEPARATOR . $view . ".php";
        $content = ob_get_clean();
        require $this->viewPath . DIRECTORY_SEPARATOR . '../layout/layout.php';

        return $this;
    }
}
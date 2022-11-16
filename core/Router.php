<?php

namespace app\core;

class Router
{
    protected  array  $routes=[];
    public  Request $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public  function get($path,$callback){
        $this->routes['get'][$path]=$callback;
    }

    public  function resolve()
    {
        $path =  $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path]??false;
        if (!$callback){
            echo "Not found ";
            exit();
        }
        if(is_string($callback)){
            return $this->randerView($callback);
        }
        return call_user_func($callback);
    }

    public function randerView($view)
    {
        $layoutContent = $this->layoutContent();
        $ViewContent = $this->randerOnlyView($view);
        return str_replace('{{content}}',$ViewContent,$layoutContent);
    }

    protected function layoutContent()
    {
        //nothing is output in the browser
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/main.php";
        return ob_get_clean();
    }

    protected  function randerOnlyView($view){
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}
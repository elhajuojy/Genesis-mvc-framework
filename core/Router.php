<?php

namespace app\core;

class Router
{
    public  Request $request;
    public  Response  $response;
    protected  array  $routes=[];

    /**
     * @param Request $request
     */
    public function __construct(Request $request,Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public  function get($path,$callback){
        $this->routes['get'][$path]=$callback;
    }
    public  function post($path,$callback){
        $this->routes['post'][$path]=$callback;
    }

    public  function resolve()
    {
        $path =  $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path]??false;
        if (!$callback){
            $this->response->setStatusCode(404);
            return $this->randerView("404");
        }
        if(is_string($callback)){

            return $this->randerView($callback);
        }
        if (is_array($callback)){
            $callback[0] = new $callback[0];
        }
        return call_user_func($callback);
    }

    public function randerView($view,$parms=[])
    {
        $layoutContent = $this->layoutContent();
        $ViewContent = $this->randerOnlyView($view,$parms);
        return str_replace('{{content}}',$ViewContent,$layoutContent);
    }
    public function randerViewContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}',$viewContent,$layoutContent);
    }

    protected function layoutContent()
    {
        //nothing is output in the browser
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/main.php";
        return ob_get_clean();
    }

    protected  function randerOnlyView($view,$parms){
        foreach ($parms as $key=>$value){
            $$key = $value;
        }
        //var_dump($name);
        //var_dump($lastname);
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}
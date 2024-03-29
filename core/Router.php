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
        $method = $this->request->mathod();
        $callback = $this->routes[$method][$path]??false;
        if (!$callback){
            $this->response->setStatusCode(404);
            return $this->randerView("404");
        }
        if(is_string($callback)){

            return $this->randerView($callback);
        }
        if (is_array($callback)){
            Application::$app->controller= new $callback[0]();
            $callback[0]  = Application::$app->controller;
        }
        return call_user_func($callback,$this->request);
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
        $layout = Application::$app->controller->layout;
        //nothing is output in the browser
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
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
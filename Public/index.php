<?php


require_once __DIR__ . "/../vendor/autoload.php";

use app\controllers\AuthController;
use app\controllers\SiteController as SiteControllerAlias;
use app\core\Application;
use app\core\Router;


$app = new Application(dirname(__DIR__));

$app->router->get('/',[SiteControllerAlias::class,'home']);

$app->router->get('/contact',[SiteControllerAlias::class,'contact']);

$app->router->post('/contact',[SiteControllerAlias::class,'handleContent']);

$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);
$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/register',[AuthController::class,'register']);

$app->run();


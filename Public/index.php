<?php


require_once __DIR__ . "/../vendor/autoload.php";

use app\controllers\SiteController as SiteControllerAlias;
use app\core\Application;
use app\core\Router;


$app = new Application(dirname(__DIR__));

$app->router->get('/',[SiteControllerAlias::class,'home']);


$app->router->get('/contact',[SiteControllerAlias::class,'contact']);

$app->router->post('/contact',[SiteControllerAlias::class,'handleContent']);
$app->run();


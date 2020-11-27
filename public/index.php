<?php
/**
 * This file is the Front Controller
 * HTTP traffic must be redirected to this file
 *
 * @var App $app
 */




use App\Controller\HomeController;
use Slim\App;

// App configuration
require_once __DIR__ . '/../config/bootstrap.php';

$app
    ->map(['GET', 'POST'], '/', [HomeController::class, 'homepage'])
    ->setName('homepage')
;

$app
    ->get('/success/{id:\d+}', [HomeController::class, 'success'])
    ->setName('success')
;

$app
    ->get('/file-error', [HomeController::class, 'fileError'])
    ->setName('file-error')
;


$app    
    ->get('/download/{id:\d+}', [HomeController::class, 'download']) 
    ->setName('download')
;

$app    
    ->get('/download/{nom:\s+}', [HomeController::class, 'download']) 
    ->setName('download')
;

// Application routes
/*$app
    ->get('/', [HomeController::class, 'homepage'])
    ->setName('homepage')
;

$app
    ->map(['GET', 'POST'], '/test', [HomeController::class, 'test'])
    ->setName('test')
;

$app
    ->get('/a-propos', [HomeController::class, 'about'])
    ->setName('about')
;*/



// Start the application
$app->run();
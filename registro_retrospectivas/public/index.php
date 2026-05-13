<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

use Slim\Factory\AppFactory;

// Cargar autoloader
require __DIR__ . '/../vendor/autoload.php';

// Cargar configuración de base de datos
require __DIR__ . '/../app/config/database.php';

// Crear aplicación Slim
$app = AppFactory::create();

// Middleware CORS
$corsMiddleware = require __DIR__ . '/../app/MiddleWares/CorsMiddleware.php';
$corsMiddleware($app);

// Cargar rutas/endpoints
$endpoints = require __DIR__ . '/../app/registro/Presentation/Routes/Endpoints.php';
$endpoints($app);

// Ejecutar la aplicación
$app->run();
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DI\ContainerBuilder;
use FastRoute\RouteCollector;
use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use Narrowspark\HttpEmitter\SapiEmitter;
use Relay\Relay;
use Laminas\Diactoros\ServerRequestFactory;

// Carregar variáveis de ambiente
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Criar o container de injeção de dependência
$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(true);
$container = $containerBuilder->build();

// Configurar o roteador
$routes = function (RouteCollector $r) {
    $routeDefinition = require __DIR__ . '/../routes/routes.php';
    $routeDefinition($r);
};

$dispatcher = FastRoute\simpleDispatcher($routes);

// Criar a fila de requisições (middleware)
$middlewareQueue[] = new FastRoute($dispatcher);
$middlewareQueue[] = new RequestHandler($container);

$requestHandler = new Relay($middlewareQueue);

// Processar a requisição
$request = ServerRequestFactory::fromGlobals();
$response = $requestHandler->handle($request);

// Emitir a resposta
$emitter = new SapiEmitter();
return $emitter->emit($response);
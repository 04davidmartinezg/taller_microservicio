<?php

use Slim\app;
use app\registro\Presentation\Repositories\RetroRepository;
use app\registro\Presentation\Repositories\SprintRepository;
use Slim\Routing\RouteCollectorProxy;
return function (App $app) {
       $app->group('/sprint', function (RouteCollectorProxy $group) {
        $group->post('', [SprintRepository::class, 'CreateSprint']);
        $group->get('', [SprintRepository::class, 'all']); 
    });
   
      $app->group('/retro_items', function (RouteCollectorProxy $group) {
        $group->get('', [RetroRepository::class, 'all']);
        $group->post('', [RetroRepository::class, 'CreateRetroItem']);
        $group->put('/{id}', [RetroRepository::class, 'updateRetroItem']);
        $group->delete('/{id}', [RetroRepository::class, 'deleteRetroItem']);
        $group->get('/sprint/{id}', [RetroRepository::class, 'Visualizar']);
    });
 };
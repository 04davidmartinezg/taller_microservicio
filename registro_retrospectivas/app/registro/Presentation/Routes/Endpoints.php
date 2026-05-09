<?php

use Slim\app;
use app\registro\Presentation\Repositories\RetroRepository;
use app\registro\Presentation\Repositories\SprintRepository;
use Slim\Routing\RouteCollectorProxy;
return function (App $app) {
      $app->group('/sprint', function (RouteCollectorProxy $group) {
        $group->get('', [SprintRepository::class, 'all']);
        $group->get('/{id}', [SprintRepository::class, 'detail']);
        $group->post('', [SprintRepository::class, 'create_retro']);
        $group->put('/{id}', [SprintRepository::class, 'positive']);
        $group->delete('/{id}', [SprintRepository::class, 'delete']);
        $group->
    });
      $app->group('/retro_items', function (RouteCollectorProxy $group) {
        $group->get('', [RetroRepository::class, 'all']);
        $group->get('/{id}', [RetroRepository::class, 'detail']);
        $group->post('', [RetroRepository::class, 'create']);
        $group->put('/{id}', [RetroRepository::class, 'update']);
        $group->delete('/{id}', [RetroRepository::class, 'delete']);
    });
};
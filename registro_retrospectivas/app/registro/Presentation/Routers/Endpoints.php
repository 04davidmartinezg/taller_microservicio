<?php
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use App\registro\Presentation\Repositories\SprintRepository;
use app\registro\Presentation\Repositories\RetroRepository;
return function (App $app) {
    $app->group('/sprint', function (RouteCollectorProxy $group) {
        $group->get('', [SprintRepository::class, 'all']);
        $group->get('/{id}', [SprintRepository::class, 'find']);
        $group->post('', [SprintRepository::class, 'CreateSprint']);
        $group->put('/{id}', [SprintRepository::class, 'update']);
        $group->delete('/{id}', [SprintRepository::class, 'delete']);

    });

    $app->group('/retro_items', function (RouteCollectorProxy $group) {
        $group->get('', [RetroRepository::class, 'all']);

        $group->get('/historial', [RetroRepository::class, 'Historial']);

        $group->get('/sprint/{id}', [RetroRepository::class, 'Visualizar']);

        $group->post('', [RetroRepository::class, 'CreateRetroItem']);

        $group->put('/{id}', [RetroRepository::class, 'updateRetroItem']);

        $group->delete('/{id}', [RetroRepository::class, 'deleteRetroItem']);

    });

};
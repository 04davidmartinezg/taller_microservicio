<?php 
namespace app\registro\Presentation\Repositories;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Contactos\Controllers\SprintController;
use Exception;
class SprintRepository
{
      function all(Request $request, Response $response)
    {
        $controller = new SprintController();
        $sprint = $controller->getSprint();
        $response->getBody()->write($sprint);
        return $response->withHeader("Content-Type", "application/json");
    }

      function create(Request $request, Response $response)
    {
        $bodyRequest = $request->getBody()->getContents();
        $data = json_decode($bodyRequest, true);
        $controller = new SprintController();
        $sprint = $controller->guardarSprint($data);
        $response->getBody()->write($sprint);
        return $response
            ->withStatus(201)
            ->withHeader("Content-Type", "application/json");
    }
}
?>
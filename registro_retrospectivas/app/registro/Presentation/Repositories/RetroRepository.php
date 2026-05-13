<?php 
namespace app\registro\Presentation\Repositories;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Contactos\Controllers\RetroController;
use Exception;
class RetroRepository
{
      function all(Request $request, Response $response)
    {
        $controller = new RetroController();
        $retro = $controller->getRetro();
        $response->getBody()->write($retro);
        return $response->withHeader("Content-Type", "application/json");
    }

      function create(Request $request, Response $response)
    {
        $bodyRequest = $request->getBody()->getContents();
        $data = json_decode($bodyRequest, true);
        $controller = new RetroController();
        $retro = $controller->guardarRetro($data);
        $response->getBody()->write($retro);
        return $response
            ->withStatus(201)
            ->withHeader("Content-Type", "application/json");
    }
}
?>
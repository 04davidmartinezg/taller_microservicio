<?php 
namespace app\registro\Presentation\Repositories; 

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use app\registro\Controller\RetroController; 
use Exception;

class RetroRepository
{
       public function all(Request $request, Response $response)
    {
        $controller = new RetroController();
        $retro = $controller->obtenerTodosLosItems(); 
        $response->getBody()->write($retro);
        return $response->withHeader("Content-Type", "application/json");
    }
    public function Historial(Request $request, Response $response)
    {
        $controller = new RetroController();
        $retro = $controller->obtenerTodosLosItems();
        $response->getBody()->write($retro);
        return $response->withHeader("Content-Type", "application/json");
    }

    public function Visualizar(Request $request, Response $response, array $args)
    {
        $id = (int)$args['id']; 
        $controller = new RetroController();
        $retro = $controller->visualizarRetro($id);
        $response->getBody()->write($retro);
        return $response->withHeader("Content-Type", "application/json");
    }
    public function CreateRetroItem(Request $request, Response $response)
    {
        $bodyRequest = $request->getBody()->getContents();
        $data = json_decode($bodyRequest, true);
        
        $controller = new RetroController();
        $retro = $controller->guardarItem($data);
        
        $response->getBody()->write($retro);
        return $response
            ->withStatus(201)
            ->withHeader("Content-Type", "application/json");
    }
    public function updateRetroItem(Request $request, Response $response, array $args)
    {
        $id = (int)$args['id'];
        $bodyRequest = $request->getBody()->getContents();
        $data = json_decode($bodyRequest, true);

        $controller = new RetroController();
        $retro = $controller->actualizarItem($id, $data);

        $response->getBody()->write($retro);
        return $response->withHeader("Content-Type", "application/json");
    }
    public function deleteRetroItem(Request $request, Response $response, array $args)
    {
        $id = (int)$args['id'];
        $controller = new RetroController();
        $retro = $controller->eliminarItem($id);

        $response->getBody()->write($retro);
        return $response->withHeader("Content-Type", "application/json");
    }
}
?>
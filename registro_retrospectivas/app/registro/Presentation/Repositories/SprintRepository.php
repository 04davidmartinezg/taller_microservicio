<?php 
namespace App\registro\Presentation\Repositories; 

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\registro\Controller\SprintController; 
use Exception;
class SprintRepository
{
    public function all(Request $request, Response $response)
    {
        try {
            $controller = new SprintController();
            $sprints = $controller->getSprint();
            $response->getBody()->write($sprints);
            return $response->withHeader(
                "Content-Type",
                "application/json"
            );

        } catch (Exception $e) {
            $response->getBody()->write(json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]));
            return $response->withStatus(500)
                ->withHeader("Content-Type", "application/json");
        }
    }
    public function find(Request $request, Response $response, $args)
    {
        try {
            $controller = new SprintController();
            $sprint = $controller->getOneSprint($args['id']);
            $response->getBody()->write($sprint);
            return $response->withHeader(
                "Content-Type",
                "application/json"
            );

        } catch (Exception $e) {
            $response->getBody()->write(json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]));
            return $response->withStatus(404)
                ->withHeader("Content-Type", "application/json");
        }
    }
    public function CreateSprint(Request $request, Response $response)
    {
        try {
            $bodyRequest = $request->getBody()->getContents();
            $data = json_decode($bodyRequest, true);
            if ($data === null) {
                throw new Exception("JSON inválido.");
            }
            $controller = new SprintController();
            $sprint = $controller->guardarSprint($data);
            $response->getBody()->write($sprint);
            return $response
                ->withStatus(201)
                ->withHeader("Content-Type", "application/json");
        } catch (Exception $e) {
            $response->getBody()->write(json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]));
            return $response->withStatus(400)
                ->withHeader("Content-Type", "application/json");
        }
    }
    public function update(Request $request, Response $response, $args)
    {
        try {
            $bodyRequest = $request->getBody()->getContents();
            $data = json_decode($bodyRequest, true);
            if ($data === null) {
                throw new Exception("JSON inválido.");
            }
            $controller = new SprintController();
            $sprint = $controller->modificarSprint(
                $args['id'],
                $data
            );
            $response->getBody()->write($sprint);
            return $response
                ->withHeader("Content-Type", "application/json");
        } catch (Exception $e) {
            $response->getBody()->write(json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]));
            return $response->withStatus(400)
                ->withHeader("Content-Type", "application/json");
        }
    }
    public function delete(Request $request, Response $response, $args)
    {
        try {
            $controller = new SprintController();
            $result = $controller->borrarSprint($args['id']);
            $response->getBody()->write($result);
            return $response
                ->withHeader("Content-Type", "application/json");

        } catch (Exception $e) {
            $response->getBody()->write(json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]));
            return $response->withStatus(400)
                ->withHeader("Content-Type", "application/json");
        }
    }
}
?>
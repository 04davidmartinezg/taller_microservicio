<?php
namespace app\registro\Controller;

use Exception;
use app\registro\Models\sprints; 

class SprintController 
{
    public function getSprint(): string 
    {
        try {
            $sprints = sprints::orderBy('id', 'desc')->get();
            return json_encode($sprints);
        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function guardarSprint(array $data): string 
    {
        try {
            if (!isset($data['nombre']) || !isset($data['fecha_inicio']) || !isset($data['fecha_fin'])) {
                throw new Exception("Los campos 'nombre', 'fecha_inicio' y 'fecha_fin' son obligatorios.");
            }
            $nuevoSprint = new sprints();
            $nuevoSprint->nombre = $data['nombre'];
            $nuevoSprint->fecha_inicio = $data['fecha_inicio'];
            $nuevoSprint->fecha_fin = $data['fecha_fin'];
            $nuevoSprint->save();

            return json_encode([
                "status" => "success",
                "mensaje" => "Sprint creado exitosamente",
                "sprint" => $nuevoSprint
            ]);

        } catch (Exception $e) {
            return json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}
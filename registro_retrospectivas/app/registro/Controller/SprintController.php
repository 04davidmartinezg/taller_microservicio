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

            return json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }

    public function guardarSprint(array $data): string
    {
        try {

            if (
                empty($data['nombre']) ||
                empty($data['fecha_inicio']) ||
                empty($data['fecha_fin'])
            ) {
                throw new Exception(
                    "Los campos nombre, fecha_inicio y fecha_fin son obligatorios."
                );
            }

            if ($data['fecha_inicio'] > $data['fecha_fin']) {
                throw new Exception(
                    "La fecha de inicio no puede ser mayor que la fecha final."
                );
            }

            $nuevoSprint = new sprints();

            $nuevoSprint->nombre = $data['nombre'];
            $nuevoSprint->fecha_inicio = $data['fecha_inicio'];
            $nuevoSprint->fecha_fin = $data['fecha_fin'];

            $nuevoSprint->save();

            return json_encode([
                "status" => "success",
                "message" => "Sprint creado exitosamente",
                "sprint" => $nuevoSprint
            ]);

        } catch (Exception $e) {

            return json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }

    public function getOneSprint($id)
    {
        try {

            $sprint = sprints::find($id);

            if (empty($sprint)) {
                throw new Exception("El sprint no existe.");
            }

            return json_encode($sprint);

        } catch (Exception $e) {

            return json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }

    public function modificarSprint($id, array $data): string
    {
        try {

            $sprint = sprints::find($id);

            if (empty($sprint)) {
                throw new Exception("El sprint no existe.");
            }

            if (
                empty($data['nombre']) ||
                empty($data['fecha_inicio']) ||
                empty($data['fecha_fin'])
            ) {
                throw new Exception(
                    "Los campos nombre, fecha_inicio y fecha_fin son obligatorios."
                );
            }

            if ($data['fecha_inicio'] > $data['fecha_fin']) {
                throw new Exception(
                    "La fecha de inicio no puede ser mayor que la fecha final."
                );
            }

            $sprint->nombre = $data['nombre'];
            $sprint->fecha_inicio = $data['fecha_inicio'];
            $sprint->fecha_fin = $data['fecha_fin'];

            $sprint->save();

            return json_encode([
                "status" => "success",
                "message" => "Sprint actualizado correctamente",
                "sprint" => $sprint
            ]);

        } catch (Exception $e) {

            return json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }

    public function borrarSprint($id): string
    {
        try {

            $sprint = sprints::find($id);

            if (empty($sprint)) {
                throw new Exception("El sprint no existe.");
            }

            $sprint->delete();

            return json_encode([
                "status" => "success",
                "message" => "Sprint eliminado correctamente"
            ]);

        } catch (Exception $e) {

            return json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }
}
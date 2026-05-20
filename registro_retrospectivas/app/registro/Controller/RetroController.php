<?php

namespace App\registro\Controller;

use app\registro\Models\retro_items;
use app\registro\Models\sprints;

use Exception;

class RetroController
{

    private array $categoriasValidas = [
        'logro',
        'impedimento',
        'accion'
    ];

    public function obtenerTodosLosItems(): string
    {
        try {

            return json_encode(
                retro_items::orderBy('id', 'desc')->get()
            );

        } catch (Exception $e) {

            return json_encode([
                "error" => $e->getMessage()
            ]);
        }
    }

    public function visualizarRetro(int $sprintId): string
    {
        try {

            $itemsActuales = retro_items::where(
                'sprint_id',
                $sprintId
            )->get();

            $sprintAnteriorId = $sprintId - 1;

            $accionesAnteriores = retro_items::where(
                'sprint_id',
                $sprintAnteriorId
            )
            ->where('categoria', 'accion')
            ->select('id', 'descripcion', 'cumplida')
            ->get();

            return json_encode([
                "sprint_id" => $sprintId,
                "items_actuales" => $itemsActuales,
                "acciones_sprint_anterior" => $accionesAnteriores
            ]);

        } catch (Exception $e) {

            return json_encode([
                "error" => $e->getMessage()
            ]);
        }
    }

    public function guardarItem(array $data): string
    {
        try {

            if (
                empty($data['sprint_id']) ||
                empty($data['categoria']) ||
                empty($data['descripcion'])
            ) {
                throw new Exception(
                    "Campos obligatorios faltantes."
                );
            }

            if (
                !in_array(
                    $data['categoria'],
                    $this->categoriasValidas
                )
            ) {
                throw new Exception(
                    "Categoría inválida."
                );
            }

            $sprint = sprints::find($data['sprint_id']);

            if (!$sprint) {
                throw new Exception(
                    "El sprint no existe."
                );
            }

            $nuevoItem = new retro_items();

            $nuevoItem->sprint_id = $data['sprint_id'];
            $nuevoItem->categoria = $data['categoria'];
            $nuevoItem->descripcion = $data['descripcion'];

            $nuevoItem->cumplida =
                ($data['categoria'] === 'accion')
                ? 0
                : null;

            $nuevoItem->save();

            return json_encode([
                "status" => "success",
                "item" => $nuevoItem
            ]);

        } catch (Exception $e) {

            return json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }

    public function actualizarItem(
        int $id,
        array $data
    ): string
    {
        try {

            $item = retro_items::find($id);

            if (!$item) {
                throw new Exception("Ítem no encontrado.");
            }

            if (isset($data['descripcion'])) {
                $item->descripcion = $data['descripcion'];
            }

            if (
                isset($data['cumplida']) &&
                $item->categoria === 'accion'
            ) {
                $item->cumplida = $data['cumplida'];
            }

            $item->save();

            return json_encode([
                "status" => "success",
                "mensaje" => "Ítem actualizado"
            ]);

        } catch (Exception $e) {

            return json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }

    public function eliminarItem(int $id): string
    {
        try {

            $item = retro_items::find($id);

            if (!$item) {
                throw new Exception("Ítem no encontrado.");
            }

            $item->delete();

            return json_encode([
                "status" => "success"
            ]);

        } catch (Exception $e) {

            return json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }
}
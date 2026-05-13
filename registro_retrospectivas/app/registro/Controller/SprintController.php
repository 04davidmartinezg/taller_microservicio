<?php
namespace app\registro\Controllers;
use app\registro\Models\sprints;
use Exception;
class SprintController {

    function getsprint(){
        $rows = sprints::all();
        return $rows->toJson();
    }
    
    function guardarSprint($data){
        $sprint = new sprints();
        $sprint->nombre = $data['nombre'];
        $sprint->fecha_inicio  = $data['fecha_inicio'];
        $sprint->fecha_fin  = $data['fecha_fin'];
        $sprint->save();
        return $sprint->toJson();
    }

    function getSprint($id){
        $sprint = sprints::find($id);
        if(empty($sprint)){
            throw new Exception("El sprint $id no existe", 1);
        }
        return $sprint;
    }

    function modificarSprint($id, $data){
        $sprint = $this->getSprint($id);
        $sprint->nombre = $data['nombre'];
        $sprint->fecha_inicio = $data['fecha_inicio'];
        $sprint->fecha_fin = $data['fecha_fin'];
        $sprint->save();
        return $sprint;
    }

    function borrarSprint($id){
        $sprint = $this->getSprint($id);
        $sprint->delete();
    }
}
?>
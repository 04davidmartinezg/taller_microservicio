<?php
namespace app\registro\Controllers;
use app\registro\Models\retro_items;
use Exception;
class RetroController {

    function getRetro(){
        $rows = retro_items::all();
        return $rows->toJson();
    }
    
    function guardarRetro($data){
        $retro = new retro_items();
        $retro->sprint_id = $data['sprint_id'];
        $retro->categoria  = $data['categoria '];
        $retro->descripcion = $data['descripcion'];
        $retro->cumplida = $data ['cumplida '];
        $retro->fecha_revision  = $data ['fecha_revision '];
        $retro->save();
        return $retro->toJson();
    }
    
}
?>
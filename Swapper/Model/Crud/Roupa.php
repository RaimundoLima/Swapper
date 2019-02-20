<?php
include_once('Setup.php');

function buscarRoupa($id,$usuario){
    return R::findOne("roupa","id=? AND usuario_id=?",[$id,$usuario]);

}
function inserirRoupa($roupa){
    $roupaT=R::dispense("roupa");
    $roupaT["usuario"]=R::load("usuario",$roupa["usuario"]);
    $roupaT["disponibilidade"]=1;
    $roupaT["tipo"]=$roupa["tipo"];
    $roupaT["estado"]=$roupa["estado"];
    $roupaT["descricao"]=$roupa["descricao"];
    $roupaT["categoria"]=$roupa["categoria"];
    $roupaT["nome"]=$roupa["nome"];
    $roupaT["foto1"]=$roupa["foto1"];
    $roupaT["foto2"]=$roupa["foto2"];
    $roupaT["foto3"]=$roupa["foto3"];
    $roupaT["sexo"]=$roupa["sexo"];
    return R::store($roupaT);
}
function atualizarRoupa($roupa,$id){
    $roupaT=R::load("roupa",$id);
    $roupaT["tipo"]=$roupa["tipo"];
    $roupaT["estado"]=$roupa["estado"];
    $roupaT["descricao"]=$roupa["descricao"];
    $roupaT["categoria"]=$roupa["categoria"];
    $roupaT["nome"]=$roupa["nome"];
    $roupaT["foto1"]=$roupa["foto1"];
    $roupaT["foto2"]=$roupa["foto2"];
    $roupaT["foto3"]=$roupa["foto3"];
    $roupaT["sexo"]=$roupa["sexo"];
    return R::store($roupaT);

}
function deletarRoupa($id,$idUsuario){
    $roupa=R::findOne("roupa","id=? AND usuario_id=?",[$id,$idUsuario]);
    return R::trash($roupa);
}
function listarRoupa($idUsuario){
    $list=R::findAll("roupa","usuario_id=?",[$idUsuario]);
    $aux = [];
    $count = 0;
    foreach($list as $lista){ 
        $aux[$count] = $lista;
        $count++;
    }
    return $aux;
    
}

?>
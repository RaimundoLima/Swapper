<?php
include_once('Setup.php');

function buscarRoupa($id){
    return R::load("roupa",$id);

}
function inserirRoupa($roupa){
    $roupaT=R::dispense("roupa");
    $roupaT["usuario"]=R::load("usuario",$roupa["usuario"]);
    $roupaT["disponibilidade"]=$roupa["disponibilidade"];
    $roupaT["tipo"]=$roupa["tipo"];
    $roupaT["estado"]=$roupa["estado"];
    $roupaT["descricao"]=$roupa["descricao"];
    $roupaT["categoria"]=$roupa["categoria"];
    $roupaT["nome"]=$roupa["nome"];
    $roupaT["tamanho"]=$roupa["tamanho"];
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
    $roupaT["tamanho"]=$roupa["tamanho"];
    $roupaT["foto1"]=$roupa["foto1"];
    $roupaT["foto2"]=$roupa["foto2"];
    $roupaT["foto3"]=$roupa["foto3"];
    $roupaT["sexo"]=$roupa["sexo"];

}
function deletarRoupa($id){
    $roupa=R::load("roupa",$id);
    R::trash($roupa);

}
function listarRoupa($idUsuario){
    return R::findAll("roupa","usuario_id=".$idUsuario);
}

?>
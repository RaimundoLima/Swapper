<?php
include_once('Setup.php');


function buscarChat($id){
    return R::load("chat",$id);

}
function inserirChat($chat){
    $chatT=R::dispense('chat');//rework
    $chatT[""]=$chat[""];

}
function atualizarChat($disponibilidade,$id){
    //rework
}

function listarChat($idUsuario){
    return R::find('chat',"(usuario1_id=".$idUsuario." OR usuario2_id=".$idUsuario.") AND disponibilidade=1");
    //rework
}

?>
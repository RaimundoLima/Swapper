<?php
include_once('Setup.php');


function buscarChat($id){
    return R::load("chat",$id);

}
function inserirChat($chat){
    $chatT=R::dispense('chat');//rework
    $chatT["match"]=buscarMatch($chat["match"]);
    $chatT["disponibilidade"]=1;
    $mensagemT["horario"]=time();
    $mensagemT["conteudo"]="Voce deu um Match";
    $mensagemT["visualizado"]=0;
    $mensagemT["chat"]=R::store($chatT);
    $mensagemT["usuario"]='';
    inserirMensagem($mensagemT);
}
function atualizarChat($disponibilidade,$id){
    //rework
}
function listarChat($idUsuario){
    $matchs=R::findAll('match',"(like_status=3) AND (usuario1_id=? OR usuario2_id=?)",[$idUsuario,$idUsuario]);
    $count=0;
    $chats=[];
    foreach ($matchs as $match) {
    	$chats[$count]=R::findOne('chat',"match_id=?",[$match["id"]]);
    	$count++;
    }
    return $chats;
}
?>
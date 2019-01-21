<?php
include_once('Setup.php');

function buscarMensagem($id){
    return R::load("mensagem",$id);

}
function inserirMensagem($mensagem){
    $mensagemT=R::dispense("mensagem");
    $mensagemT["horario"]=$mensagem["horario"];
    $mensagemT["conteudo"]=$mensagem["conteudo"];
    $mensagemT["visualizado"]=$mensagem["visualizado"];
    $mensagemT["chat_id"]=R::load("chat",$mensagem["chat_id"]);
    $mensagemT["usuario_id"]=R::load("usuario",$mensagem["usuario_id"]);

}

function listarMensagem($idChat){
    return R::findAll("mensagem","chat_id=".$idChat);//fazer variações
}

?>
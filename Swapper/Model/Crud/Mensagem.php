<?php
include_once('Setup.php');

function buscarMensagem($id){
    return R::load("mensagem",$id);

}
function inserirMensagem($mensagem){
    $mensagemT=R::dispense("mensagem");
    $mensagemT["horario"]=$mensagem["horario"];
    $mensagemT["conteudo"]=$mensagem["conteudo"];
    $mensagemT["visualizado"]=0;
    $mensagemT["chat"]=R::load("chat",$mensagem["chat"]);
    $mensagemT["usuario"]=R::load("usuario",$mensagem["usuario"]);
    echo R::store($mensagemT);

}

function listarMensagem($idChat){
    return R::findAll("mensagem","chat_id=".$idChat);//fazer variações
}

?>
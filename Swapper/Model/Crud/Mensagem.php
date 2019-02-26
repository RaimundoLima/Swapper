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
    if($mensagem["usuario"]==''){
    	$mensagemT["usuario"]=null;
    }else{
    	$mensagemT["usuario"]=R::load("usuario",$mensagem["usuario"]);
	}
    echo R::store($mensagemT);

}

function listarMensagem($idChat){
    $mensagens=R::findAll("mensagem","chat_id=? ORDER BY id DESC",[$idChat]);//fazer variações
    $count=0;
    $msgs=[];
    foreach ($mensagens as $mensagem) {
    	$msgs[$count]=R::findOne('mensagem',"id=?",[$mensagem["id"]]);
    	$count++;
    }
    return $msgs;
}

?>
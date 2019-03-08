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
    	$mensagemT["usuario"]=$mensagem["usuario"];
	}
    echo R::store($mensagemT);

}

function listarMensagem($idChat){
    $mensagens=R::findAll("mensagem","chat_id=? ORDER BY id DESC LIMIT 15",[$idChat]);//fazer variações
    $count=0;
    $msgs=[];
    foreach ($mensagens as $mensagem) {
    	$msgs[$count]=R::findOne('mensagem',"id=?",[$mensagem["id"]]);
    	$count++;
    }
    return $msgs;
}
function listarMensagemData($idChat,$date){
    $mensagens=R::findAll("mensagem","chat_id=? ORDER BY id ",[$idChat]);//fazer variações
    $count=0;
    $msgs=[];
    foreach ($mensagens as $mensagem) {
        //error_log(print_r((int)(R::findOne('mensagem',"id=?",[$mensagem["id"]])['horario']*1)>(int)($date),true));
        if((int)(R::findOne('mensagem',"id=?",[$mensagem["id"]])['horario']*1)>(int)($date)){
            //error_log(print_r("ta rodando",true));
            $msgs[$count]=R::findOne('mensagem',"id=?",[$mensagem["id"]]);
            $count++;
        }
    }
    return $msgs;
}

?>
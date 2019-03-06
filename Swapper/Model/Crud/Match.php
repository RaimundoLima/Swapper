<?php
include_once('Setup.php');

function buscarMatch($id){
    return R::load("match",$id);
}
function buscarMatchUsuario2($chat,$idUsuario1){

    $match=R::findOne('match','id=? ',[$chat['match_id']]);
    if($match['usuario1_id']==$idUsuario1){
        return $match['usuario2_id'];
    }
    if($match['usuario2_id']==$idUsuario1){
        return $match['usuario1_id'];
    }
}
function buscarMatchUsuarios($match){
    $matchT=R::findOne("match",'(usuario1_id=? AND usuario2_id=?) OR (usuario1_id=? AND usuario2_id=?) ',
                    [$match['usuario1'],$match['usuario2'],$match['usuario2'],$match['usuario1']]);            
    return $matchT;
}
function inserirMatch($match){
    $matchT=buscarMatchUsuarios($match);
    //error_log(print_r($match,true));
    if(empty($matchT)){
        $matchT=R::dispense('match');
        $matchT["usuario1"]=R::load('usuario',$match["usuario1"]);
        $matchT["usuario2"]=R::load('usuario',$match["usuario2"]);
        $matchT["like_status"]=$match['like_status'];
        $matchT["ultimo_usuario_a_ser_likado"]=R::load('usuario',$match["usuario2"]);
        $matchT["date"]=$match["date"];
        return R::store($matchT);
    }else if($matchT['usuario1_id']!=$match["usuario1"]){
        if(($matchT['like_status']==1 || $matchT['like_status']==2) && ($match['like_status']==1 || $match['like_status']==2) ){
            $matchT['like_status']=3;
            $matchT["ultimo_usuario_a_ser_likado"]=R::load('usuario',$match["usuario1"]);
            $matchT['date']=$matchT['date'];
            $chat=[
                'match'=>R::store($matchT)
            ];
            //error_log(print_r($matchT,true));
            inserirChat($chat);
            return $matchT;
        }else if($match['like_status']==0){
            $matchT["like_status"]=$match['like_status'];
            $matchT["date"]=$match["date"]*1;
            $matchT["ultimo_usuario_a_ser_likado"]=R::load('usuario',$match["usuario1"]);
            return R::store($matchT);
        }
    }
}
function listarMatch(){
    return R::findAll('match');//fazer variações   
}

?>
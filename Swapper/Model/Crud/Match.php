<?php
include_once('Setup.php');

function buscarMatch($id){
    return R::load("match",$id);

}
function buscarMatchUsuarios($match){
    $matchT=R::find("match","(usuario1_id=? AND usuario2_id=?)
                              OR
                              usuario1_id=? AND usuario2_id=? ",
                              [$match['usuario1'],
                              $match['usuario2'],
                              $match['usuario2'],
                              $match['usuario1']]);
    return $matchT;
}
function inserirMatch($match){
    $matchT=buscarMatchUsuarios($match);
    if(empty($matchT)){
        $matchT=R::dispense('match');
        $matchT["usuario1"]=R::load('usuario',$match["usuario1"]);
        $matchT["usuario2"]=R::load('usuario',$match["usuario2"]);
        $matchT["likeStatus"]=$match['likeStatus'];
        $matchT["date"]=$match["date"];
        return R::store($matchT);
    }else{
    if(($matchT['likeStatus']==1 || $matchT['likeStatus']==2) && ($match['likeStatus']==1 || $match['likeStatus']==2) ){
        $matchT['likeStatus']=3;
        R::store($matchT);
        //$match[]
        inserirChat();
    }
        
    }
}
function listarMatch(){
    return R::findAll('match');//fazer variações   
}

?>
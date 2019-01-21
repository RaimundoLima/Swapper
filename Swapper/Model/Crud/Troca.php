<?php
include_once('Setup.php');

function buscarTroca($id){
    return R::load("troca",$id);

}
function inserirTroca($troca){
    $trocaT=R::dispense("troca");
    $trocaT["usuario1_id"]=R::load('usuario',$troca["usuario1_id"]);
    $trocaT["usuario2_id"]=R::load('usuario',$troca["usuario1_id"]);
    $trocaT["estado"]=$troca["estado"];
    $trocaT["itens1"]=$troca["itens1"];
    $trocaT["itens2"]=$troca["itens2"];
}

?>
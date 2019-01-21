<?php
include_once('Setup.php');

function buscarConfig($id){
    return R::load("config",$id);
}
function inserirConfig($config){
    $configT=R::dispense("config");
    $configT["usuario"]=R::load("usuario",$config['usuario']);
    $configT["distancia"]=50;
    $configT["masculino"]=1;
    $configT["feminino"]=1;
    $configT["adulto"]=1;
    $configT["infantil"]=1;
    $configT["roupa"]=1;
    $configT["acessorio"]=1;
    $configT["calcado"]=1;
    $configT["novo"]=1;
    $configT["usado"]=1;
    return R::store($configT);
}
function atualizarConfig($config,$id){
    $configT=R::load("config",$id);
    $configT["distancia"]=$config["distancia"];
    $configT["masculino"]=$config["masculino"];
    $configT["feminino"]=$config["feminino"];
    $configT["adulto"]=$config["adulto"];
    $configT["infantil"]=$config["infantil"];
    $configT["roupa"]=$config["roupa"];
    $configT["acessorio"]=$config["acessorio"];
    $configT["calcado"]=$config["calcado"];
    $configT["novo"]=$config["novo"];
    $configT["usado"]=$config["usado"];
    return R::store($configT);
}

?>
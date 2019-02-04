<?php
include_once('Setup.php');

function buscarUsuario($id){
    return R::load('usuario',$id);
}
function buscarUsuarioLogin($usuario){
    return R::findOne('usuario','email=? AND senha=?',
    [$usuario['email'],$usuario['senha']]);
}
function buscarUsuarioEmail($usuario){
    return R::findOne('usuario','email=?',
    [$usuario['email']]);
}
function inserirUsuario($usuario){
    $usuarioT=R::dispense('usuario');
    $usuarioT['sexo']=$usuario['sexo'];
    $usuarioT['email']=$usuario['email'];
    $usuarioT['senha']=($usuario['senha']);
    $usuarioT['celular']=$usuario['celular'];
    $usuarioT['nome']=$usuario['nome'];
    $usuarioT['nascimento']=$usuario['nascimento'];
    $usuarioT['localizacao']=$usuario['localizacao'];
    $usuarioT['bio']=$usuario['bio'];
    $usuarioT['foto']=$usuario['foto'];
    
    $config['usuario']=R::store($usuarioT);
    return inserirConfig($config);
}
function atualizarUsuario($usuario,$id){
    $usuarioT=R::load('usuario',$id);
    $usuarioT['sexo']=$usuario['sexo'];
    $usuarioT['email']=$usuario['email'];
    $usuarioT['senha']=$usuario['senha'];
    $usuarioT['celular']=$usuario['celular'];
    $usuarioT['nome']=$usuario['nome'];
    $usuarioT['nascimento']=$usuario['nascimento'];
    $usuarioT['localizacao']=$usuario['localizacao'];
    $usuarioT['bio']=$usuario['bio'];
    $usuarioT['foto']=$usuario['foto'];
    return R::store($usuarioT);
}

function listarUsuario(){
    //a definir
}

?>
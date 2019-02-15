<?php
include_once('Setup.php');

function buscarUsuario($id){
    return R::load('usuario',$id);
}
function buscarUsuarioLocalizacao($id){
    $usuario=buscarUsuario($id);
    $list=R::findAll('usuario',"id!=? AND latitude<=? AND latitude>=? AND longitude<=? AND longitude>=?",
        [$usuario['id'],$usuario["latitude"]+1.5,$usuario["latitude"]-1.5,$usuario["longitude"]+2,$usuario["longitude"]-2]);
    
    $usuario=buscarUsuario($id);
    $list=R::findAll('usuario',"id!=? AND latitude<=? AND latitude>=? AND longitude<=? AND longitude>=?",[$usuario['id'],$usuario["latitude"]+1.5,$usuario["latitude"]-1.5,$usuario["longitude"]+2,$usuario["longitude"]-2]);
    $filtro=buscarConfig($id);
    $aux = [];
    $count = 0;
    foreach($list as $lista){ 
        if($filtro["distancia"] >= round(6371*acos(cos(deg2rad(90-$usuario["latitude"]))*cos(deg2rad(90-$lista["latitude"]))+sin(deg2rad(90-$usuario["latitude"]))*sin(deg2rad(90-$lista["latitude"]))*cos(deg2rad($usuario["longitude"]-$lista["longitude"]))))){
           $aux[$count] = $lista;
           $count++;
        }
    }
    //ALTER TABLE usuario ALTER COLUMN longitude SET DATA TYPE float USING longitude::double precision;
    //Latitude_do_usuario_logado+1.5 >= Latitude && Latitude_do_usuario_logado-1.5 <= Latitude
    // Longitude_do_usuario_logado+2 >= Latitude && Longitude_do_usuario_logado-2 <= Latitude
    return $aux;//round(6371*acos(cos(deg2rad(90-$usuario["latitude"]))*cos(deg2rad(90-$list[0]["latitude"]))+sin(deg2rad(90-$usuario["latitude"]))*sin(deg2rad(90-$list[0]["latitude"]))*cos(deg2rad($usuario["longitude"]-$list[0]["longitude"]))));

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
    $usuarioT['latitude']=$usuario['latitude'];
    $usuarioT['longitude']=$usuario['longitude'];
    $usuarioT['bio']=$usuario['bio'];
    $usuarioT['foto']=$usuario['foto'];

    $usuarioT['credibilidade']=0;
    
    $config['usuario']=R::store($usuarioT);
    return inserirConfig($config);
}
function atualizarUsuarioFoto($usuario,$id){
    $usuarioT=R::load('usuario',$id);
    $usuarioT['foto']=$usuario['foto'];
    return R::store($usuarioT);
}
function atualizarUsuarioPos($usuario,$id){
    $usuarioT=R::load('usuario',$id);
    $usuarioT['latitude']=$usuario['latitude'];
    $usuarioT['longitude']=$usuario['longitude'];
    return R::store($usuarioT);
}

function listarUsuario(){
    //a definir
}

?>
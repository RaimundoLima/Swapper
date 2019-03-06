<?php
include_once('Setup.php');

function buscarUsuario($id){
    return R::findOne('usuario','id=?',[$id]);
}
function buscarUsuarioLocalizacao($id){
    $usuario=buscarUsuario($id);
    $list=R::findAll('usuario',"id!=? AND latitude<=? AND latitude>=? AND longitude<=? AND longitude>=?",[$usuario['id'],$usuario["latitude"]+1.5,$usuario["latitude"]-1.5,$usuario["longitude"]+2,$usuario["longitude"]-2]);
    $filtro=buscarConfig($id);
    $listaDeUsuarios = [];
    $count = 0;
    foreach($list as $lista){ 
        $teste=ceil(6371*acos(sin(deg2rad(90-$usuario["latitude"]))*sin(deg2rad(90-$lista["latitude"]))+cos(deg2rad(90-$usuario["latitude"]))*cos(deg2rad(90-$lista["latitude"]))*cos(deg2rad($usuario["longitude"]-$lista["longitude"]))));
        if($filtro["distancia"] >= ceil(6371*acos(sin(deg2rad(90-$usuario["latitude"]))*sin(deg2rad(90-$lista["latitude"]))+cos(deg2rad(90-$usuario["latitude"]))*cos(deg2rad(90-$lista["latitude"]))*cos(deg2rad($usuario["longitude"]-$lista["longitude"]))))){//distancia
            //error_log(print_r($teste,true));

            $match['usuario1']=$usuario['id'];
            $match['usuario2']=$lista['id'];
            $auxMatch=buscarMatchUsuarios($match);
            if(empty($auxMatch) || ($auxMatch['likeStatus']!=3 && ($auxMatch['likeStatus']!=0 || ($auxMatch['date']+(24*60*60*1000)*15)<ceil(microtime(true)*1000)) && $auxMatch['ultimoUsuarioASerLikado_id']==$id)){//match
            
                $roupas=listarRoupa($lista['id']);
                $roupasSelecionadas=[];
                $sql="";
                foreach ($roupas as $roupa) {
                    $sql="(id=".$roupa["id"].") AND ";
                    if($filtro['masculino']==1 && $filtro['feminino']==1){
                        $sql.="(".$roupa['sexo']."=?) AND ";
                    }else if($filtro['masculino']==1){
                        $sql.="(1=?) AND ";
                    }else if($filtro['feminino']==1){
                        $sql.="(2=?) AND ";
                    }
                    if($filtro['infantil']==1 && $filtro['adulto']==1){
                        $sql.="(".$roupa['categoria']."=?) AND ";
                    }else if($filtro['infantil']==1){
                        $sql.="(1=?) AND ";
                    }else if($filtro['adulto']==1){
                        $sql.="(2=?) AND ";
                    }
                    if($filtro['novo']==1 && $filtro['usado']==1){
                        $sql.="(".$roupa['estado']."=?) AND ";
                    }else if($filtro['novo']==1){
                        $sql.="(1=?) AND ";
                    }else if($filtro['usado']==1){
                        $sql.="(2=?) AND ";
                    }
                    if($filtro['roupa']==1 && $filtro['acessorio']==1 && $filtro['calcado']==1){
                        $sql.="(".$roupa['tipo']."=".$roupa['tipo'].")";
                    }else if($filtro['roupa']==1 && $filtro['acessorio']==1){
                        $sql.="(1=".$roupa['tipo']." OR 2=".$roupa['tipo'].")";
                    }else if($filtro['acessorio']==1 &&  $filtro['calcado']==1){
                        $sql.="(2=".$roupa['tipo']." OR 3=".$roupa['tipo'].")";
                    }else if($filtro['roupa']==1 && $filtro['calcado']==1){
                        $sql.="(1=".$roupa['tipo']." OR 3=".$roupa['tipo'].")";
                    }else if($filtro['roupa']==1){
                        $sql.="(1=".$roupa['tipo'].")";
                    }else if($filtro['acessorio']==1){
                        $sql.="(2=".$roupa['tipo'].")";
                    }else if($filtro['calcado']==1){
                        $sql.="(3=".$roupa['tipo'].")";
                    }
                    $roupafiltrada=R::findOne('roupa',$sql,[$roupa['sexo'],$roupa['categoria'],$roupa['estado']]);
                    if(empty($roupasSelecionadas[0])){
                        
                        $roupasSelecionadas[0]=$roupafiltrada;
                    }else if(empty($roupasSelecionadas[1])){
                        $roupasSelecionadas[1]=$roupafiltrada;
                    }else if(empty($roupasSelecionadas[2])){
                        $roupasSelecionadas[2]=$roupafiltrada;
                    } 
               }

                if(!empty($roupasSelecionadas[0]) && !empty($roupasSelecionadas[1]) && !empty($roupasSelecionadas[2])){
                    $listaDeUsuarios[$count]['usuario'] = $lista;
                    $listaDeUsuarios[$count]['roupa'][0]=$roupasSelecionadas[0];
                    $listaDeUsuarios[$count]['roupa'][1]=$roupasSelecionadas[1];
                    $listaDeUsuarios[$count]['roupa'][2]=$roupasSelecionadas[2];
                    $count++;
               }else if(!empty($roupasSelecionadas[0]) && !empty($roupasSelecionadas[1])){
                    $listaDeUsuarios[$count]['usuario'] = $lista;
                    $listaDeUsuarios[$count]['roupa'][0]=$roupasSelecionadas[0];
                    $listaDeUsuarios[$count]['roupa'][1]=$roupasSelecionadas[1];
                    $listaDeUsuarios[$count]['roupa'][2]=R::findOne('roupa',"usuario_id=? AND id!=? AND id!=?",[$lista['id'],$listaDeUsuarios[$count]['roupa'][0]["id"],$listaDeUsuarios[$count]['roupa'][1]["id"]]);
                    $count++;
               }else if(!empty($roupasSelecionadas[0])){
                    $listaDeUsuarios[$count]['usuario'] = $lista;
                    $listaDeUsuarios[$count]['roupa'][0]=$roupasSelecionadas[0];
                    $listaDeUsuarios[$count]['roupa'][1]=R::findOne('roupa',"usuario_id=? AND id!=?",[$lista['id'],$listaDeUsuarios[$count]['roupa'][0]["id"]]);
                    $listaDeUsuarios[$count]['roupa'][2]=R::findOne('roupa',"usuario_id=? AND id!=? AND id!=?",[$lista['id'],$listaDeUsuarios[$count]['roupa'][0]["id"],$listaDeUsuarios[$count]['roupa'][1]["id"]]);
                    $count++;
               }
            }
        }
    }
    //ALTER TABLE usuario ALTER COLUMN longitude SET DATA TYPE float USING longitude::double precision;
    //Latitude_do_usuario_logado+1.5 >= Latitude && Latitude_do_usuario_logado-1.5 <= Latitude
    // Longitude_do_usuario_logado+2 >= Latitude && Longitude_do_usuario_logado-2 <= Latitude
    //round(6371*acos(cos(deg2rad(90-$usuario["latitude"]))*cos(deg2rad(90-$list[0]["latitude"]))+sin(deg2rad(90-$usuario["latitude"]))*sin(deg2rad(90-$list[0]["latitude"]))*cos(deg2rad($usuario["longitude"]-$list[0]["longitude"]))));

    return $listaDeUsuarios;

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
    $usuarioT['superLike']=0;
    $usuarioT['foto']=$usuario['foto'];

    $usuarioT['credibilidade']=0;
    
    $config['usuario']=R::store($usuarioT);
    return inserirConfig($config);
}
function atualizarUsuarioSuperLike($superLike,$id){
    $usuarioT=R::load('usuario',$id);
    $usuarioT['superLike']=$superLike;
    return R::store($usuarioT);
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
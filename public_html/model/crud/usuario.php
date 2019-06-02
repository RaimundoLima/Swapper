<?php

    include_once('setup.php');
    include_once('config.php');
    include_once('match.php');
    include_once('roupa.php');

    function buscarUsuario($id){
        return R::findOne('usuario', 'id=?', [$id]);
    }

    function buscarUsuarioLocalizacao($id) {
        $usuario = buscarUsuario($id);
        $list = R::findAll('usuario','id!=? AND latitude<=? AND latitude>=? AND longitude<=? AND longitude>=?',[$usuario['id'],$usuario['latitude']+1.5,$usuario['latitude']-1.5,$usuario['longitude']+2,$usuario['longitude']-2]);
        $filtro = buscarConfig($id);
        $listaDeUsuarios = [];
        $count = 0;
        
        foreach($list as $lista) {
            $distancia = ceil(6371*acos(sin(deg2rad(90-$usuario['latitude']))*sin(deg2rad(90-$lista['latitude']))+cos(deg2rad(90-$usuario['latitude']))*cos(deg2rad(90-$lista['latitude']))*cos(deg2rad($usuario['longitude']-$lista['longitude']))));
            
            if($filtro['distancia'] >= $distancia) {
                $match['usuario1'] = $usuario['id'];
                $match['usuario2'] = $lista['id'];
                $auxMatch = buscarMatchUsuarios($match);

                if (empty($auxMatch) || ($auxMatch['likeStatus']!=3 && ($auxMatch['likeStatus']!=0 || ($auxMatch['date']+(24*60*60*1000)*15)<ceil(microtime(true)*1000)) && $auxMatch['ultimoUsuarioASerLikado_id'] == $id)) {
                    $roupas = listarRoupa($lista['id']);
                    $roupasSelecionadas = [];
                    $sql = '';

                    foreach ($roupas as $roupa) {
                        $sql = '(id='.$roupa['id'].') AND ';

                        if ($filtro['masculino'] == 1 && $filtro['feminino'] == 1) {
                            $sql.='('.$roupa['sexo'].'=?) AND ';
                        } else if ($filtro['masculino'] == 1) {
                            $sql.='(1=?) AND ';
                        } else if ($filtro['feminino'] == 1) {
                            $sql.='(2=?) AND ';
                        }

                        if ($filtro['infantil'] == 1 && $filtro['adulto'] == 1) {
                            $sql.='('.$roupa['categoria'].'=?) AND ';
                        } else if ($filtro['infantil'] == 1) {
                            $sql.='(1=?) AND ';
                        } else if($filtro['adulto'] == 1) {
                            $sql.='(2=?) AND ';
                        }

                        if ($filtro['novo'] == 1 && $filtro['usado'] == 1) {
                            $sql.='('.$roupa['estado'].'=?) AND ';
                        } else if ($filtro['novo'] == 1) {
                            $sql.='(1=?) AND ';
                        } else if ($filtro['usado'] == 1) {
                            $sql.='(2=?) AND ';
                        }

                        if ($filtro['roupa'] == 1 && $filtro['acessorio'] == 1 && $filtro['calcado'] == 1) {
                            $sql.='('.$roupa['tipo'].'='.$roupa['tipo'].')';
                        } else if ($filtro['roupa'] == 1 && $filtro['acessorio'] == 1) {
                            $sql.='(1='.$roupa['tipo'].' OR 2='.$roupa['tipo'].')';
                        } else if ($filtro['acessorio'] == 1 && $filtro['calcado'] == 1) {
                            $sql.='(2='.$roupa['tipo'].' OR 3='.$roupa['tipo'].')';
                        } else if ($filtro['roupa'] == 1 && $filtro['calcado'] == 1) {
                            $sql.='(1='.$roupa['tipo'].' OR 3='.$roupa['tipo'].')';
                        } else if ($filtro['roupa'] == 1) {
                            $sql.='(1='.$roupa['tipo'].')';
                        } else if ($filtro['acessorio'] == 1) {
                            $sql.='(2='.$roupa['tipo'].')';
                        } else if ($filtro['calcado']==1) {
                            $sql.='(3='.$roupa['tipo'].')';
                        }

                        $roupafiltrada = R::findOne('roupa',$sql,[$roupa['sexo'],$roupa['categoria'],$roupa['estado']]);

                        if (empty($roupasSelecionadas[0])) {
                            $roupasSelecionadas[0] = $roupafiltrada;
                        } else if (empty($roupasSelecionadas[1])) {
                            $roupasSelecionadas[1] = $roupafiltrada;
                        }else if (empty($roupasSelecionadas[2])) {
                            $roupasSelecionadas[2] = $roupafiltrada;
                        }
                    }

                    if (!empty($roupasSelecionadas[0]) && !empty($roupasSelecionadas[1]) && !empty($roupasSelecionadas[2])) {
                        $listaDeUsuarios[$count]['usuario'] = $lista;
                        $listaDeUsuarios[$count]['roupa'][0] = $roupasSelecionadas[0];
                        $listaDeUsuarios[$count]['roupa'][1] = $roupasSelecionadas[1];
                        $listaDeUsuarios[$count]['roupa'][2] = $roupasSelecionadas[2];
                        $count++;
                    } else if (!empty($roupasSelecionadas[0]) && !empty($roupasSelecionadas[1])) {
                        $listaDeUsuarios[$count]['usuario'] = $lista;
                        $listaDeUsuarios[$count]['roupa'][0] = $roupasSelecionadas[0];
                        $listaDeUsuarios[$count]['roupa'][1] = $roupasSelecionadas[1];
                        $listaDeUsuarios[$count]['roupa'][2] = R::findOne('roupa', 'usuario_id=? AND id!=? AND id!=?', [$lista['id'], $listaDeUsuarios[$count]['roupa'][0]['id'], $listaDeUsuarios[$count]['roupa'][1]['id']]);
                        $count++;
                    }else if (!empty($roupasSelecionadas[0])) {
                        $listaDeUsuarios[$count]['usuario'] = $lista;
                        $listaDeUsuarios[$count]['roupa'][0] = $roupasSelecionadas[0];
                        $listaDeUsuarios[$count]['roupa'][1] = R::findOne('roupa', 'usuario_id=? AND id!=?', [$lista['id'], $listaDeUsuarios[$count]['roupa'][0]['id']]);
                        $listaDeUsuarios[$count]['roupa'][2] = R::findOne('roupa', 'usuario_id=? AND id!=? AND id!=?', [$lista['id'], $listaDeUsuarios[$count]['roupa'][0]['id'], $listaDeUsuarios[$count]['roupa'][1]['id']]);
                        $count++;
                    }
                }
            }
        }

        return $listaDeUsuarios;
    }

    function buscarUsuarioLogin($usuario) {
        return R::findOne('usuario','email=? AND senha=?',
        [$usuario['email'],$usuario['senha']]);
    }

    function buscarUsuarioEmail($usuario) {
        return R::findOne('usuario', 'email=?', [$usuario['email']]);
    }

    function inserirUsuario($usuario) {
        $usuarioT = R::dispense('usuario');

        $usuarioT['nome'] = $usuario['nome'];
        $usuarioT['email'] = $usuario['email'];
        $usuarioT['sexo'] = $usuario['sexo'];
        $usuarioT['nascimento'] = $usuario['nascimento'];
        $usuarioT['senha'] = ($usuario['senha']);
        $usuarioT['foto'] = $usuario['foto'];
        $usuarioT['latitude'] = $usuario['latitude'];
        $usuarioT['longitude'] = $usuario['longitude'];
        $usuarioT['verificado'] = $usuario['verificado'];
        $usuarioT['chavesecreta'] = $usuario['chavesecreta'];
        $usuarioT['superLike'] = 0;
        $usuarioT['credibilidade'] = 0;

        $config['usuario'] = R::store($usuarioT);

        return inserirConfig($config);
    }

    function atualizarUsuarioSuperLike($superLike, $id) {
        $usuarioT = R::load('usuario', $id);
        $usuarioT['superLike'] = $superLike;

        return R::store($usuarioT);
    }

    function atualizarUsuarioFoto($foto, $id) {
        $usuarioT = R::load('usuario', $id);
        $usuarioT['foto'] = $foto;

        return R::store($usuarioT);
    }

    function atualizarUsuarioPos($usuario, $id) {
        $usuarioT = R::load('usuario', $id);
        $usuarioT['latitude'] = $usuario['latitude'];
        $usuarioT['longitude'] = $usuario['longitude'];

        return R::store($usuarioT);
    }

    function atualizarVerificacaoUsuario($usuario, $id) {
        $usuarioT = R::load('usuario', $id);
        $usuarioT['verificado'] = $usuario['verificado'];

        return R::store($usuarioT);
    }

    function atualizarSenha($usuario, $id) {
        $usuarioT = R::load('usuario', $id);
        $usuarioT['senha'] = $usuario['senha'];

        return R::store($usuarioT);
    }

    function atualizarChaveSecreta($chaveSecreta, $id) {
        $usuarioT = R::load('usuario', $id);
        $usuarioT['chavesecreta'] = $chaveSecreta;

        return R::store($usuarioT);
    }

?>
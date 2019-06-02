<?php

    $ds = DIRECTORY_SEPARATOR;
    $baseDir = realpath(dirname(__FILE__).$ds.'..'.$ds.'..'.$ds.'..'.$ds.'..');

    include_once($baseDir.'/public_html/model/crud/usuario.php');
    include_once($baseDir.'/public_html/model/distancia.php');

    function getUsuariosProximos($userId, $lat, $long) {
        $data = [];
        $usuarios = buscarUsuarioLocalizacao($userId);
        $latUsuarioLogado = $lat;
        $longUsuarioLogado = $long;

        foreach ($usuarios as $indice => $usuario) {
            $latOutroUsuario = $usuario['usuario']['latitude'];
            $longEntreUsuarios = $longUsuarioLogado - $usuario['usuario']['longitude'];
            $distancia = new Distancia($latUsuarioLogado, $latOutroUsuario, $longEntreUsuarios);
            $distanciaEntreUsuarios = $distancia->getDistancia();

            $data[$indice]['usuario']['id'] = $usuario['usuario']['id'];
            $data[$indice]['usuario']['nome'] = $usuario['usuario']['nome'];
            $data[$indice]['usuario']['foto'] = $usuario['usuario']['foto'];
            $data[$indice]['usuario']['distancia'] = ($distanciaEntreUsuarios <= 1) ? 1 : $distanciaEntreUsuarios;

            foreach ($usuario['roupa'] as $i => $roupa) {
                $data[$indice]['roupa'][$i]['id'] = $roupa['id'];
                $data[$indice]['roupa'][$i]['nome'] = $roupa['nome'];

                for ($j = 0; $j < 3; $j++) {
                    $data[$indice]['roupa'][$i]['foto'.$j] = $roupa['foto'.$j];
                }
            }
        }

        return $data;
    }

?>
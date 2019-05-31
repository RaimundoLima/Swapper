<?php

    include_once('model/crud/usuario.php');
    include_once('model/distancia.php');
    include_once('./../model/crud/redBean/rb-postgres.php');

    session_start();

    $USER_UNSERIALIZED = unserialize($_SESSION['usuario']);

    function getUsuariosProximos() {
        $data = [];
        $usuarios = buscarUsuarioLocalizacao($USER_UNSERIALIZED['id']);
        $latUsuarioLogado = $USER_UNSERIALIZED['latitude'];
        $longUsuarioLogado = $USER_UNSERIALIZED['longitude'];

        foreach ($usuarios as $indice => $usuario) {
            $latOutroUsuario = $usuario['usuario']['latitude'];
            $longEntreUsuarios = $longUsuarioLogado - $usuario['usuario']['longitude'];
            $distancia = new Distancia($latUsuarioLogado, $latOutroUsuario, $longEntreUsuarios);
            $distanciaEntreUsuarios = $distancia->getDistancia();

            $data[$indice]['usuario']['id'] = $usuario['usuario']['id'];
            $data[$indice]['usuario']['nome'] = $usuario['usuario']['nome'];
            $data[$indice]['usuario']['foto'] = $usuario['usuario']['foto'];
            $data[$indice]['usuario']['distancia'] = ($distanciaEntreUsuarios <= 1) ? 1 : $distanciaEntreUsuarios;

            foreach ($usuario['roupa'] as $indice => $roupa) {
                $data[$indice]['roupa'][$indice]['id'] = $roupa['id'];
                $data[$indice]['roupa'][$indice]['nome'] = $roupa['nome'];
                $data[$indice]['roupa'][$indice]['foto'] = $roupa['foto'];
            }
        }

        return $data;
    }

?>
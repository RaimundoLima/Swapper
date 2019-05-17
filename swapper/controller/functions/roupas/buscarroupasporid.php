<?php

    include_once('model/crud/roupa.php');
    include_once('model/crud/usuario.php');
    include_once('./../model/crud/redBean/rb-postgres.php');

    session_start();

    $USER_UNSERIALIZED = unserialize($_SESSION['usuario']);

    function getRoupasPorId($parametro) {
        $idUsuario = $USER_UNSERIALIZED['id'];
        $parametro = explode(',', $parametro);

        if (count($parametro) != 1) {
            $roupa = buscarRoupa($parametro[0], $parametro[1]);
            $roupa['usuario_id'] = buscarUsuario($parametro[1])['nome'];
        } else {
            $roupa = buscarRoupa($parametro[0], $idUsuario);
            $roupa['usuario_id'] = $USER_UNSERIALIZED['nome'];
        }

        return $roupa;
    }

?>
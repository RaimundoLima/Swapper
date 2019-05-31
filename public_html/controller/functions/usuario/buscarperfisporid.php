<?php

    include_once('model/crud/roupa.php');
    include_once('model/crud/usuario.php');

    function getUsuarioPorId($parametro) {
        $user = buscarUsuario($parametro);
        $data = [];
        $data['usuario']['id'] = $user['id'];
        $data['usuario']['foto'] = $user['foto'];
        $data['usuario']['nome'] = $user['nome'];
        $roupas = listarRoupa($parametro);

        foreach ($roupas as $indice => $roupa) {
            $data['roupa'][$indice]['id'] = $roupa['id'];
            $data['roupa'][$indice]['nome'] = $roupa['nome'];
            $data['roupa'][$indice]['foto1'] = $roupa['foto1'];
        }

        return $data;
    }

?>
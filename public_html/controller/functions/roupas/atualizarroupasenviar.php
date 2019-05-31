<?php

    include_once('model/crud/foto.php');
    include_once('model/crud/roupa.php');
    include_once('./../model/crud/redBean/rb-postgres.php');

    session_start();

    $USER_UNSERIALIZED = unserialize($_SESSION['usuario']);

    function atualizaRoupas($alteraImagens, $roupa, $files, $idRoupa) {
        $diretorio = '../imagens/roupas';
        $fotoClass = new Foto();
        $roupaUsuario = buscarRoupa($idRoupa, $USER_UNSERIALIZED['id']);

        for ($indice = 0; $indice < 3; $indice++) {
            if (existe($alteraImagens[$indice]) && existe($files[$indice])) {
                if ($alteraImagens[$indice] == 0) {
                    $caminhoFoto = $roupaUsuario['foto'.$indice];
                } else if ($alteraImagens[$indice] == 1) {
                    $caminhoFoto = $fotoClass->salvarFoto($files[$indice], $diretorio);
                } else {
                    $caminhoFoto = $roupaUsuario['foto'.$indice];
                    $fotoClass->deletarFoto($caminhoFoto);
                    $caminhoFoto = '';
                }
            }

            $roupa['foto'.$indice] = $caminhoFoto;
        }

        atualizarRoupa($roupa, $idRoupa);
    }

    function existe($elemento) {
        return (!empty($elemento));
    }

?>
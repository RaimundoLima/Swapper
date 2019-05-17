<?php

    include_once('model/crud/foto.php');
    include_once('model/crud/usuario.php');
    include_once('./../model/crud/redBean/rb-postgres.php');

    session_start();
    $USER_UNSERIALIZED = unserialize($_SESSION['usuario']);

    function atualizarFotoPerfil($foto) {
        $diretorio = 'usuario/';
        $fotoClass = new Foto();
        $caminhoImagem = $fotoClass->salvarFoto($foto, $diretorio);
        atualizarUsuarioFoto($caminhoImagem, $USER_UNSERIALIZED['id']);
        $usuario = buscarUsuario($USER_UNSERIALIZED['id']);
        $_SESSION['usuario'] = serialize($usuario);

        return $caminhoImagem;
    }

?>
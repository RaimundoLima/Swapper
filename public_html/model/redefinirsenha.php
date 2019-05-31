<?php

    $ds = DIRECTORY_SEPARATOR;
    $baseDir = realpath(dirname(__FILE__).$ds.'..');

    session_start();
    include_once($baseDir.'/model/crud/usuario.php');
    include_once($baseDir.'/model/crud/redBean/rb-postgres.php');

    $usuario = unserialize($_SESSION['usuario']);
    $userId = $usuario['id'];
    $url = $_SERVER['REQUEST_URI'];
    $chaveURL = explode('?', $url)[1];
    $senha = $_POST['senha'];

    redefinirSenha($userId, $senha, $chaveURL);

    function redefinirSenha($userId, $senha, $chaveURL) {
        $usuario = buscarUsuario($userId);
        $usuario['senha'] = sha1($senha);

        if ($chaveURL == $usuario['chavesecreta']) {
            atualizarSenha($usuario, $userId);
            atualizarChaveSecreta('', $userId);
            session_destroy();
            header('Location: http://'.$_SERVER['HTTP_HOST'].'/view/redefinido.html');
        }
    }

?>

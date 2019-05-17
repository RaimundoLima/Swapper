<?php

    $ds = DIRECTORY_SEPARATOR;
    $baseDir = realpath(dirname(__FILE__).$ds.'..'.$ds.'..'.$ds.'..');

    include_once($baseDir.'/model/crud/usuario.php');

    function verificarEmail($chave, $userId) {
        $usuario = buscarUsuario($userId);

        if ($chave == $usuario['chavesecreta']) {
            $usuario['verificado'] = 1;

            atualizarVerificacaoUsuario($usuario, $userId);

            header('Location: http://'.$_SERVER['HTTP_HOST'].'/view/verificado.html');
        }
    }

?>
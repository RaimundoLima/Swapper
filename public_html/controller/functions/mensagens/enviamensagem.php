<?php

    include_once('model/crud/mensagem.php');
    include_once('./../model/crud/redBean/rb-postgres.php');

    session_start();

    $USER_UNSERIALIZED = unserialize($_SESSION['usuario']);

    function enviarMensagem($texto, $idChat) {
        $mensagem = [];

        if ($texto) {
            $mensagem['horario'] = ceil(microtime(true) * 1000);
            $mensagem['mensagem'] = $texto;
            $mensagem['chat'] = $idChat;
            $mensagem['usuario'] = $USER_UNSERIALIZED['id'];

            inserirMensagem($mensagem);
        }
    }

?>
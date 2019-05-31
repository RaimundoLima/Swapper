<?php

    include_once('model/crud/mensagem.php');
    include_once('model/crud/usuario.php');
    include_once('model/crud/chat.php');
    include_once('./../model/crud/redBean/rb-postgres.php');

    session_start();

    $USER_UNSERIALIZED = unserialize($_SESSION['usuario']);

    function updateChat($idChat, $date) {
        $userId = $USER_UNSERIALIZED['id'];
        visualizarMensagens($idChat, $userId);
        $mensagens = listarMensagemData($idChat, $date);

        foreach ($mensagens as $mensagem) {
            $mensagem['usuario'] = (int) !($mensagem['usuario'] == $userId) + 1;

            if ($mensagem['usuario'] == null) {
                $mensagem['usuario'] = 0;
            }
        }

        return $mensagens;
    }

?>
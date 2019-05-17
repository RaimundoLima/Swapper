<?php

    include_once('model/crud/mensagem.php');
    include_once('./../model/crud/redBean/rb-postgres.php');

    session_start();
    
    $USER_UNSERIALIZED = unserialize($_SESSION['usuario']);

    function getMensagensAntigas($idChat, $scroll) {
        $data = [];
        $userId = $USER_UNSERIALIZED['id'];
        $mensagens = listarMensagemAntigas($idChat, $scroll);

        foreach ($mensagens as $mensagem) {
            $mensagem['usuario'] = (int) !($mensagem['usuario'] == $userId) + 1;

            if ($mensagem['usuario'] == null) {
                $mensagem['usuario'] = 0;
            }
        }

        $data['msgs'] = $mensagens;

        return $data;
    }
?>
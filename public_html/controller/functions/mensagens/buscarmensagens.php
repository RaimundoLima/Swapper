<?php

    include_once('model/crud/mensagem.php');
    include_once('model/crud/usuario.php');
    include_once('model/crud/chat.php');
    include_once('./../model/crud/redBean/rb-postgres.php');

    session_start();

    $USER_UNSERIALIZED = unserialize($_SESSION['usuario']);

    function getMensagens($idChat) {
        $userId = $USER_UNSERIALIZED['id'];
        $mensagens = listarMensagem($idChat);

        foreach ($mensagens as $mensagem) {
            $mensagem['usuario'] = (int) !($mensagem['usuario'] == $userId) + 1;

            if ($mensagem['usuario'] == null) {
                $mensagem['usuario'] = 0;
            }
        }

        $chat = buscarChat($idChat);
        $match = buscarMatch($chat['match_id']);

        $usuario = ($match['usuario1_id'] == $userId)
            ? buscarUsuario($match['usuario2_id'])
            : buscarUsuario($match['usuario1_id']);

        $data = [];
        $data['msgs'] = $mensagens;
        $data['usuario']['id'] = $usuario['id'];
        $data['usuario']['foto'] = $usuario['foto'];
        $data['usuario']['nome'] = $usuario['nome'];
        $data['usuario']['likeStatus'] = (int) ($chat['usuario_like1'] == 2 || $chat['usuario_like2'] == 2) + 1;

        return $data;
    }

?>
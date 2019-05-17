<?php

    include_once('./../model/crud/redBean/rb-postgres.php');

    session_start();

    $USER_UNSERIALIZED = unserialize($_SESSION['usuario']);

    function getChats() {
        $data = [];
        $userId = $USER_UNSERIALIZED['id'];
        $chats = listarChat($userId);

        foreach ($chats as $indice => $chat) {
            $outroUser = buscarUsuario(buscarMatchUsuario2($chat, $userId));
            $mensagem = listarMensagem($chat['id'])[0];

            $data[$indice]['nomeUsuario'] = $outroUser['nome'];
            $data[$indice]['fotoUsuario'] = $outroUser['foto'];
            $data[$indice]['idUsuario'] = (int) !($mensagem['usuario'] == $userId);
            $data[$indice]['conteudoMensagem'] = $mensagem['conteudo'];
            $data[$indice]['horarioMensagem'] = $mensagem['horario'];
            $data[$indice]['visualizacaoMensagem'] = $mensagem['visualizado'];
            $data[$indice]['idChat'] = $chat['id'];
            $data[$indice]['likeStatus'] = (int) ($chat['usuario_like1'] == 2 || $chat['usuario_like2'] == 2) + 1;
        }

        usort($data, 'cpm');
        return $data;
    }

    function cpm($a, $b) {
        return strcmp($a['horarioMensagem'], $b['horarioMensagem']);
    }

?>
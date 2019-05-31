<?php

    include_once('model/crud/chat.php');
    include_once('model/crud/match.php');
    include_once('model/crud/usuario.php');
    include_once('./../model/crud/redBean/rb-postgres.php');

    function like($match) {
        $userId = $match['usuario1'];
        $date = ceil(microtime(true) * 1000);
        $diaEmMilisegundos = (24 * 60 * 60 * 1000);
        $proximoDia = $date + $diaEmMilisegundos;
        $match['date'] = $date;

        if ($parametro == 1 || $parametro == 0) {
            $matchId = inserirMatch($match);
        } else if ($parametro == 2) {
            $user = buscarUsuario($userId);

            if ($user['superLike'] < $proximoDia) {
                atualizarUsuarioSuperLike($proximoDia, $userId);
                $matchId = inserirMatch($match);
            }
        }

        if (!empty($matchId)) {
            $match = buscarMatch($matchId);

            if ($match['usuario1_id'] == $userId) {
                $usuarioReferencia = $match['usuario2_id'];
                $likeStatus = buscarChatMatch($match['id'])['usuario_like2'];
            } else {
                $usuarioReferencia = $match['usuario1_id'];
                $likeStatus = buscarChatMatch($match['id'])['usuario_like1'];
            }

            return [
                'likeStatus' => $likeStatus,
                'usuarioFoto' => buscarUsuario($usuarioReferencia)['foto']
            ];
        }

        return '';
    }

?>
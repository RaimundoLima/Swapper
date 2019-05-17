<?php

    include_once('model/crud/foto.php');
    include_once('model/crud/roupa.php');

    function adicionarRoupas($roupa, $files) {
        $diretorio = 'roupas/';
        $foto = new Foto();

        for ($indice = 0; $indice < 3; $indice++) {

            if (existe($files[$indice])) {
                $caminhoFoto = $foto->salvarFoto($files[$indice], $diretorio);
            } else {
                $caminhoFoto = '';
            }

            $roupa['foto'.$indice] = $caminhoFoto;
        }

        inserirRoupa($roupa);
    }

    function existe($elemento) {
        return (!empty($elemento));
    }

?>
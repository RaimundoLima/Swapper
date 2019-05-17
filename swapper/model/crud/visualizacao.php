<?php

    include_once('setup.php');

    function buscarVisualizacao($id) {
        return R::load('visualizacao', $id);
    }

    function inserirVisualizacao($visualizacao) {
        $visualizacaoT = R::dispense('visualizacao');
        $visualizacaoT['usuario'] = R::load('usuario', $visualizacao['usuario']);
        $visualizacaoT['roupa'] = R::load('roupa', $visualizacao['roupa']);
        $visualizacaoT['favorito'] = $visualizacao['favorito'];

        return R::store($visualizacaoT);
    }

    function listarVisualizacao() {
        return R::findAll('visualizacao');        
    }

?>
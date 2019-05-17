<?php

    session_start();

    class Foto {

        private $diretorio;
        private $tamanhoMaximo;

        public function __construct() {
            $this->diretorio = 'imagens/';
            $this->tamanhoMaximo = 2500000;
        }

        function salvarFoto($fileImagem, $diretorio) {
            if ($fileImagem['name'] != '') {
                if ($fileImagem['error'] != 0) {
                    $_SESSION['error-message'] = 'Não foi possível fazer o upload da imagem, tente novamente mais tarde.';
                }

                if ($this->tamanhoMaximo < $fileImagem['size']) {
                    $_SESSION['error-message'] = 'O arquivo enviado é muito grande, envie arquivos de até 2,5Mb.';
                }

                $extensao = strtolower(end(explode('.', $fileImagem['name'])));
                $nome_final = uniqid(time()).'.'.$extensao;
                $caminhoFoto = $this->diretorio . $diretorio . $nome_final;
                move_uploaded_file($fileImagem['tmp_name'], $caminhoFoto);
            } else {
                $caminhoFoto = $this->diretorio . $diretorio . 'foto-default.jpg';
            }

            return $caminhoFoto;
        }

        function deletarFoto($caminhoFoto) {
            unlink($caminhoFoto);
        }

    }


?>
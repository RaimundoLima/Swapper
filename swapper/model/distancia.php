<?php

    class Distancia {

        private $latitudeUsuarioLogado;
        private $latitudeOutroUsuario;
        private $longitudeEntreUsuarios;

        public function __construct($latitudeUsuarioLogado, $latitudeOutroUsuario, $longitudeEntreUsuarios) {
            $this->latitudeUsuarioLogado = $latitudeUsuarioLogado;
            $this->latitudeOutroUsuario = $latitudeOutroUsuario;
            $this->longitudeEntreUsuarios = $longitudeEntreUsuarios;
        }

        public function getDistancia() {
            $produtoCosDistancia = $this->produtoCosDistancia();
            $produtoSinDistancia = $this->produtoSinDistancia();
        
            return ceil(6371 * acos($produtoSinDistancia + $produtoCosDistancia));
        }
    
        private function produtoCosDistancia() {
            return $this->cosDistancia($this->latitudeUsuarioLogado) * $this->cosDistancia($this->latitudeOutroUsuario) * $this->cosDistancia($this->distanciaEntreUsuarios);
        }
    
        private function produtoSinDistancia() {
            return $this->sinDistancia($this->latitudeUsuarioLogado) * $this->sinDistancia($this->latitudeOutroUsuario);
        }
    
        private function cosDistancia($valor) {
            return cos(deg2rad(90 - $valor));
        }
    
        private function sinDistancia($valor) {
            return sin(deg2rad(90 - $valor));
        }
        
    }
    
    

?>
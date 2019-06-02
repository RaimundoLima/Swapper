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
            return $this->cosDistancia(90 - $this->latitudeUsuarioLogado) * $this->cosDistancia(90 - $this->latitudeOutroUsuario) * $this->cosDistancia($this->longitudeEntreUsuarios);
        }
    
        private function produtoSinDistancia() {
            return $this->sinDistancia($this->latitudeUsuarioLogado) * $this->sinDistancia($this->latitudeOutroUsuario);
        }
    
        private function cosDistancia($valor) {
            return cos(deg2rad($valor));
        }
    
        private function sinDistancia($valor) {
            return sin(deg2rad(90 - $valor));
        }
        
    }
    
    

?>
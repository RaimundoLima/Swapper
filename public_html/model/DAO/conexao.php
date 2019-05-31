<?php

    function conexao(){
        $db = mysqli_connect('host=localhost port=3306 dbname=id9739528_swapper user=id9739528_swapper password=swapper');

        return $db;
    }

 ?>
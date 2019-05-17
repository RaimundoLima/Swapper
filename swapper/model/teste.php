<?php

    include('crud/model.php');

    $usuario1= [
        'sexo'=>'M',
        'email'=>'joao@gmail.com',
        'senha'=>sha1('123'),
        'celular'=>7,
        'nome'=>'joao',
        'nascimento'=>'01/01/1936',
        'foto'=>'img1.jpg'
    ];

    echo inserirUsuario($usuario1).' id do usuario1<br>';

?>
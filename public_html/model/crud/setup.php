<?php

    $ds = DIRECTORY_SEPARATOR;
    $base_dir = realpath(dirname(__FILE__).$ds.'..'.$ds.'..'.$ds.'..');
    include_once($base_dir.'/lib/redbean/rb.php');

    R::setup('mysql:host=localhost;dbname=id9739528_swapper','id9739528_swapper','swapper');
    // R::setup('pgsql:host=localhost;dbname=Swapper','postgres','postgres');

    //R::freeze();//frizar dps dos testes

?>
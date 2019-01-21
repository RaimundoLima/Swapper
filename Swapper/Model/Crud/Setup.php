<?php
include('RedBean/rb-postgres.php');

R::setup('pgsql:host=localhost;dbname=Swapper',
'postgres','postgres');

//R::freeze();//frizar dps dos testes
?>
<?php
function conexao(){
  $db = pg_connect("host=localhost port=5432 dbname=dbname user=postgres password=postgres");
  return $db;
}
 ?>
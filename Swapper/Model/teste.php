<?php
include('Crud/Model.php');
//usuarios


$usuario1=
[
    'sexo'=>"M",
    "email"=>'luis@gmail.com',
    "senha"=>sha1('123'),
    "celular"=>7,//
    "nome"=>'Luis',
    "nascimento"=>'01/01/1936',
    "localizacao"=>'-g344535382787-w01212133435353',
    "bio"=>'Um cara mais ou menos foda,mas é mais pro fodido',
    "foto"=>'img1.jpg'//dps eu testo colocando uma foto
];

echo inserirUsuario($usuario1)." id do usuario1<br>";

$usuario2=
[
    "sexo"=>'M',
    "email"=>'rai@gmail.com',
    "senha"=>sha1('123'),
    "celular"=>'05399887766551',//
    "nome"=>'Rai',
    "nascimento"=>'01/01/1933',
    "localizacao"=>'-g344535382787-w01212133435353',
    "bio"=>'Ele tem um sonho',
    "foto"=>'img2.png'
];
echo inserirUsuario($usuario2)." id do usuario2<br>";
/*
 /////////////////////////////////
$roupaDoUsuario1=
[
    "usuario"=>1,
    "disponibilidade"=>1,
    "tipo"=>"Camisa",
    "estado"=>"Nova",
    "descricao"=>"DAHORA mesmo",
    "categoria"=>"infantil",
    "nome"=>"camisa preta mto bonita",
    "tamanho"=>"G",
    "foto1"=>"foto1.jpg",
    "foto2"=>"foto1.jpg",
    "foto3"=>"foto1.jpg",
    "sexo"=>"M"
];
echo inserirRoupa($roupaDoUsuario1)." id da roupa1 que pertence ao usuario1<br>";

$roupa2DoUsuario1=
[
    "usuario"=>1,
    "disponibilidade"=>1,
    "tipo"=>"Não é uma camisa",
    "estado"=>"Nova",
    "descricao"=>"DAHORA mesmo",
    "categoria"=>"infantil",
    "nome"=>"camisa preta mto bonita",
    "tamanho"=>"G",
    "foto1"=>"foto1.jpg",
    "foto2"=>"foto1.jpg",
    //semfoto 3
    "sexo"=>"M"
];
echo inserirRoupa($roupa2DoUsuario1)." id da roupa2 que pertence ao usuario1<br>";


$roupa3DoUsuario1=
[
    "usuario"=>1,
    "disponibilidade"=>1,
    "tipo"=>"Sapatenis top",
    "estado"=>"Usado",
    "descricao"=>"DAHORA mesmo",
    "categoria"=>"infantil",
    "nome"=>"camisa preta mto bonita",
    "tamanho"=>"G",
    "foto1"=>"foto1.jpg",
    "foto2"=>"foto1.jpg",
    //semfoto 3
    "sexo"=>"M"
];
echo inserirRoupa($roupa3DoUsuario1)." id da roupa3 que pertence ao usuario1<br>";

$roupaDoUsuario2=
[
    "usuario"=>2,
    "disponibilidade"=>1,
    "tipo"=>"Sapatenis chinelo",
    "estado"=>"Usado",
    "descricao"=>"DAHORA mesmo",
    "categoria"=>"infantil",
    "nome"=>"camisa preta mto bonita",
    "tamanho"=>"G",
    "foto1"=>"foto1.jpg",
    "foto2"=>"foto1.jpg",
    //semfoto 3
    "sexo"=>"M"
];
echo inserirRoupa($roupaDoUsuario2)." id da roupa1 que pertence ao usuario2<br>";
//echo (buscarUsuarioLogin($usuario2));//ta funcionando
$usuario2VisualizaRoupa1=[
    "usuario"=>buscarUsuario(2),
    "roupa"=>buscarRoupa(1),
    "favorito"=>0
];
echo inserirVisualizacao($usuario2VisualizaRoupa1)." visualização<br> ";

$usuario2FavoritaRoupa2=[
    "usuario"=>2,
    "roupa"=>2,
    "favorito"=>1
];

echo inserirVisualizacao($usuario2FavoritaRoupa2)." visualização favoritando<br> ";
//tabela dos matchs
$usuario2LikeUsuario1=[
    'usuario1'=>2,
    'usuario2'=>1,
    'likeStatus'=>1,//0 dislike,1 like,2 superlike,3 Match
    'date'=>'01/01/2010'
];
echo inserirMatch($usuario2LikeUsuario1);

$usuario1LikeUsuario2=[
    'usuario1'=>1,
    'usuario2'=>2,
    'likeStatus'=>1,//0 dislike,1 like,2 superlike,3 Match
    'date'=>'01/01/2010'
];
echo inserirMatch($usuario1LikeUsuario2);


//chat campo user1 e user2 listar por usuario&& disponibilidade
$usuario1Mensagem1=[
    'horario'=>time(),
    'conteudo'=>"fala meu mano das quebradas bora fazer uns negocios",
    'chat'=>1,
    'usuario'=>1
];
echo inserirMensagem($usuario1Mensagem1);
$usuario2Mensagem1=[
    'horario'=>time(),
    'conteudo'=>"è oq ç funciona?",
    'chat'=>1,
    'usuario'=>2
];
echo inserirMensagem($usuario2Mensagem1);
*/
?>
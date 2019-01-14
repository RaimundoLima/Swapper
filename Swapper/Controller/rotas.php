<?php
function getPagina()
{
    //session_start();
 	//error_reporting(0);
	$url = $_SERVER['REQUEST_URI'];
	$url = strtolower(explode("?",$url)[0]);
    //var_dump($url);
    $_SESSION['id']=1;//teste de sessaõ
    switch($url){
        case '/chat':
            include('View/header.php');
            include('View/chat.php');
            include('View/footer.php');
        break;
        case '/main':
            include('View/header.php');
            include('View/main.php');
            include('View/footer.php');
        break;
        case '/enviamsg':
            $texto=trim($_POST['text']);
            if($texto!="" && $texto!=" "){
                //criar msg
                //time();
                //salvar no bd
                echo 'ok';
            }else{
                echo "deu ruim";
            }
        break;
        case '/chatupdate':
            //$listaMsg=mensagemDAO.listaMsgsPerMilliseconds($_POST["date"],$_SESSION["id"])
            //
            //array_reverse($listaMsg);
            $html = "";
            for ($i=0;$i<count($listaMsg);$i++) {
                $class="mensagem";
                $invisivel="true";
                $align="left";
                if($_SESSION==$listaMsg[$i]->getIdUsuario()){
                    $class+="1";
                }else{
                    $class+="2";
                    $align="right";
                    if($_SESSION!=$listaMsg[$i+1]->getIdUsuario()){
                        $invisivel="false";
                    }  
                }
                $html+="<div align='".$align."'><img><span name='".$listaMsg[$i]->getHorario()."' class='".$class."'>".$listaMsg[$i]->getConteudo()."</span></div>";
            }
            //echo $html;
            echo
            "<div align='right'><span class='mensagem1'>EU SOU UMA MENSAGEM</span></div>
            <div align='left'><span class='mensagem2'>EU SOU UMA MENSAGEM</span></div>
            <div align='right'><span class='mensagem1'>EU SOU UMA MENSAGEM</span></div>
            <div align='right'><span class='mensagem1'>EU SOU UMA MENSAGEM</span></div>
            <div align='left'><img src='View/img/rai.jpg' class='imgRedonda'><span class='mensagem2 l5'>EU SOU UMA MENSAGEM</span></div>
            <div align='right'><span class='mensagem1'>EU SOU UMA MENSAGEM</span></div>
            <div align='left'><span class='mensagem2'>EU SOU UMA MENSAGEM</span></div>
            <div align='right'><span class='mensagem1'>EU não SOU UMA MENSAGEM, 
            sou um fuucking teste motherfucker</span></div>";//teste
        break;
    }

   
}
?>
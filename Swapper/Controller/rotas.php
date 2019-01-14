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
        case '/':
            include('View/header.php');
            include('View/chat.php');
            include('View/footer.php');
        break;
        case '/enviamsg':
            $texto=trim($_POST['text']);
            if($texto!="" && $texto!=" "){
                //criar msg
                //salvar no bd
                echo 'ok';
            }else{
                echo "deu ruim";
            }
        break;
        case '/chatupdate':
            //listamsgssdsdsddsdsdsd
            array_reverse($listaMsg);
            $html = "";
            for ($i=0;$i<count($listaMsg);$i++) {
                $class="mensagem";
                $invisivel="true";
                if($_SESSION==$listaMsg[$i]->getIdUsuario()){
                    $class+="1";
                }else{
                    $class+="2";
                    if($_SESSION!=$listaMsg[$i+1]->getIdUsuario()){
                        $invisivel="false";
                    }  
                }
                $html+="<p class='".$class."'>".$listaMsg[$i]->getConteudo()."</p>";
            }
            //echo $html;
            echo
            "<span class='mensagem1'>EU SOU UMA MENSAGEM</span>
            <span class='mensagem1'>EU SOU UMA MENSAGEM</span>
            <span class='mensagem2'>EU SOU UMA MENSAGEM</span>
            <span class='mensagem1'>EU SOU UMA MENSAGEM</span>
            <span class='mensagem2'>EU SOU UMA MENSAGEM</span>
            <span class='mensagem1'>EU SOU UMA MENSAGEM</span>
            <span class='mensagem2'>EU SOU UMA MENSAGEM</span>
            <span class='mensagem1'>EU SOU UMA MENSAGEM</span>
            <span class='mensagem2'>EU SOU UMA MENSAGEM</span>
            <span class='mensagem2'>EU SOU UMA MENSAGEM</span>
            <span class='mensagem1'>EU não SOU UMA MENSAGEM, sou um fuucking teste motherfucker</span>";//teste
        break;
    }

   
}
?>
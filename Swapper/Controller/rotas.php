<?php
function getPagina()
{
    session_start();
 	//error_reporting(0);
	$url = $_SERVER['REQUEST_URI'];
	$url = strtolower(explode("?",$url)[0]);
    //var_dump($url);
    $_Session["sou um teste pra não dar pau"]="não me deleta";
    if(!empty($_SESSION)){
        switch($url){
            case '/logar':
            include('View/header.php');
            include('View/logar.php');
            include('View/footer.php');
            break;
            case '/logando':
            $usuario=$usuarioDAO->obter($_POST['email']);
            $senha=$usuario->getSenha();
            if(!empty($usuario) && $_POST['senha']==$senha){
                $_SESSION['usuario']=$usuario;
            }
            header("Refresh: 0");
            break;
            default :
			var_dump($url);
				echo 'deu ruim Famoso 404';//
			break;
        }
    }else{
        switch($url){
            case '/deslogar':
            session_destroy();
            header("Refresh: 0");
            break;
            case '/model':
                include('Model/teste.php');
            break;
            case '/chat':
                //$_SERVERidChat=$_POST["idChat"];
                //$chat=new chatDAO()->buscar(idChat)
                var_dump();
                include('View/header.php');
                include('View/chat.php');
                include('View/footer.php');
            break;
            case '/main':
                //$listaProdutos=new produtosDao()->listaProdutos();
                //$listaChat=new chatDao()->listaChat();
                //$msgMaisRecenteDeCadaChat=new mensagemDao(listaChat)
                include('View/header.php');
                include('View/main.php');
                include('View/footer.php');
                
            break;
            case '/ediatrperfil':
                //criar msg
                //time();
                //salvar no bd
                echo 'ok';
            break;
            case '/enviamsg':
                $texto=trim($_POST['text']);
                if($texto!="" && $texto!=" "){
                    //criar msg
                    //time();
                    //salvar no bd
                    echo 'Msg enviada';
                }else{
                    echo "erro ao enviar msg";
                }
            break;
            case '/chatupdate':
                //$listaMsg=mensagemDAO->listaMsgsPerMillisecondsDoUsuario($_POST["date"],$_SESSION["id"])
                //if(count($listaMsg)>0){}
                //array_reverse($listaMsg);
                $html = "";
                for ($i=0;$i<count($listaMsg);$i++) {
                    $class="mensagem";
                    $invisivel="true";
                    $align="left";
                    if($_SESSION["usuario"]->getId()==$listaMsg[$i]->getIdUsuario()){
                        $class+="1";
                    }else{
                        $class+="2";
                        $align="right";
                        if($_SESSION["usuario"]->getId()!=$listaMsg[$i+1]->getIdUsuario()){
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
            default :
			var_dump($url);
				echo 'deu ruim Famoso 404';//
			break;
        }
    }
   
}
?>
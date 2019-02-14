<?php
include("Model/Crud/Model.php");
function getPagina()
{   
    session_set_cookie_params(25920000);
    session_start();
 	//error_reporting(0);
	$url = $_SERVER['REQUEST_URI'];
    $var=explode("?",$url)[1];
	$url = strtolower(explode("?",$url)[0]);
    //var_dump($url);
    //$_SESSION["sou um teste pra não dar pau"]="não me deleta";
    if(empty($_SESSION)){
        switch($url){
            case '/model':
                include('Model/teste.php');
            break;
            case '/logar':
                include('View/header.php');
                include('View/logar.php');
                include('View/footer.php');
            break;
            case '/logando':
            $usuario=[
                'email'=>$_POST['email'],
                'senha'=>sha1($_POST['senha'])
            ];
            $usuario=buscarUsuarioLogin($usuario);
            if($usuario!=null){
                echo("foi");
                $_SESSION['usuario']=$usuario;
            }
            header("Location: http://127.0.0.1:8000/main");
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
            header("Location: http://127.0.0.1:8000/logar");
            break;
            case '/model':
                include('Model/teste.php');
            break;
            case '/adicionarroupas':
                $roupa;
                //var_dump($_FILES);
                $img1="";
                $img2="";
                $img3="";
                for($i=1;$i<=3;$i++){
                    if(!empty($_FILES["img".$i])){
                        if($_FILES["img".$i]["size"] <= 2500000){
                            if($_FILES["img".$i]["type"]=="image/jpg" || $_FILES["img".$i]["type"]=="image/png"|| $_FILES["img".$i]["type"]=="image/jpeg"){
                                if($img1==""){
                                    $img1=mb_convert_encoding(file_get_contents($_FILES["img".$i]["tmp_name"]),"base64","UTF-8");
                                }else if($img2==""){
                                    $img2=mb_convert_encoding(file_get_contents($_FILES["img".$i]["tmp_name"]),"base64","UTF-8");
                                }else if($img3==""){
                                    $img3=mb_convert_encoding(file_get_contents($_FILES["img".$i]["tmp_name"]),"base64","UTF-8");
                                }
                            }
                        }
                    }
                }
                $roupa["nome"]=trim($_POST["nome"]);
                $roupa["descricao"]=trim($_POST["descricao"]);
                if(count($roupa["nome"])<=30 && count($roupa["descricao"])<=200 && 
                    !is_null(($roupa["nome"]))<=30 && !is_null($roupa["descricao"])<=200){
                    $roupa["sexo"]= $_POST["sexo"] == "1" ? 1: 2;
                    $roupa["categoria"]= $_POST["categoria"] == "1" ? 1: 2;
                    if($_POST["tipo"]=="1"){
                        $roupa["tipo"]=1;
                    }else{
                        if($_POST["tipo"]=="2"){
                            $roupa["tipo"]=2; 
                        }else{
                            $roupa["tipo"]=3;
                        }
                    }
                    $roupa["estado"]= $_POST["estado"] == "1" ? 1: 2;
                    $roupa["usuario"]=$_SESSION["usuario"]["id"];
                    if(!empty($img1)){
                        $roupa["foto1"]=$img1;
                        $roupa["foto2"]=$img2;
                        $roupa["foto3"]=$img3;
                        inserirRoupa($roupa);
                    }
                }else{
                    //error
                }
            break;
            case '/buscarfiltro':
                $filtro=buscarConfig($_SESSION['usuario']['id']);
                echo $filtro;
            break;
            case '/buscarroupas':
                $roupas=listarRoupa($_SESSION['usuario']['id']);
                echo json_encode($roupas);
            break;
            case '/buscarroupasporid':
            $roupa=buscarRoupa($var,$_SESSION["usuario"]["id"]);
                if(!empty($roupa)){
                    $roupa["usuario_id"]=$_SESSION["usuario"]["nome"];
                    echo json_encode($roupa);
                }else{
                    //roupa não é do usuario
                }
            break;
            case '/atualizarroupas':
                $roupa=buscarRoupa($var,$_SESSION["usuario"]["id"]);
                echo json_encode($roupa);
            break;
            case '/atualizarroupasenviar':
                $roupa;
                //var_dump($_FILES);
                $img1="";
                $img2="";
                $img3="";
                for($i=1;$i<=3;$i++){
                    if(!empty($_FILES["img".$i])){
                        if($_FILES["img".$i]["size"] <= 2500000){
                            if($_FILES["img".$i]["type"]=="image/jpg" || $_FILES["img".$i]["type"]=="image/png"|| $_FILES["img".$i]["type"]=="image/jpeg"){
                                if($img1==""){
                                    $img1=mb_convert_encoding(file_get_contents($_FILES["img".$i]["tmp_name"]),"base64","UTF-8");
                                }else if($img2==""){
                                    $img2=mb_convert_encoding(file_get_contents($_FILES["img".$i]["tmp_name"]),"base64","UTF-8");
                                }else if($img3==""){
                                    $img3=mb_convert_encoding(file_get_contents($_FILES["img".$i]["tmp_name"]),"base64","UTF-8");
                                }
                            }
                        }
                    }
                }
                $roupa["nome"]=trim($_POST["nome"]);
                $roupa["descricao"]=trim($_POST["descricao"]);
                if(count($roupa["nome"])<=30 && count($roupa["descricao"])<=200 && 
                    !is_null(($roupa["nome"]))<=30 && !is_null($roupa["descricao"])<=200){
                    $roupa["sexo"]= $_POST["sexo"] == "1" ? 1: 2;
                    $roupa["categoria"]= $_POST["categoria"] == "1" ? 1: 2;
                    if($_POST["tipo"]=="1"){
                        $roupa["tipo"]=1;
                    }else{
                        if($_POST["tipo"]=="2"){
                            $roupa["tipo"]=2; 
                        }else{
                            $roupa["tipo"]=3;
                        }
                    }
                    $roupa["estado"]= $_POST["estado"] == "1" ? 1: 2;
                    $roupa["usuario"]=$_SESSION["usuario"]["id"];
                    if(!empty($img1)){
                        $roupa["foto1"]=$img1;
                        $roupa["foto2"]=$img2;
                        $roupa["foto3"]=$img3;
                        if(!empty(buscarRoupa($_POST["id"],$_SESSION["usuario"]["id"]))){
                            atualizarRoupa($roupa,$_POST["id"]);
                        }
                    }
                }else{
                    //error
                }
            break;

            case '/atualizarfiltro':
                $_POST["masculino"]= $_POST["masculino"] == 'true'? true: false;
                $_POST["feminino"]= $_POST["feminino"] == 'true'? true: false;
                $_POST["adulto"]= $_POST["adulto"] == 'true'? true: false;
                $_POST["infantil"]= $_POST["infantil"] == 'true'? true: false;
                $_POST["roupa"]= $_POST["roupa"] == 'true'? true: false;
                $_POST["acessorio"]= $_POST["acessorio"] == 'true'? true: false;
                $_POST["calcado"]= $_POST["calcado"] == 'true'? true: false;
                $_POST["novo"]= $_POST["novo"] == 'true'? true: false;
                $_POST["usado"]= $_POST["usado"] == 'true'? true: false;
                if($_POST["distancia"]>=2 && $_POST["distancia"]<=150
                //teste de checkeds
                && (($_POST["masculino"] || $_POST["feminino"] ))
                && (is_bool($_POST["adulto"] || $_POST["infantil"]))
                && (is_bool($_POST["roupa"] || $_POST["acessorio"] || $_POST["calcado"]))
                && (is_bool($_POST["novo"]) || $_POST["usado"])
                ){
                    $config=$_POST;
                    atualizarConfig($config,$_SESSION['usuario']['id']);
                }
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
            case '/atualizarperfil':
                $img="";
                 if(!empty($_FILES["img"])){
                        if($_FILES["img"]["size"] <= 2500000){
                            if($_FILES["img"]["type"]=="image/jpg" || $_FILES["img"]["type"]=="image/png"|| $_FILES["img"]["type"]=="image/jpeg"){
                                $img=mb_convert_encoding(file_get_contents($_FILES["img"]["tmp_name"]),"base64","UTF-8");
                            }
                        }
                    }
                if($img!=""){
                    $usuario["foto"]=$img;
                    atualizarUsuarioFoto($usuario,$_SESSION["usuario"]["id"]);
                    $_SESSION["usuario"]=buscarUsuario($_SESSION["usuario"]["id"]);
                    echo $img;
                }
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
function emailCadastro($usuario){
    $to = $usuario['email'];
    $subject = 'dominio';
    $body = "<div> YOYO<br>".$usuario['nome']." esta cadastrado e agora consegue ler em <i><b style='color:#f88'>HTML</b></i></div>";
       $headers = 'From: Swapper email@email.com' . "\r\n" ;
       $headers .='Reply-To: '. $to . "\r\n" ;
       $headers .='X-Mailer: PHP/' . phpversion();
       $headers .= "MIME-Version: 1.0\r\n";
       $headers .= "Content-type: text/html; charset=utf-8\r\n";   
   echo(mail($to, $subject, $body,$headers));
}
function emailRecuperarSenha(){
    $to = $usuario['email'];
    $subject = 'dominio';
    $body = "<div> YOYO<br>".$usuario['nome']." essa é sua senha de recuperação ".$usuario["senha"]."";
       $headers = 'From: Swapper email@email.com' . "\r\n" ;
       $headers .='Reply-To: '. $to . "\r\n" ;
       $headers .='X-Mailer: PHP/' . phpversion();
       $headers .= "MIME-Version: 1.0\r\n";
       $headers .= "Content-type: text/html; charset=utf-8\r\n";   
   echo(mail($to, $subject, $body,$headers));
}

//buscar coordenadas
//TESTE
//$Latitude_1=39.977120098439634;
//$Longitude_1=-7.580566406250001;
//$Latitude_2=40.3130432088809;
//$Longitude_2= -7.767333984375001;

// Abaixo é a formula em PHP de calcular a distancia(TESTADA E COMPROVADA), tenho la no codigo do Main JS ela em JS
//a formula ja retorna um valor sem ,
//round(6371*acos(cos(deg2rad(90-$Latitude_1))*cos(deg2rad(90-$Latitude_2))+sin(deg2rad(90-$Latitude_1))*sin(deg2rad(90-$Latitude_2))*cos(deg2rad($Longitude_1-$Longitude_2)))*1)

//Rai quando for fazer a pesquisa dos usuarios perto vamos limitar a pesquisa p n tornar ela pesada
//vamos fazer ela por "quadrantes"
//basta tu colocar na busca do SQL ou oq tu for fazer que a lista de usuarios q deve ser pesquisada deve ser entre
// round(Latitude_do_usuario_logado+2) >= Latitude && round(Latitude_do_usuario_logado-2) <= Latitude
// round(Longitude_do_usuario_logado+2) >= Latitude && round(Longitude_do_usuario_logado-2) <= Latitude
// Assim a gente limita em buscar dentro de um quadrante.
?>
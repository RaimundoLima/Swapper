<?php
include("Model/Crud/Model.php");
function getPagina()
{   
    session_set_cookie_params(25920000);
    session_start();
 	error_reporting(0);
	$url = $_SERVER['REQUEST_URI'];
    $var=explode("?",$url)[1];
	$url = strtolower(explode("?",$url)[0]);
    //var_dump($url);
    //$_SESSION["sou um teste pra não dar pau"]="não me deleta";
    if(empty($_SESSION)){
        switch($url){
            case '/nk':
            R::nuke();
            break;
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
            case '/buscarmensagensantigas':
                $daods=[];
                $msgs=listarMensagemAntigas($_POST['idChat'],$_POST['scroll']);
                for($i=0;$i<count($msgs);$i++) {
                    if($msgs[$i]['usuario']==null){
                        $msgs[$i]['usuario']=0;
                    }else if($msgs[$i]['usuario']==$_SESSION['usuario']['id']){
                        $msgs[$i]['usuario']=1;
                    }else{
                        $msgs[$i]['usuario']=2;
                    }
                }
                $dados['msgs']=$msgs;
                echo json_encode($dados);
            break;
            case '/buscarmensagens':
            //conferir dados
                $daods=[];
                $msgs=listarMensagem($var);
                for($i=0;$i<count($msgs);$i++) {
                    if($msgs[$i]['usuario']==null){
                        $msgs[$i]['usuario']=0;
                    }else if($msgs[$i]['usuario']==$_SESSION['usuario']['id']){
                        $msgs[$i]['usuario']=1;
                    }else{
                        $msgs[$i]['usuario']=2;
                    }
                }
                $dados['msgs']=$msgs;
                $chat=buscarChat($var);
                $match=buscarMatch($chat['match_id']);
                if($match['usuario1_id']==$_SESSION['usuario']['id']){
                    $usuario=buscarUsuario($match['usuario2_id']);
                    $dados['usuario']['foto']=$usuario['foto'];
                    $dados['usuario']['nome']=$usuario['nome'];
                    $dados['usuario']['id']=$usuario['id'];
                }else{
                    $usuario=buscarUsuario($match['usuario1_id']);
                    $dados['usuario']['foto']=$usuario['foto'];
                    $dados['usuario']['nome']=$usuario['nome'];
                    $dados['usuario']['id']=$usuario['id'];
                }
                if($chat['usuario_like1']==2 || $chat['usuario_like2']==2){
                    $dados['usuario']['likeStatus']=2;
                }else{
                    $dados['usuario']['likeStatus']=1;
                }

                echo json_encode($dados);
            break;
            case '/buscarchats':
            $data=[];
            $listaChats=listarChat($_SESSION['usuario']['id']);
            for($i=0;$i<count($listaChats);$i++){
                $user2=buscarUsuario(buscarMatchUsuario2(($listaChats)[$i],$_SESSION['usuario']['id']));
                $data[$i]['nomeUsuario']=$user2['nome'];
                $data[$i]['fotoUsuario']=$user2['foto'];
                //error_log(print_r(($_SESSION['usuario']['id'])."  ".$user2['id'],true));
                $mensagem=listarMensagem($listaChats[$i]['id'])[0];
                if($mensagem['usuario']==$_SESSION['usuario']['id']){
                    $data[$i]['idUsuario']=0;
                }else{
                    $data[$i]['idUsuario']=1;
                }
                $data[$i]['conteudoMensagem']=$mensagem['conteudo'];
                $data[$i]['horarioMensagem']=$mensagem['horario'];
                $data[$i]['visualizacaoMensagem']=$mensagem['visualizado'];
                $data[$i]['idChat']=$listaChats[$i]['id'];
                if($listaChats[$i]['usuario_like1'] == 2 || $listaChats[$i]['usuario_like2'] == 2){
                    $data[$i]['likeStatus']=2;
                }else{
                    $data[$i]['likeStatus']=1;
                }
            }
            $aux=[];
            for($i=0;$i<count($data);$i++){
                $menorNumero=9999999999999;
                for($j=0;$j<count($data);$j++){
                    $x=0;
                    for ($k=0; $k<count($aux); $k++) { 
                        if($data[$j] == $aux[$k]){
                            $x = 1;
                        }
                    }
                    if($menorNumero>$data[$j]['horarioMensagem']*1 && $x == 0){
                        $aux[$i]=$data[$j];
                        $menorNumero=$data[$j]['horarioMensagem']*1;
                    }
                }
            }
            echo json_encode(array_reverse($aux));
            break;
            case '/like':
                $match['usuario1']=$_SESSION['usuario']['id'];
                $match['usuario2']=$_POST['usuario'];
                $match['date']=ceil(microtime(true)*1000);
                $match['like_status']=$var;
                if($var==1 || $var==0){
                    //error_log(print_r($match['like_status'],true));
                    $aux=inserirMatch($match);
                }else if($var==2){
                    $user=buscarUsuario($_SESSION['usuario']['id']);
                    if($user['superLike']<ceil(microtime(true)*1000)+(24 * 60 * 60 * 1000)){
                        atualizarUsuarioSuperLike(ceil(microtime(true)*1000)+(24 * 60 * 60 * 1000),$_SESSION['usuario']['id']);
                        $aux=inserirMatch($match);
                    }
                }
                if(!empty($aux)){
                    $match=buscarMatch($aux);
                    if($match['usuario1_id']==$_SESSION['usuario']['id']){
                        $usuarioReferencia=$match['usuario2_id'];
                        $likeStatus=buscarChatMatch($match['id'])['usuario_like2'];

                    }else{
                        $usuarioReferencia=$match['usuario1_id'];
                        $likeStatus=buscarChatMatch($match['id'])['usuario_like1'];
                    }
                    $dados=[
                        'likeStatus'=>$likeStatus,
                        'usuarioFoto'=>buscarUsuario($usuarioReferencia)['foto']
                    ];
                    echo json_encode($dados);
                }
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
            case '/buscarperfisporid':
            //falta verificação
            $user=buscarUsuario($var);
            $data['usuario']['id']=$user['id'];
            $data['usuario']['foto']=$user['foto'];
            $data['usuario']['nome']=$user['nome'];
            $list=listarRoupa($var);
            //echo json_parse($list);
            for($i=0;$i<count($list);$i++){
                $data['roupa'][$i]['id']=$list[$i]['id'];
                $data['roupa'][$i]['foto1']=$list[$i]['foto1'];
                $data['roupa'][$i]['nome']=$list[$i]['nome'];
            }
            echo json_encode($data);
            break;
            case '/buscarfiltro':
                $filtro=buscarConfig($_SESSION['usuario']['id']);
                echo $filtro;
            break;
            case '/buscarroupas':
                $roupas=listarRoupa($_SESSION['usuario']['id']);
                $aux = [];
                $count = 0;
                //echo json_encode($roupas);
                foreach($roupas as $roupa) {
                    $aux[$count]=$roupa;
                    $count++;
                }
                echo json_encode($aux);
            break;
            case '/deletarproduto':
                echo deletarRoupa($var,$_SESSION['usuario']['id']);
            break;
            case '/buscarroupasporid':
            $var=explode(",",$var);
            if(count($var)!=1){
                $roupa=buscarRoupa($var[0],$var[1]);
                $roupa["usuario_id"]=buscarUsuario($var[1])["nome"];
            }else{
                $roupa=buscarRoupa($var[0],$_SESSION["usuario"]["id"]);
                $roupa["usuario_id"]=$_SESSION["usuario"]["nome"];
            }
                if(!empty($roupa)){
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
                    $aux=buscarRoupa($_POST['id'],$_SESSION['usuario']['id']);
                    if($_POST['alteraImagem1']==0){
                        $img1=$aux['foto1'];
                    }
                    if($_POST['alteraImagem2']==0){
                        $img2=$aux['foto2'];
                    }
                    if($_POST['alteraImagem2']==2){
                        $img2="";
                    }
                    if($_POST['alteraImagem3']==0){
                        $img3=$aux['foto3'];
                    }
                    if($_POST['alteraImagem3']==2){
                        $img3="";
                    }

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
                include('View/header.php');
                include('View/main.php');
                include('View/footer.php');
            break;
            case '/atualizarpos':
                $usuario["latitude"]=$_POST["latitude"];
                $usuario["longitude"]=$_POST["longitude"];
                atualizarUsuarioPos($usuario,$_SESSION['usuario']['id']);
                $data=[];
                $listusers=buscarUsuarioLocalizacao($_SESSION['usuario']['id']);
                for($i=0;$i<count($listusers);$i++){
                    $data[$i]['usuario']['id']=$listusers[$i]["usuario"]['id'];
                    $data[$i]['usuario']['nome']=$listusers[$i]["usuario"]['nome'];
                    $data[$i]['usuario']['foto']=$listusers[$i]["usuario"]['foto'];

                    //error_log(print_r($data[$i]['usuario']['latitude'],true));

                    //ceil(6371*acos(sin(deg2rad(90-$usuario["latitude"]))*sin(deg2rad(90-$lista["latitude"]))+cos(deg2rad(90-$usuario["latitude"]))*cos(deg2rad(90-$lista["latitude"]))*cos(deg2rad($usuario["longitude"]-$lista["longitude"]))))
                    if(ceil(6371*acos(sin(deg2rad(90-$_SESSION['usuario']["latitude"]))*sin(deg2rad(90-$listusers[$i]["usuario"]["latitude"]))+cos(deg2rad(90-$_SESSION['usuario']["latitude"]))*cos(deg2rad(90-$listusers[$i]["usuario"]["latitude"]))*cos(deg2rad($_SESSION['usuario']["longitude"]-$listusers[$i]["usuario"]["longitude"]))))<=1){
                        $data[$i]['usuario']['distancia']=1;
                    }else{ 
                    $data[$i]['usuario']['distancia']= ceil(6371*acos(sin(deg2rad(90-$_SESSION['usuario']["latitude"]))*sin(deg2rad(90-$listusers[$i]["usuario"]["latitude"]))+cos(deg2rad(90-$_SESSION['usuario']["latitude"]))*cos(deg2rad(90-$listusers[$i]["usuario"]["latitude"]))*cos(deg2rad($_SESSION['usuario']["longitude"]-$listusers[$i]["usuario"]["longitude"]))));
                    }
                    $data[$i]['roupa'][0]['nome']=$listusers[$i]['roupa'][0]['nome'];
                    $data[$i]['roupa'][0]['id']=$listusers[$i]['roupa'][0]['id'];
                    $data[$i]['roupa'][0]['foto']=$listusers[$i]['roupa'][0]['foto1'];
                    if(!empty($listusers[$i]['roupa'][1]['id'])){
                    $data[$i]['roupa'][1]['nome']=$listusers[$i]['roupa'][1]['nome'];
                    $data[$i]['roupa'][1]['id']=$listusers[$i]['roupa'][1]['id'];
                    $data[$i]['roupa'][1]['foto']=$listusers[$i]['roupa'][1]['foto1'];
                    }
                    if(!empty($listusers[$i]['roupa'][2]['id'])){
                    $data[$i]['roupa'][2]['nome']=$listusers[$i]['roupa'][2]['nome'];
                    $data[$i]['roupa'][2]['id']=$listusers[$i]['roupa'][2]['id'];
                    $data[$i]['roupa'][2]['foto']=$listusers[$i]['roupa'][2]['foto1'];
                    }
                    //error_log(print_r(!empty($data[$i]['roupa'][2]['id']),true));
                }
                echo json_encode($data);
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
                $mensagem=[];
                //verificar dados
                $idChat=$_POST['idChat'];
                if($texto!="" && $texto!=" "){
                    $mensagem["horario"]=ceil(microtime(true)*1000);//ceil(microtime(true)*1000)."";

                    //error_log(print_r($mensagem["horario"],true));
                    $mensagem["conteudo"]=$texto;
                    $mensagem["chat"]=$idChat;
                    $mensagem["usuario"]=$_SESSION['usuario']['id'];
                    inserirMensagem($mensagem);
                    //criar msg
                    //ceil(microtime(true)*1000);
                    //salvar no bd
                    echo 'Msg enviada';
                }else{
                    echo "erro ao enviar msg";
                }
            break;
            case '/mensagemnaovisualizada':
                echo (mensagemNaoVisualizada($_SESSION['usuario']['id']));
            break;
            case '/chatupdate':
                //error_log(print_r($_POST['date'],true));
                visualizarMensagens($var,$_SESSION['usuario']['id']);
                $msgs=listarMensagemData($var,$_POST["date"]);
                for($i=0;$i<count($msgs);$i++) {
                    if($msgs[$i]['usuario']==null){
                        $msgs[$i]['usuario']=0;
                    }else if($msgs[$i]['usuario']==$_SESSION['usuario']['id']){
                        $msgs[$i]['usuario']=1;
                    }else{
                        $msgs[$i]['usuario']=2;
                    }
                }
                echo(json_encode($msgs));
                //error_log(print_r($msgs,true));
                //$listaMsg=mensagemDAO->listaMsgsPerMillisecondsDoUsuario($_POST["date"],$_SESSION["id"])
                //if(count($listaMsg)>0){}
                //array_reverse($listaMsg);
                /*$html = "";
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
                sou um fuucking teste motherfucker</span></div>";//teste*/
            break;
            default :
			var_dump($url);
				echo 'deu ruim Famoso 404';//
			break;
        }
    }
   
}
function imageResize($img,$porcentagem,$newWidth,$newHeight){
    $filename = $img;
    // pegando as dimensoes reais da imagem, largura e altura
    list($width, $height) = getimagesize($filename);
    //setando a largura da miniatura
    //setando a altura da miniatura
    //gerando a a miniatura da imagem
    $image_p = imagecreatetruecolor($new_width, $new_height);
    $image = imagecreatefromjpeg($filename);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    //o 3º argumento é a qualidade da imagem de 0 a 100
    $imgResize= imagejpeg($image_p, null, $porcentagem);
    imagedestroy($image_p);
    return $imgResize;
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

?>
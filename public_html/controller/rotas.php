<?php

    include_once('model/crud/model.php');
    session_set_cookie_params(25920000);
    session_start();
    error_reporting(0);

    function getPagina() {
        $url = $_SERVER['REQUEST_URI'];
        $var = explode('?', $url)[1];
        $url = strtolower(explode('?', $url)[0]);

        if (empty($_SESSION['usuario'])) {
            switch($url) {
                case '/nk':
                    R::nuke();
                break;
                case '/cadastrar':
                    $ds = DIRECTORY_SEPARATOR;
                    $baseDir = realpath(dirname(__FILE__) .$ds.'..');

                    include_once($baseDir.'/model/crud/foto.php');
                    include_once($baseDir.'/model/emailsender.php');
                    include_once('functions/usuario/cadastro.php');

                    if (empty($_SESSION['usuario-incompleto'])) {
                        $usr = buscarUsuarioEmail($_POST['email']);
                        if (empty($usr)) {
                            $fotoDAO = new Foto();
                            $caminhoFoto = $fotoDAO->salvarFoto($_FILES['foto'], 'usuario/');
                            $chaveSecreta = uniqid(sha1(time()));
                            
                            $usuario['nome'] = $_POST['nome'];
                            $usuario['senha'] = sha1($_POST['senha']);
                            $usuario['nascimento'] = $_POST['data-nasc'];
                            $usuario['sexo'] = $_POST['sexo'];
                            $usuario['email'] = $_POST['email'];
                            $usuario['verificado'] = 0;
                            $usuario['foto'] = $caminhoFoto;
                            $usuario['chavesecreta'] = $chaveSecreta;

                            $email['cabecalho'] = 'Olá '.$usuario['nome'].', estamos quase terminando seu cadastro em nosso aplicativo!';
                            $email['corpo'] = 'Para concluir basta clicar no botão abaixo!';
                            $email['buttonText'] = 'VERIFICAR AGORA';
                            $email['subject'] = 'Verifique seu email';
                            $email['objetivo'] = 'verificaremail';
                            
                    
                            $sender = new EmailSender($usuario, $email);
                            $sender->enviarEmail();
                        } else {
                            $_SESSION['error-message'] = 'O email informado já está vinculado a uma conta.';
                            
                            header('Location: https://'.$_SERVER['HTTP_HOST'].'/view/cadastro.php');
                        }
                    } else {
                        $usuario = unserialize($_SESSION['usuario-incompleto']);
                        $usuario['nascimento'] = $_POST['data-nasc'];
                        $usuario['sexo'] = $_POST['sexo'];
                        $usuario['verificado'] = 1;
                    }
                    
                    $usuario['id'] = inserirUsuario($usuario);
                    $_SESSION['usuario'] = serialize($usuario);
                    
                    header('Location: https://'.$_SERVER['HTTP_HOST'].'/view/main.php#'.$usuario['id']);
                break;
                case '/logando':
                    $usuario=[
                        'email' => $_POST['email'],
                        'senha' => sha1($_POST['senha'])
                    ];

                    if ($usuario = buscarUsuarioLogin($usuario)) {
                        $_SESSION['usuario'] = serialize($usuario);
                        $USER_UNSERIALIZED = unserialize($_SESSION['usuario']);
                        
                        $urlRedirect = 'https://'.$_SERVER['HTTP_HOST'].'/main';
                        sleep(2);
                        header('Location: '.$urlRedirect);
                        exit;
                    }
                    
                    header('Location: https://'.$_SERVER['HTTP_HOST'].'/view/logar.php');
                break;
                case '/recuperarsenha':
                    $ds = DIRECTORY_SEPARATOR;
                    $baseDir = realpath(dirname(__FILE__) .$ds.'..');

                    include_once($baseDir.'/model/emailsender.php');

                    $usuario['email'] = $_POST['email'];
                    
                    if ($usuario = buscarUsuarioEmail($usuario)) {
                        $chaveSecreta = uniqid(sha1(time()));
                        atualizarChaveSecreta($chaveSecreta, $usuario['id']);
                        $usuario['chavesecreta'] = $chaveSecreta;
                        $_SESSION['usuario'] = serialize($usuario);

                        $email['cabecalho'] = 'Olá '.$usuario['nome'].'!';
                        $email['corpo'] = 'Para redefinir sua senha basta clicar no botão abaixo!';
                        $email['buttonText'] = 'REDEFINIR SENHA';
                        $email['subject'] = 'Redefinir senha';
                        $email['objetivo'] = 'redefinirsenha';

                        $sender = new EmailSender($usuario, $email);
                        $sender->enviarEmail();

                        header('Location: https://'.$_SERVER['HTTP_HOST'].'/view/logar.php');
                    } else {
                        $_SESSION['error-message'] = 'Desculpe, mas não encontramos nenhum usuário com este email.';
                    }

                break;
                default :
                    header('Location: https://'.$_SERVER['HTTP_HOST'].'/view/logar.php');
                break;
            }
        } else {
            $userId = unserialize($_SESSION['usuario']);
            $userId = $userId['id'];

            switch($url){
                case '/verificaremail':
                    $ds = DIRECTORY_SEPARATOR;
                    $baseDir = realpath(dirname(__FILE__));
                    include_once($baseDir.'/functions/usuario/verificaremail.php');

                    verificarEmail($var, $userId);
                break;
                case '/redefinirsenha':
                    $usuario = buscarUsuario($userId);

                    if ($var == $usuario['chavesecreta']) {
                        header('Location: https://'.$_SERVER['HTTP_HOST'].'/view/redefinirsenha.php?'.$var);
                    }
                break;
                case '/deslogar':
                    session_destroy();

                    header('Location: https://'.$_SERVER['HTTP_HOST'].'/view/logar.php');
                break;
                case '/like':
                    include_once('functions/usuario/like.php');

                    $match['usuario1'] = $userId;
                    $match['usuario2'] = $_POST['usuario'];
                    $match['like_status'] = $var;

                    $dados = like($match);

                    if ($dados != '') {
                        echo json_encode($dados);
                    }
                break;
                case '/buscarperfisporid':
                    include_once('functions/usuario/buscarperfisporid.php');

                    $data = getUsuarioPorId($var);

                    echo json_encode($data);
                break;
                case '/atualizarpos':
                    include_once('.model/crud/usuario.php');
                    include_once('functions/usuario/atualizarpos.php');

                    $USER_UNSERIALIZED = unserialize($_SESSION['usuario']);
                    $USER_UNSERIALIZED['latitude'] = $_POST['latitude'];
                    $USER_UNSERIALIZED['longitude'] = $_POST['longitude'];
                    $_SESSION['usuario'] = serialize($USER_UNSERIALIZED);

                    atualizarUsuarioPos($USER_UNSERIALIZED, $userId);

                    $data = getUsuariosProximos();

                    echo json_encode($data);
                break;
                case '/atualizarperfil':
                    include_once('functions/usuario/atualizarperfil.php');

                    echo atualizarFotoPerfil($_FILES['img']);
                break;
                case '/adicionarroupas':
                    include_once('functions/roupas/adicionarroupas.php');

                    $files = array($_FILES['img1'], $_FILES['img2'], $_FILES['img3']);
                    $roupa['nome'] = trim($_POST['nome']);
                    $roupa['descricao'] = trim($_POST['descricao']);

                    if (strlen($roupa['nome']) <= 30 && strlen($roupa['descricao']) <= 200) {
                        $roupa['sexo'] = (int) $_POST['sexo'];
                        $roupa['categoria'] = (int) $_POST['categoria'];
                        $roupa['tipo'] = (int) $_POST['tipo'];
                        $roupa['estado'] = (int) $_POST['estado'];
                        $roupa['usuario'] = $userId;

                        adicionarRoupas($roupa, $files);
                    }
                break;
                case '/buscarfiltro':
                    $filtro = buscarConfig($userId);

                    echo $filtro;
                break;
                case '/buscarroupas':
                    $roupas = listarRoupa($userId);
                    $roupasComIndice = [];

                    foreach ($roupas as $indice => $roupa) {
                        $roupasComIndice[$indice] = $roupa;
                    }

                    echo json_encode($roupasComIndice);
                break;
                case '/deletarproduto':
                    deletarRoupa($var, $userId);
                break;
                case '/buscarroupasporid':
                    include_once('functions/roupas/buscarroupasporid');

                    $roupa = getRoupasPorId($var);

                    if(!empty($roupa)){
                        echo json_encode($roupa);
                    }
                break;
                case '/atualizarroupas':
                    $roupa = buscarRoupa($var, $userId);

                    echo json_encode($roupa);
                break;
                case '/atualizarroupasenviar':
                    include_once('functions/roupas/atualizarroupasenviar.php');

                    $files = array($_FILES['img1'], $_FILES['img2'], $_FILES['img3']);
                    $alteraImagens = array($_POST['alteraImagem1'], $_POST['alteraImagem2'], $_POST['alteraImagem3']);
                    $roupa['nome'] = trim($_POST['nome']);
                    $roupa['descricao'] = trim($_POST['descricao']);
                    $idRoupa = $_POST['id'];

                    if (strlen($roupa['nome']) <= 30 && strlen($roupa['descricao']) <= 200) {
                        $roupa['sexo'] = (int) $_POST['sexo'];
                        $roupa['categoria'] = (int) $_POST['categoria'];
                        $roupa['tipo'] = (int) $_POST['tipo'];
                        $roupa['estado'] = (int) $_POST['estado'];
                        $roupa['usuario'] = $userId;

                        atualizaRoupas($alteraImagens, $roupa, $files, $idRoupa);
                    }
                break;
                case '/atualizarfiltro':
                    $_POST['masculino'] = json_decode($_POST['masculino']);
                    $_POST['feminino'] = json_decode($_POST['feminino']);
                    $_POST['adulto'] = json_decode($_POST['adulto']);
                    $_POST['infantil'] = json_decode($_POST['infantil']);
                    $_POST['roupa'] = json_decode($_POST['roupa']);
                    $_POST['acessorio'] = json_decode($_POST['acessorio']);
                    $_POST['calcado'] = json_decode($_POST['calcado']);
                    $_POST['novo'] = json_decode($_POST['novo']);
                    $_POST['usado'] = json_decode($_POST['usado']);

                    if ($_POST['distancia'] >= 2 && $_POST['distancia'] <= 150) {
                        $config = $_POST;

                        atualizarConfig($config, $userId);
                    }
                break;
                case '/buscarmensagensantigas':
                    include_once('functions/mensagens/buscarmensagensantigas.php');

                    $idChat = $_POST['idChat'];
                    $scroll = $_POST['scroll'];

                    $dados = getMensagensAntigas($idChat, $scroll);

                    echo json_encode($dados);
                break;
                case '/buscarmensagens':
                    include_once('functions/mensagens/buscarmensagens.php');

                    $dados = getMensagens($var);

                    echo json_encode($dados);
                break;
                case '/buscarchats':
                    include_once('functions/mensagens/buscarchats.php');

                    $data = getChats();

                    echo json_encode(array_reverse($data));
                break;
                case '/enviamsg':
                    include_once('functions/mensagens/enviamensagem.php');

                    $texto = trim($_POST['text']);
                    $idChat = $_POST['idChat'];

                    echo (json_encode(enviarMensagem($texto, $idChat)));
                break;
                case '/mensagemnaovisualizada':
                    include_once('.model/crud/mensagem.php');

                    $mensagem = mensagemNaoVisualizada($userId);

                    echo($mensagem);
                break;
                case '/chatupdate':
                    include_once('functions/mensagens/chatupdate.php');

                    $date = $_POST['date'];
                    $mensagens = updateChat($var, $date);

                    echo(json_encode($mensagens));
                break;
                default :
                    header('Location: https://'.$_SERVER['HTTP_HOST'].'/view/main.php#'.$userId);
                break;
            }
        }
    }

?>
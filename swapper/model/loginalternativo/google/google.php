<?php

    $ds = DIRECTORY_SEPARATOR;
    $base_dir = realpath(dirname(__FILE__).$ds.'..'.$ds.'..'.$ds.'..');
    include_once($base_dir.'/lib/google/vendor/autoload.php');
    include_once($base_dir.'/model/crud/usuario.php');

    $client = new Google_Client();
    $client->setApplicationName("swapper");
    $client->setClientId('494210989312-msi1rtke4a6pc11skh6drghsiimhh7f1.apps.googleusercontent.com');
    $client->setClientSecret('7egj0D2Spq9BZoGzn8EPK9Vr');
    $client->addScope('profile');
    $client->addScope('email');
    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    $client->setRedirectUri($redirect_uri);

    $objRes = new Google_Service_Oauth2($client);

    if (isset($_GET['code'])) {
        $client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }

    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
        $client->setAccessToken($_SESSION['access_token']);
    }

    if ($client->getAccessToken()) {
        $userData = $objRes->userinfo->get();
        if(!empty($userData)) {
            $user['email'] = $userData['email'];
            $user['nome'] = $userData['name'];
            $user['foto'] = $userData['picture'];

            if ($userBanco = buscarUsuarioEmail($user)) {
                $_SESSION['usuario'] = serialize($userBanco);
                header('Location: http://'.$_SERVER['HTTP_HOST'].'/view/main.php');
            } else {
                $_SESSION['usuario-incompleto'] = serialize($user);
                header('Location: http://'.$_SERVER['HTTP_HOST'].'/view/cadastrocomplementar.php');
            }
        }
        $_SESSION['access_token'] = $client->getAccessToken();
    } else {
        $googleAuthUrl = $client->createAuthUrl();
    }

?>
<?php

    session_start();
    include_once('./facebook-init.php');
    include_once('/model/crud/usuario.php');

    try {
        $accessToken = $helper->getAccessToken();
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    $oAuth2Client = $fb->getOAuth2Client();
    $tokenMetadata = $oAuth2Client->debugToken($accessToken);
    $tokenMetadata->validateAppId('359120301376712');
    $tokenMetadata->validateExpiration();

    if (! $accessToken->isLongLived()) {
        try {
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
            exit;
        }
    }

    $_SESSION['fb_access_token'] = (string) $accessToken;

    try {
        $response = $fb->get('/me?fields=name, picture, email', $_SESSION['fb_access_token']);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    $userData = $response->getGraphUser();

    $user['email'] = $userData['email'];
    $user['nome'] = $userData['name'];
    $user['foto'] = $userData['picture']['url'];

    if ($userBanco = buscarUsuarioEmail($user)) {
        $_SESSION['usuario'] = serialize($userBanco);
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/view/main.php');
    } else {
        $_SESSION['usuario-incompleto'] = serialize($user);
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/view/cadastrocomplementar.php');
    }

?>

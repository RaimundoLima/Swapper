<?php

    $ds = DIRECTORY_SEPARATOR;
    $base_dir = realpath(dirname(__FILE__).$ds.'..'.$ds.'..'.$ds.'..'.$ds.'..');
    include_once($base_dir.'/lib/Facebook/autoload.php');

    $fb = new \Facebook\Facebook([
        'app_id' => '359120301376712',
        'app_secret' => 'd3591f74fe9a0f65fb91653a7549fbe6',
        'default_graph_version' => 'v3.2',
    ]);

    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email'];

    $loginUrl = $helper->getLoginUrl('http://'.$_SERVER['HTTP_HOST'].'/model/loginalternativo/facebook/facebook-init.php', $permissions);


?>
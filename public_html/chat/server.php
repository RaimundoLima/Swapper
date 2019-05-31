<?php

    $ds = DIRECTORY_SEPARATOR;
    $baseDir = realpath(dirname(__FILE__).$ds.'..'.$ds.'..');

    include_once($baseDir.'/public_html/chat/chatlistenner.php');
    include_once($baseDir.'/vendor/autoload.php');

    use App\ChatListenner;

    $app = new Ratchet\App('localhost', 8090);
    $app->route('/chat', new ChatListenner, array('*'));
    $app->run();

    // js
    // var conn = new WebSocket('ws://localhost:8090/chat');
    // conn.onmessage = function(e) { console.log(e.data); };
    // conn.onopen = function(e) { conn.send('Hello'); };

?>
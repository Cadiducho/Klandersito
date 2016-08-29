<?php
require('vendor/autoload.php');
require_once('config.php');

use Telegram\Bot\Api;

class Core {

    function init() {
        $config = new Config();
        $db = new mysqli($config::$mysqlServer, $config::$mysqlUser, $config::$mysqlPass, $config::$mysqlDatabase);

        if ($db->connect_errno > 0) {
            die('Fallo al conectar a MySQL [' . $db->connect_error . ']');
        }
        
        $telegram = new Api($config::$botKey);

        $response = $telegram->getMe();
        $botId = $response->getId();
        $firstName = $response->getFirstName();
        $username = $response->getUsername();
        
        $telegram->sendMessage(['chat_id' => $config::$groupid, 'text'=>'pole']);
        
        echo $firstName . "($username, $botId) iniciado" ;

        $db->close();
    }

}

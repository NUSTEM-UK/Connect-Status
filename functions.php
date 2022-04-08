<?php

declare(strict_types=1);
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
require __DIR__ . '/vendor/autoload.php';

// require_once('clientsecrets.php');
// console_log($dbHostname);

function getConnection() {
    require_once("clientsecrets.php");
    try {
        // $connection = new PDO("mysql:host=localhost;dbname=connect_census", "root", "");
        // $connection = new PDO("mysql:host=$dbHostname;dbname=$dbName", $dbUsername, $dbPassword);
        $connection = new PDO("mysql:host=".DB_HOSTNAME.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (Exception $e) {
        throw new Exception("Connection error: " . $e->getMessage(), 0, $e);
    }
}



function sendMood($mood) {
    require_once __DIR__ . '/vendor/autoload.php';
    require_once("clientsecrets.php");
    // echo "Mood command received: {$mood}\n";
    // echo "Connection data: ".MQTT_HOSTNAME.", ".MQTT_USERNAME.", ".MQTT_PASSWORD."\n";

    $connectionSettings = (new ConnectionSettings())
                                        ->setUsername(MQTT_USERNAME)
                                        ->setPassword(MQTT_PASSWORD);
    $mqtt = new MqttClient(MQTT_HOSTNAME, 1883);
    $mqtt->connect($connectionSettings, true);
    $mqtt->publish('Connect/NUSTEM/MOOD', $mood, 0);
    $mqtt->disconnect();

}


function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
?>

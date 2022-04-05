<?php

function getConnection() {
    try {
        $connection = new PDO("mysql:host=localhost;dbname=connect_census", "root", "");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (Exception $e) {
        throw new Exception("Connection error: " . $e->getMessage(), 0, $e);
    }
}

?>

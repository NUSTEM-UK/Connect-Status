<?php

try {
    require_once('functions.php');
    $dbConn = getConnection();
    echo getMoodData($dbConn);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

function getMoodData($dbConn) {
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin: *");

    $sql = "SELECT * FROM moods";

    try {
        $moodResults = $dbConn->query($sql);
        $moodData = $moodResults->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($moodData);
    } catch (Exception $e) {
        throw new Exception("Database problem: " . $e->getMessage(), 0, $e);
    }
}

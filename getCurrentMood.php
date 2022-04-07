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

    $sql = "SELECT paramValue FROM params WHERE paramName = 'current_mood'";

    try {
        $moodResults = $dbConn->query($sql);
        $moodData = $moodResults->fetch(PDO::FETCH_ASSOC);
        return json_encode($moodData);
        // return $moodData['paramValue'];
        // return print_r(($moodData));
    } catch (Exception $e) {
        throw new Exception("Database problem: " . $e->getMessage(), 0, $e);
    }
}

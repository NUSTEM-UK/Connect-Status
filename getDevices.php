<?php

try {
    require_once('functions.php');
    $dbConn = getConnection();
    echo getStatusData($dbConn);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

function getStatusData($dbConn) {
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin: *");

    $sql = "SELECT mac_address, last_seen, pings, label, cohort
            FROM devices
            WHERE first_seen IS NOT NULL";

    try {
        $statusResults = $dbConn->query($sql);
        $statusData = $statusResults->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($statusData);
    } catch (Exception $e) {
        throw new Exception("Database problem: " . $e->getMessage(), 0, $e);
    }
}

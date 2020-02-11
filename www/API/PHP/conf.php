<?php
    $servername = "10.0.2.15";
    $username = "root";
    $password = "root";
    $db = "gemmegag";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
?>

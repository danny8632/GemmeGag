<?php
    $servername = "192.168.86.227";
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

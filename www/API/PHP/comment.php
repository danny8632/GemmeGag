<?php
    include 'conf.php';

    if (isset($_POST["submit"])) {
        # TODO: Get user&postID from login session
        # Make sure userID & postID is used! In 'users' and 'posts' tables - otherwise SQL fails
        
        $sql = $conn->prepare("INSERT INTO comments (text, userID, postID) VALUES (?, ?, ?)");
        $text = $_POST["txtComment"];
        $userID = 1;
        $postID = 6;
        $sql->bind_param("sii", $text, $userID, $postID);

        if ($sql->execute()) {
            echo "<br/>Comment added to DB successfully";
        } else {
            echo "<br/>WONG";
        }
        $sql->close();
    } else {
        echo "<br/>Failed to access POST variable!";
    }
?>
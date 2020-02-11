<?php
    include 'conf.php';

    if (isset($_POST["submit"])) {
        # TODO: Make this a prepared statement
        # Make sure userID & postID is used! In 'users' and 'posts' tables - otherwise SQL fails
        $comment = $_POST["txtComment"];
        $sql = "INSERT INTO comments (text, userID, postID) VALUES ('" . $comment . "', 1, 6)";

        if ($conn->query($sql) === TRUE) {
            echo "<br/>Comment added to DB successfully";
        } else {
            echo "<br/>WONG";
        }
    } else {
        echo "<br/>Failed to access POST variable!";
    }
?>
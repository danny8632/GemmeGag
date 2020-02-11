<?php
    include "conf.php";

    $sql = "SELECT title, description, file FROM posts";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "title: " . $row["title"]. " - description: " . $row["description"]. " " . $row["file"]. "<br>";

            $dirname = $row["file"];
            $images = glob($dirname."*.png");

            foreach($images as $image) {
                echo '<img src="'.$image.'" /><br />';
            }
        }
    } else {
        echo "0 results";
    }
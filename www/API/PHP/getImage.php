<?php
    include "conf.php";

    $sql = "SELECT title, description, file FROM posts";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            
            ?>
            <h3><?php echo $row["title"]?></h3>
            <?php 
            $directory = $row["file"];
            echo '<img src="'.$directory.'" alt="">';
            ?>
            <p><?php echo $row["description"]?></p>
            <?php
        }
    } else {
        echo "0 results";
    }
?>
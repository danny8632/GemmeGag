<?php
    include 'conf.php';
    
    $title = trim($_POST["title"]);
    $desc = trim($_POST["description"]);
    $target_dir = "../../sites/upload/images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is allowed- " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not allowed.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    // if (file_exists($target_file)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }

    // Check file size
    // if ($_FILES["fileToUpload"]["size"] > 500000) {
    //     echo "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "mp3" && $imageFileType != "mp4") {
        echo "Sorry, only JPG, JPEG, PNG, GIF, MP3 & MP4 files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            
            $sql = $conn->prepare("INSERT INTO posts (title, description, file, userID) VALUES (?, ?, ?, ?)");
            // 'userID' - last parameter in bind_param call is currently hardcoded to 1
            $userID = 1;
            $sql->bind_param("sssi", $title, $desc, $target_file, $userID);
            if ($sql->execute()) {
                echo "Record created";
            } else {
                echo "WONG";
            }
            $sql->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>

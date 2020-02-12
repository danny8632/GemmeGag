<?php

require __DIR__."/../api.php";

class Post extends Api {

    private $conn;

    function __construct() {

        parent::__construct();

    }

    function _GET() 
    {

        $post_id;

        $req = $this->getRequest();

        $this->conn = $this->getDbConn();

        // Debug
        $request = [];
        $request['req'] = $req;


        $sql = "SELECT * FROM posts";

        if(isset($req[1]) && !empty($req[1]))
        {
            $req = $req[1];

            if(isset($req['id'])) $post_id = $req['id'];
            if(isset($req['post_id'])) $post_id = $req['post_id'];
        }

        if(isset($post_id) && !empty($post_id))
        {
            $stmt = $this->conn->prepare("SELECT posts.id, posts.title, posts.description, posts.file, posts.userID, users.name as name, users.username as username, posts.created FROM `posts` INNER JOIN users ON posts.userID = users.id WHERE `id` = :id");
            $stmt->bindParam(":id", $post_id);
            $stmt->execute();
        }
        else
        {
            $stmt = $this->conn->prepare("SELECT posts.id, posts.title, posts.description, posts.file, posts.userID, users.name as name, users.username as username, posts.created FROM `posts` INNER JOIN users ON posts.userID = users.id LIMIT 50");
            $stmt->execute();
        }

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        echo json_encode($result);
    }


    function _POST()
    {
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
    }

}
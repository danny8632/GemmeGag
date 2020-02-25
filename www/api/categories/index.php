<?php

require __DIR__."/../api.php";

session_start();

class Categories extends Api {

    private $conn;

    function __construct() {

        parent::__construct();

    }

    function _GET() 
    {

        

        echo json_encode($data);
    }


    function _POST()
    {
        $req = $this->getRequest()[1];

        if(empty($req) || !isset($req['category']) || empty($req['category']))
            return true;

        $target_file = "sites/upload/images/" . date("Y-m-d_H:i:s") . "_" . basename($_FILES["fileToUpload"]["name"]);

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "mp3" && $imageFileType != "mp4") {
            echo json_encode(array(
                "success" => false,
                "message" => "Sorry, only JPG, JPEG, PNG, GIF, MP3 & MP4 files are allowed."
            ));
            return true;
        }

        // Uploads file
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
        {
            $this->conn = $this->getDbConn();

            $title = trim($req['title']);
            $description = trim($req['description']);

            $stmt = $this->conn->prepare("INSERT INTO posts (title, description, file, userID) VALUES (:title, :description, :file, :userID)");
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':file', $target_file, PDO::PARAM_STR);
            $stmt->bindParam(':userID', $_SESSION["user_id"], PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                echo "Record created";
            } else {
                echo "WONG";
            }
        } 
        else 
        {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
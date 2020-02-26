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
        $id;
        $category;

        $req = $this->getRequest();

        $this->conn = $this->getDbConn();

        if(isset($req[1]) && !empty($req[1]))
        {
            $req = $req[1];
            if(isset($req['id'])) $id = $req['id'];
            if(isset($req['category_id'])) $id = $req['category_id'];
            if(isset($req['category'])) $category = $req['category'];
            if(isset($req['name'])) $category = $req['name'];
            if(isset($req['category_name'])) $category = $req['category_name'];
        }

        if(isset($id) && !empty($id))
        {
            $stmt = $this->conn->prepare("SELECT * FROM categories WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
        }
        else if(isset($category) && !empty($category))
        {
            $stmt = $this->conn->prepare("SELECT * FROM categories WHERE category = :category");
            $stmt->bindParam(":category", $category);
            $stmt->execute();
        }
        else
        {
            $stmt = $this->conn->prepare("SELECT * FROM categories");
            $stmt->execute();
        }

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        echo json_encode($result);
    }


    function _POST()
    {
        $req = $this->getRequest()[1];
        $this->conn = $this->getDbConn();

        if(empty($req) || !isset($req['category']) || empty($req['category']))
            return true;

        $category = trim($req['category']);
        $description = (isset($req['description']) && !empty($req['description']))?trim($req['description']):null;


        if(isset($_FILES) && !empty($_FILES) && isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]))
        {
            $target_file = "sites/categories/images/" . date("Y-m-d_H:i:s") . "_" . basename($_FILES["fileToUpload"]["name"]);
    
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
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) == false) 
            {
                echo "File upload failed";
                return true;
            }
        }
        else
        {
            $target_file = null;
        }

        $stmt = $this->conn->prepare("INSERT INTO categories (category, file, description) VALUES (:title, :file, :description)");
        $stmt->bindParam(':title', $category, PDO::PARAM_STR);
        $stmt->bindParam(':file', $target_file, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            echo "Record created";
        } else {
            echo "WONG";
        }
    }
}
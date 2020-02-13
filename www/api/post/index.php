<?php

require __DIR__."/../api.php";

session_start();

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


        if(isset($req[1]) && !empty($req[1]))
        {
            $req = $req[1];

            if(isset($req['id'])) $post_id = $req['id'];
            if(isset($req['post_id'])) $post_id = $req['post_id'];
        }

        if(isset($post_id) && !empty($post_id))
        {
            $stmt = $this->conn->prepare("SELECT posts.id, posts.title, posts.description, posts.file, posts.userID, users.name as name, users.username as username, posts.created, SUM(postvotes.vote = 'Upvote' AND postvotes.vote IS NOT NULL) AS 'UpVotes', SUM(postvotes.vote = 'Downvote' AND postvotes.vote IS NOT NULL) AS 'DownVotes', SUM(CASE WHEN postvotes.vote IS NOT NULL THEN IF(postvotes.vote = 'Upvote', 1, -1) END) AS `TotalVotes` FROM posts LEFT JOIN postvotes on posts.id = postvotes.postID LEFT JOIN users on posts.userID = users.id WHERE posts.id = :id GROUP BY posts.id, postvotes.postID ");
            $stmt->bindParam(":id", $post_id);
            $stmt->execute();
        }
        else
        {
            $stmt = $this->conn->prepare("SELECT posts.id, posts.title, posts.description, posts.file, posts.userID, users.name as name, users.username as username, posts.created, SUM(postvotes.vote = 'Upvote' AND postvotes.vote IS NOT NULL) AS 'UpVotes', SUM(postvotes.vote = 'Downvote' AND postvotes.vote IS NOT NULL) AS 'DownVotes', SUM(CASE WHEN postvotes.vote IS NOT NULL THEN IF(postvotes.vote = 'Upvote', 1, -1) END) AS `TotalVotes` FROM posts LEFT JOIN postvotes on posts.id = postvotes.postID LEFT JOIN users on posts.userID = users.id GROUP BY posts.id, postvotes.postID LIMIT 50");
            $stmt->execute();
        }

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        echo json_encode($result);
    }

    
    function _POST()
    {
        $req = $this->getRequest()[1];

        if(empty($req) || !isset($req['title']) || empty($req['title']) || !isset($req['description']) || empty($req['description']) || !isset($_SESSION["user_id"]))
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


    function getTrending()
    {
        $this->conn = $this->getDbConn();
        $stmt = $this->conn->prepare("SELECT * FROM trending_posts");
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        echo json_encode($result);
    }
}
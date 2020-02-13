<?php

require __DIR__."/../api.php";

session_start();

class Vote extends Api {

    private $conn;

    function __construct() {

        parent::__construct();

    }

    function _POST()
    {
        $id;
        $table = [];
        $upVote;

        if(isset($this->getRequest()[1]))
            $req = $this->getRequest()[1];
        else
        {
            echo json_encode(array(
                "success" => false,
                "message" => "U need to specify post_id or comment_id..."
            ));
            return true;
        }

        $this->conn = $this->getDbConn();

        if(isset($req) && !empty($req))
        {
            if(isset($req['post_id'])) 
            {
                $id = $req['post_id'];
                $table['table'] = "postvotes";
                $table['select'] = "postID";
            }
            if(isset($req['comment_id'])) 
            { 
                $id = $req['comment_id'];
                $table['table'] = "commentvotes";
                $table['select'] = "commentID";
            }
            if(isset($req['vote'])) $upVote = $req['vote'];

        }

        if(empty($id) || !isset($_SESSION["user_id"]) || empty($upVote))
        {
            echo json_encode(array(
                "success" => false,
                "message" => "Post or comment-id or text wasen't specified"
            ));
            return true;
        }

        $stmt = $this->conn->prepare("SELECT * FROM ". $table['table'] . " WHERE ".$table['select']." = :id AND userID = :userid");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':userid', $_SESSION["user_id"]);
        
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC)[0];

            if($result['vote'] == $upVote)
            {
                $stmt = $this->conn->prepare("DELETE FROM ". $table['table'] . " WHERE `id` = :id");
                $stmt->bindParam(':id', $result['id'], PDO::PARAM_INT);
            }
            else
            {
                $stmt = $this->conn->prepare("UPDATE ". $table['table'] . " SET vote=:vote WHERE `id` = :id");
                $stmt->bindParam(':vote', $upVote, PDO::PARAM_STR);
                $stmt->bindParam(':id', $result['id'], PDO::PARAM_INT);
            }

            $stmt->execute();
        }
        else
        {
            $stmt = $this->conn->prepare("INSERT INTO ". $table['table'] . " (`vote`, ".$table['select'].", `userID`) VALUES (:vote, :id, :userID)");
            $stmt->bindParam(':vote', $upVote, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':userID', $_SESSION["user_id"], PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                echo "Comment was created";
            } else {
                echo "WONG";
            }
        }
        
    }

}
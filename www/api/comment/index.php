<?php

require __DIR__."/../api.php";

session_start();

class Comment extends Api {

    private $conn;

    function __construct() {

        parent::__construct();

    }

    function _GET() 
    {

        $post_id;
        $user_id;
        $comment_id;
        
        $req = $this->getRequest();

        if(isset($req[1]))
            $req = $req[1];
        else
        {
            echo json_encode(array(
                "success" => false,
                "message" => "U need to specify ether user_id or post_id",
                "req" => json_encode($req)
            ));
            return true;
        }

        $this->conn = $this->getDbConn();

        if(isset($req) && !empty($req))
        {
            if(isset($req['id'])) $comment_id = $req['id'];
            if(isset($req['comment_id'])) $comment_id = $req['comment_id'];
            if(isset($req['commentID'])) $comment_id = $req['commentID'];
            if(isset($req['post_id'])) $post_id = $req['post_id'];
            if(isset($req['user_id'])) $user_id = $req['user_id'];
        }

        if(!empty($comment_id))
        {
            $stmt = $this->conn->prepare("SELECT `comments`.*, `users`.`username`, `users`.`name`, `users`.`id` AS 'user_id', SUM(commentvotes.vote = 'Upvote' AND commentvotes.vote IS NOT NULL) AS 'UpVotes', SUM(commentvotes.vote = 'Downvote' AND commentvotes.vote IS NOT NULL) AS 'DownVotes', SUM(CASE WHEN `commentvotes`.`vote` IS NOT NULL THEN IF(`commentvotes`.`vote` = 'Upvote', 1, -1) END) AS `TotalVotes` FROM `comments` INNER JOIN `users` ON `comments`.`userID` = `users`.`id` LEFT JOIN commentvotes on comments.id = commentvotes.commentID WHERE `comments`.`id` = :id GROUP BY comments.id, commentvotes.commentID ORDER BY comments.created DESC");
            $stmt->bindParam(":id", $comment_id);
            $stmt->execute();
        }
        else if(!empty($post_id))
        {
            $stmt = $this->conn->prepare("SELECT `comments`.*, `users`.`username`, `users`.`name`, `users`.`id` AS 'user_id', SUM(commentvotes.vote = 'Upvote' AND commentvotes.vote IS NOT NULL) AS 'UpVotes', SUM(commentvotes.vote = 'Downvote' AND commentvotes.vote IS NOT NULL) AS 'DownVotes', SUM(CASE WHEN `commentvotes`.`vote` IS NOT NULL THEN IF(`commentvotes`.`vote` = 'Upvote', 1, -1) END) AS `TotalVotes` FROM `comments` INNER JOIN `users` ON `comments`.`userID` = `users`.`id` LEFT JOIN commentvotes on comments.id = commentvotes.commentID WHERE `postID` = :id GROUP BY comments.id, commentvotes.commentID ORDER BY comments.created DESC");
            $stmt->bindParam(":id", $post_id);
            $stmt->execute();
        }
        else if(!empty($user_id))
        {
            $stmt = $this->conn->prepare("SELECT `comments`.*, `posts`.`title` AS 'post_title' FROM `comments` LEFT JOIN `posts` ON `comments`.`postID` = `posts`.`id` WHERE `comments`.`userID` = :id");
            $stmt->bindParam(":id", $user_id);
            $stmt->execute();
        }
        else
        {
            echo json_encode(array(
                "success" => false,
                "message" => "U need to specify ether user or post ID"
            ));
            return true;
        }

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $data = array();

        foreach ($result as $comment) 
        {
            $updut = array();
            if(isset($_SESSION["user_id"]))
            {
                $stmt = $this->conn->prepare("SELECT * FROM `commentvotes` WHERE `userID` = :id AND `commentID` = :commentid ");
                $stmt->bindParam(":id", $_SESSION["user_id"]);
                $stmt->bindParam(":commentid", $comment['id']);
                $stmt->execute();
                $updut = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }

            if($updut == null || empty($updut) || !isset($updut) || !isset($_SESSION["user_id"]))
            {
                $comment['your_vote'] = null;
            }
            else
            {
                $comment['your_vote'] = $updut[0]['vote'];
            }

            $data[] = $comment;
        }

        echo json_encode($data);
    }


    function _POST()
    {
        $post_id;
        $text;
        $req;

        if(isset($this->getRequest()[1]))
            $req = $this->getRequest()[1];
        else
        {
            echo json_encode(array(
                "success" => false,
                "message" => "U need to specify  post_id"
            ));
            return true;
        }

        $this->conn = $this->getDbConn();

        if(isset($req) && !empty($req))
        {
            if(isset($req['id'])) $post_id = $req['id'];
            if(isset($req['post_id'])) $post_id = $req['post_id'];
            if(isset($req['text'])) $text = trim($req['text']);
            if(isset($req['comment'])) $text = trim($req['comment']);
        }

        if(empty($post_id) || !isset($_SESSION["user_id"]) || empty($_SESSION["user_id"]) || empty($text))
        {
            echo json_encode(array(
                "success" => false,
                "message" => "Post or userid or text wasen't specified"
            ));
            return true;
        }

        $stmt = $this->conn->prepare("INSERT INTO `comments`(`text`, `postID`, `userID`) VALUES (:text, :postID, :userID)");
        $stmt->bindParam(':text', $text, PDO::PARAM_STR);
        $stmt->bindParam(':postID', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $_SESSION["user_id"], PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo "Comment was created";
        } else {
            echo "WONG";
        }
    }


    function updateComment() {

        $comment_id;
        $req;
        $text;

        if(isset($this->getRequest()[1]))
            $req = $this->getRequest()[1];
        else
        {
            echo json_encode(array(
                "success" => false,
                "message" => "U need to specify comment_id"
            ));
            return true;
        }

        $this->conn = $this->getDbConn();

        if(isset($req) && !empty($req))
        {
            if(isset($req['id'])) $comment_id = $req['id'];
            if(isset($req['comment_id'])) $comment_id = $req['comment_id'];
            if(isset($req['commentID'])) $comment_id = $req['commentID'];
            if(isset($req['text'])) $text = trim($req['text']);
            if(isset($req['comment'])) $text = trim($req['comment']);
        }


        $stmt = $this->conn->prepare("SELECT * FROM `comments` WHERE `id` = :id LIMIT 1");
        $stmt->bindParam(":id", $comment_id);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC)[0];

        if(empty($comment_id) || !isset($_SESSION["user_id"]) || empty($_SESSION["user_id"]) || empty($text) || $_SESSION["user_id"] != $result['userID'])
        {
            echo json_encode(array(
                "success" => false,
                "message" => "Post or userid or text wasen't specified"
            ));
            return true;
        }

        $stmt = $this->conn->prepare("UPDATE `comments` SET `text`= :text WHERE `id` = :id");
        $stmt->bindParam(':text', $text, PDO::PARAM_STR);
        $stmt->bindParam(":id", $comment_id);
        
        if ($stmt->execute()) {
            echo "Comment was updated";
        } else {
            echo "WONG";
        }

    }


    function deleteComment() {

        $comment_id;
        $req;

        if(isset($this->getRequest()[1]))
            $req = $this->getRequest()[1];
        else
        {
            echo json_encode(array(
                "success" => false,
                "message" => "U need to specify comment_id"
            ));
            return true;
        }

        $this->conn = $this->getDbConn();

        if(isset($req) && !empty($req))
        {
            if(isset($req['id'])) $comment_id = $req['id'];
            if(isset($req['comment_id'])) $comment_id = $req['comment_id'];
            if(isset($req['commentID'])) $comment_id = $req['commentID'];
        }

        $stmt = $this->conn->prepare("SELECT * FROM `comments` WHERE `id` = :id LIMIT 1");
        $stmt->bindParam(":id", $comment_id);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC)[0];

        if(empty($comment_id) || !isset($_SESSION["user_id"]) || empty($_SESSION["user_id"]) || $_SESSION["user_id"] != $result['userID'])
        {
            echo json_encode(array(
                "success" => false,
                "message" => "Post or userid wasen't specified"
            ));
            return true;
        }

        $stmt = $this->conn->prepare("DELETE FROM `comments` WHERE `id` = :id");
        $stmt->bindParam(':id', $comment_id, PDO::PARAM_INT);

        
        if ($stmt->execute()) {
            echo "Comment was deleted";
        } else {
            echo "WONG";
        }

    }

}
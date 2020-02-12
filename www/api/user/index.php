<?php

require __DIR__."/../api.php";

class User extends Api {

    private $conn;

    function __construct() {

        parent::__construct();

    }

    function _GET() 
    {
        $this->conn = $this->getDbConn();
        $stmt = $this->conn->prepare("SELECT * FROM posts");
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);


        echo json_encode($stmt->fetchAll());

    }

    function signUp() {

        $req = $this->getRequest();

        $name = $req[1]['name'];
        $username = $req[1]['username'];
        $password = $req[1]['password'];

        $password = password_hash($password, PASSWORD_DEFAULT);

        if(empty($username) || empty($password) || empty($name))
            return;

        $this->conn = $this->getDbConn();
        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `username` = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
            echo "Username is in use";
            return;
        }
        else
        {
            $stmt = $this->conn->prepare("INSERT INTO `users`(`name`, `username`, `password`) VALUES (:name, :username, :password)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            if($stmt->rowCount() > 0)
            {
                echo 'User has ben created';
            }

        }
    }


    function login() {

        $req = $this->getRequest()[1];

        if(empty($req))
        {
            echo "Req empty";
            return;
        }

        $username = $req['username'];
        $password = $req['password'];

        if(empty($username) || empty($password))
            return;

        $this->conn = $this->getDbConn();
        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `username` = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC)[0];

        if(empty($result))
        {
            echo "user dosn't exist";
        }
        else
        {
            if(password_verify($password, $result['password']))
            {
                echo json_encode(array(
                    "id" => $result['id'],
                    'name' => $result['name']
                    )
                );
            }
            else
            {
                echo "wong";
            }
        }
    }
}
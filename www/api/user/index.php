<?php

session_start();

require __DIR__."/../api.php";

class User extends Api {

    private $conn;

    function __construct() {

        parent::__construct();

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
        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `username` = :username OR `name` = :name");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':name', $name);
        
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
            echo json_encode(array(
                "success" => false,
                "msg" => "Username or Name already in use"
            ));
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
                echo json_encode(array(
                    "success" => true,
                    "msg" => "User has ben created"
                ));
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
        {
            echo json_encode($req);
            return;
        }

        $this->conn = $this->getDbConn();
        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `username` = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if($stmt->rowCount() == 0)
        {
            echo json_encode(array(
                "success" => false,
                "msg" => "User dosn't exists"
            ));
        }
        else
        {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC)[0];
            if(password_verify($password, $result['password']))
            {
                $_SESSION["user_id"] = $result['id'];
                $_SESSION["user_name"] = $result['name'];
                $_SESSION['username'] = $result['username'];

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

    function logout()
    {
        session_start();
        session_destroy();
        echo json_encode(array(
            "success" => true
        ));
        header("Location: ./../");
    }
}
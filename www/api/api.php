<?php

require __DIR__. "/../includes/db.php";

class Api extends DB {

    private $req;

    function __construct() {

        $this->req[0] = $_SERVER['REQUEST_METHOD'];

        if(!empty($_REQUEST))
        {
            $this->req[1] = $_REQUEST;

            if(!empty($_REQUEST['method']))
            {
                if(method_exists($this, $_REQUEST['method']))
                {
                    $method = $_REQUEST['method'];
                    $this->$method();
                }
            }
        }

    }

    public function getRequest()
    {
        return $this->req;
    }

    public function getDbConn()
    {
        $db = DB::getInstance();
        $conn = $db->getConnection();
        
    }

}


?>
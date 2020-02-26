<?php


class Sites {

    public $includeArr;

    public $globalArr = array();

    function __construct($arr, $extra_var = null) {
        $this->includeArr = $arr;

        require __DIR__."/templates/header.php";


        if(isset($_SESSION['user_id'])) $this->globalArr['user_id'] = $_SESSION['user_id'];
        if(isset($_SESSION['user_name'])) $this->globalArr['user_name'] = $_SESSION['user_name'];
        if(isset($_SESSION['username'])) $this->globalArr['username'] = $_SESSION['username'];
        if($extra_var != null) $this->globalArr['extra_var'] = $extra_var;


        if(!empty($this->globalArr))
            echo '<script>var global_var='.json_encode($this->globalArr).'</script>';

        if(!empty($arr['html']))
        {
            foreach ($arr['html'] as $value) {
                
                require $value;
            }
        }

        

    }

}
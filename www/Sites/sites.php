<?php


class Sites {

    public $includeArr;

    function __construct($arr) {
        $this->includeArr = $arr;

        require __DIR__."/Templates/header.php";

      

        if(!empty($arr['html']))
        {
            foreach ($arr['html'] as $value) {
                
                require $value;
            }
        }

    }

}
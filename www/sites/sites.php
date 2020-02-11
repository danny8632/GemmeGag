<?php


class Sites {

    public $includeArr;

    function __construct($arr) {
        $this->includeArr = $arr;

        require __DIR__."/templates/header.php";


        if(!empty($arr['html']))
        {
            foreach ($arr['html'] as $value) {
                
                require $value;
            }
        }

    }

}
<?php

class Database {
    public $con;
    public function __construct()
    {
        $this->con = mysqli_connect('localhost','root','',"test");
        // if($this->con){
        //     echo "connected";
        // }else{
        //     echo "not connected";
        // }
    }
    
}

?>
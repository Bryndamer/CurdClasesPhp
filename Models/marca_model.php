<?php

require("connect.php");

class marca_model {

    private $cnn;

    function __construct(){
        $connect = new connect();

        $this->cnn = $connect->getConnect();
        
    }

    public function getMarcas(){

        $query = "SELECT * FROM `tbmarcas`";
        $result = mysqli_query($this->cnn, $query);
        $list_return = array();

        while($row = mysqli_fetch_array($result)){
            array_push($list_return, $row);
        }

        return $list_return;

    }

}

?>
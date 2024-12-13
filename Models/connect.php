<?php

class connect {

    private $HOST = "localhost";
    private $USER = "root";
    private $PASS = "";
    private $DB = "dbparking";
    private $cnn;

    function __construct(){
        $this->cnn = mysqli_connect($this->HOST, $this->USER, $this->PASS, $this->DB);
    }

    public function getConnect(){
        return $this->cnn;
    }

    public function saludar(){
        return "Hola saludo";
    }

}

?>
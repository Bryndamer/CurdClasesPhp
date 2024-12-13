<?php

    require_once("connect.php");

    class modelo_model {

        private $cnn;

        function __construct(){
            $connect = new connect();

            $this->cnn = $connect->getConnect();
        }

        public function getModelWhere($id_marca){

            $query = "SELECT * FROM `tbmodelos` WHERE `FK_Marca` = {$id_marca}";
            $result = mysqli_query($this->cnn, $query);
            $list_return = array();

            while($row = mysqli_fetch_array($result)){
                array_push($list_return, $row);
            }

            return $list_return;

        }

    }

?>
<?php

    require_once("connect.php");

    class parking_model {

        private $cnn;

        function __construct(){
            $conectar = new connect();

            $this->cnn = $conectar->getConnect();
        }

        public function getParking(){

            $query = "SELECT * FROM `tbparking_logs`";
            $result = mysqli_query($this->cnn, $query);
            $list_return = array();

            while($row = mysqli_fetch_array($result)){
                array_push($list_return, $row);
            }

            return $list_return;

        }

        public function saveParking($Placa,$Marca,$Modelo,$TipoVehiculo,$HoraEntrada,$Piso,$NumParking){

            $query = "INSERT INTO `tbparking_logs`(`FK_Modelo`, `Placa`, `TipoVehiculo`, `HoraEntrada`, `Piso`, `NumParking`) VALUES ({$Modelo}, '{$Placa}', '{$TipoVehiculo}', '{$HoraEntrada}', '{$Piso}', '{$NumParking}');";

            $result = mysqli_query($this->cnn, $query);

        }

    }

?>
<?php

    require_once("../Models/connect.php");
    require_once("../Models/modelo_model.php");
    require_once("../Models/parking_model.php");

    $accion = $_POST["banderaAccion"];
    $modeloModel = new modelo_model();
    $parkingModel = new parking_model();

    switch ($accion) {
        case 'model_ajax':
            $listModelos = $modeloModel->getModelWhere($_POST["id"]);

            echo json_encode($listModelos);
            break;
        case "saveParkingLog":
            $Placa = $_POST["txtPlaca"];
            $Marca = $_POST["slcMarca"];
            $Modelo = $_POST["slcModelo"];
            $TipoVehiculo = $_POST["slcTipoVehiculo"];
            $HoraEntrada = $_POST["txtHoraEntrada"];
            $Piso = $_POST["txtPiso"];
            $NumParking = $_POST["txtNumParking"];

            $parkingModel->saveParking($Placa,$Marca,$Modelo,$TipoVehiculo,$HoraEntrada,$Piso,$NumParking);

            header("Location: /crud_basado_clases/Views/spa_crud.php");
            break;
        
        default:
            # code...
            break;
    }

?>
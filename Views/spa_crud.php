<?php include("./format/header.php") ?>

    <?php
        require_once("../Models/marca_model.php");
        require_once("../Models/parking_model.php");

        $marcaModel = new marca_model();
        $parkingModel = new parking_model();

        $listMarcas = $marcaModel->getMarcas();
        $listParking = $parkingModel->getParking();
    ?>

    <div class="container mt-5">

        <div class="row">
            <div class="col-12">
                <h1>Control de Parking</h1>
                <p>Aqui puedes ingresar la entrada de un carro para el control de parking, llena todos los campos que aparecen a continuacion</p>
            </div>
        </div>

        <form action="/crud_basado_clases/Controllers/crud_controller.php" method="POST">
            <input type="hidden" name="banderaAccion" value="saveParkingLog">
            <div class="row my-3">
                <div class="col-4">
                    <div class="form-group">
                        <label for="txtPlaca">Placa</label>
                        <input type="text" class="form-control" id="txtPlaca" name="txtPlaca">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="slcMarca">Marca</label>
                        <select class="form-control select2" name="slcMarca" id="slcMarca" onchange="getModelAjax(this.value)">
                            <option value="N/A">Seleccione</option>
                            <?php foreach($listMarcas as $marca): ?>
                                <option value="<?= $marca["ID_Marca"] ?>"><?= $marca["Marca"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="slcModelo">Modelo</label>
                        <select class="form-control select2" name="slcModelo" id="slcModelo"></select>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-3">
                    <div class="form-group">
                        <label for="slcTipoVehiculo">Tipo de Vehiculo</label>
                        <select class="form-control select2" name="slcTipoVehiculo" id="slcTipoVehiculo">
                            <option value="N/A">Seleccione</option>
                            <option value="Automovil">Automovil</option>
                            <option value="Motocicleta">Motocicleta</option>
                            <option value="Camion">Camion</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="txtHoraEntrada">Hora de Entrada</label>
                        <input type="text" class="form-control" id="txtHoraEntrada" name="txtHoraEntrada" readonly>
                        <p>Este campo se autollenara con la hora actual</p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="txtPiso">Piso</label>
                        <input type="text" class="form-control" id="txtPiso" name="txtPiso">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="txtNumParking"># Parking</label>
                        <input type="text" class="form-control" id="txtNumParking" name="txtNumParking">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-end">
                    <button class="btn btn-outline-success btn-lg" type="submit">Guardar</button>
                </div>
            </div>
        </form>

        <div class="row my-5">
            <div class="col-12">
                <h1>Carros Parqueados</h1>
                <p>En esta Tabla podras ver todos los carros parqueados actualmente en tu parqueo</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table nowrap display">
                    <thead>
                        <tr>
                            <th>Numero de Placa</th>
                            <th>Hora de Entrada</th>
                            <th>Minutos Transcurridos</th>
                            <th>Total en $</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listParking as $key => $value): ?>
                            <tr>
                                <td><?= $value["Placa"] ?></td>
                                <td><?= $value["HoraEntrada"] ?></td>
                                <td>
                                    <?php
                                        $entrada = new DateTime($value["HoraEntrada"]);
                                        $final = new DateTime();
                                        $minutos_resta = $entrada->diff($final);
                                        $resta_horas = $minutos_resta->format("%h");
                                        $resta_minutos = $minutos_resta->format("%i");
                                        $resta_segundos = $minutos_resta->format("%s");
                                    ?>
                                    <?= $resta_horas ?> horas, <?= $resta_minutos ?> minutos
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

<?php include("./format/footer.php") ?>

<script>
    $(document).ready(function() {
        $('.select2').select2();
        getFechaHoraActual();
    });

    function getFechaHoraActual() {
        let today = new Date();
        
        $("#txtHoraEntrada").val(today.toISOString());

        setTimeout(() => {
            getFechaHoraActual();
        }, 1000);
    }

    function getModelAjax(id){
        $.ajax({
            type: "POST",
            url: "/crud_basado_clases/Controllers/crud_controller.php",
            data: {
                banderaAccion: "model_ajax",
                id: id
            },
            success: (result) => {
                let list_modelos_response = JSON.parse(result);
                let modelo_select = document.getElementById("slcModelo");
                modelo_select.innerHTML = "";

                for (let modelo_key in list_modelos_response){
                    let modelo_value = list_modelos_response[modelo_key];

                    let option = document.createElement("option");
                    option.value = modelo_value.ID_Modelo;
                    option.innerHTML = modelo_value.Modelo;

                    modelo_select.append(option);
                }
            }
        })
    }
</script>
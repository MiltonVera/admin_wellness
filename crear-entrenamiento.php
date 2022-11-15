<?php include_once "templates/header.php"; ?>
<?php include_once "templates/sidebar.php" ?>
<?php include_once "functions/connection.php" ?>



<div class="card">
    <div class="card-header">
        <h3 class="card-title">Creador de Entrenamiento</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="models/modelo-entrenamiento.php" method="post" id="guardar-registro">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del Entrenamiento">
                </div>

                <div class="form-group col-md-3">
                    <label>Clasificación</label>
                    <select class="form-control" id="clasificacion" name="clasificacion">
                        <option>Adaptación Anatómica</option>
                        <option>Fuerza</option>
                        <option>Hipertrofia</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label>Nivel</label>
                    <select class="form-control" id="nivel_entrenamiento" name="nivel_entrenamiento">
                        <option>Basico</option>
                        <option>Intermedio</option>
                        <option>Avanzado</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label>Sub-Nivel</label>
                    <select class="form-control" id="subnivel_entrenamiento" name="subnivel_entrenamiento">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <h2 class="col-12" style="font-size:18ox ;">Rutinas</h2>
            </div>


            <div class="row" id="rutinas">

                <div class="tarjeta col-md-3 m-3">

                    <label>Rutina</label>
                    <div class="row align-items-center">
                        <div class="form-group col-12">

                            <select class="select2" style="width: 100%;" name="rutina[]">
                                <option disabled selected="selected">---Seleccionar---</option>
                                <?php
                                try {
                                    $sql = "SELECT * FROM rutina";
                                    $resultado = $conn->query($sql);
                                } catch (Exception $e) {
                                    $error = $e->getMessage();
                                    echo $error;
                                }
                                while ($row = $resultado->fetch_assoc()) { ?>
                                    <option value="<?php echo $row["id_rutina"] ?>"><?php echo $row["nombre"] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nivel">Nivel</label>
                            <input type="text" id="nivel" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="subnivel">Subnivel</label>
                            <input type="text" id="sub_nivel" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <button class="btn btn-danger col-9" id="eliminar">Eliminar</button>
                        <button href="#" class="btn btn-primary col-2 ver-entrenamiento" id="ver"><i class="fa-solid fa-eye-low-vision"></i></button>
                    </div>

                </div>

                <button class="tarjeta col-md-4 m-3" id="agregar">
                    <i class="fa-solid fa-plus"></i>
                </button>


            </div>


        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <input type="hidden" name="registro" value="crear">
            <input type="submit" class="btn btn-success col-12" value="Generar Entrenamiento">
        </div>
    </form>
</div>

<?php include_once "templates/footer.php"; ?>
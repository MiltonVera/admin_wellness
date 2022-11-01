<?php include_once "templates/header.php"; ?>
<?php include_once "templates/sidebar.php" ?>
<?php include_once "functions/connection.php" ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Creador de Rutina</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form name="guardar-registro" action="models/modelo-rutina.php" id="guardar-registro" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre de la Rutina">
                </div>

                <div class="form-group col-md-3">
                    <label>Clasificación</label>
                    <select class="form-control" id="clasificacion" name="clasificacion">
                        <option value="Adaptacion" >Adaptación Anatómica</option>
                        <option>Fuerza</option>
                        <option>Hipertrofia</option>
                        <option>Calentamiento</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label>Nivel</label>
                    <select class="form-control" name="nivel_rutina">
                        <option>Basico</option>
                        <option>Intermedio</option>
                        <option>Avanzado</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label>Sub-Nivel</label>
                    <select class="form-control" name="subnivel">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <h2 class="col-12" style="font-size:18ox ;">Ejercicios</h2>
            </div>


            <div class="row" id="ejercicios">
                <div class="tarjeta col-md-3 m-3">
                    <div class="row">
                        <div class="form-group col-8">
                            <label>Ejercicio</label>
                            <select class="select2" style="width: 100%;" name="ejercicio">
                            <option disabled selected="selected" >---Seleccionar---</option>
                                <?php
                            try {
                                $sql = "SELECT * FROM ejercicio";
                                $resultado = $conn->query($sql);
                            } catch (Exception $e) {
                                $error = $e->getMessage();
                                echo $error;
                            }
                            
                            while($ejercicio = $resultado->fetch_assoc() ) { ?>
                                <option value="<?php echo $ejercicio["id_ejercicio"] ?>"><?php echo $ejercicio["nombre"] ?></option>
                            <?php } ?>  
                            </select>
                        </div>
                        <div class="col-4">
                            <img src="image/prueba.jpg" class="imagen-ejercicio" alt="Ejercicio">
                        </div>

                        <input type="hidden" id="id" name="id[]">
                        <input type="hidden" id="nombre_ejercicio" name="nombre_ejercicio[]">
                        <input type="hidden" id="zona_cuerpo" name="zona_cuerpo[]">
                        <input type="hidden" id="musculo" name="musculo[]">
                        <input type="hidden" id="nivel" name="nivel[]">
                        <input type="hidden" id="url_gif" name="url_gif[]">

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="serie">Series</label>
                            <input type="number" class="form-control" name="serie[]">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="repeticion">Repeticiones</label>
                            <input type="number" class="form-control" name="repeticion[]">
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="repeticion">Descanso</label>
                            <input type="number" class="form-control" name="descanso[]" min=0 max=10 step=".5" placeholder="Minutos de Descanso">
                        </div>
                    </div>
                    <button class="btn btn-danger col-12" id="eliminar">Eliminar</button>
                </div>

                <button class="tarjeta col-md-4 m-3" id="agregar">
                    <i class="fa-solid fa-plus"></i>
                </button>

            </div>


        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <input type="hidden" name="registro" value="crear">
            <input type="submit" class="btn btn-success col-12" value="Generar Rutina"></input>
        </div>
    </form>
</div>

<?php include_once "templates/footer.php"; ?>
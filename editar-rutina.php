<?php include_once "templates/header.php"; ?>
<?php include_once "templates/sidebar.php" ?>
<?php include_once "functions/connection.php" ?>

<?php 
$id = $_GET['id'];
if(!filter_var($id,FILTER_VALIDATE_INT)){
    die('Error se cambio el id manualmente');
}

$sql = "SELECT * FROM rutina WHERE id_rutina=$id";
$resultado = $conn->query($sql);
$rutina = $resultado->fetch_assoc();

?>

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
                    <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo $rutina["nombre"] ?>">
                </div>

                <div class="form-group col-md-3">
                    <label>Clasificación</label>
                    <select class="form-control" id="clasificacion" name="clasificacion">
                        <option <?php echo $rutina["clasificacion"] == 'Adaptacion' ? "selected='Selected'" : "" ?> >Adaptación Anatómica</option>
                        <option <?php echo $rutina["clasificacion"] == 'Fuerza' ? "selected='Selected'" : "" ?> >Fuerza</option>
                        <option <?php echo $rutina["clasificacion"] == 'Hipertrofia' ? "selected='Selected'" : "" ?> >Hipertrofia</option>
                        <option <?php echo $rutina["clasificacion"] == 'Calentamiento' ? "selected='Selected'" : "" ?> >Calentamiento</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label>Nivel</label>
                    <select class="form-control" name="nivel_rutina">
                    <option <?php echo $rutina["nivel"] == 'Basico' ? "selected='Selected'" : "" ?>>Basico</option>
                    <option <?php echo $rutina["nivel"] == 'Intermedio' ? "selected='Selected'" : "" ?>>Intermedio</option>
                    <option <?php echo $rutina["nivel"] == 'Avanzado' ? "selected='Selected'" : "" ?>>Avanzado</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label>Sub-Nivel</label>
                    <select class="form-control" name="subnivel">
                        <option <?php echo $rutina["subnivel"] == 1 ? "selected='Selected'" : "" ?> >1</option>
                        <option <?php echo $rutina["subnivel"] == 2 ? "selected='Selected'" : "" ?>>2</option>
                        <option <?php echo $rutina["subnivel"] == 3 ? "selected='Selected'" : "" ?>>3</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <h2 class="col-12" style="font-size:18ox ;">Ejercicios</h2>
            </div>


            <?php 
                $ejercicios = json_decode($rutina["ejercicios"],true);
            ?>
            <div class="row" id="ejercicios">

                <?php foreach($ejercicios as $ejercicio ){ ?>
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
                                
                                while($salida = $resultado->fetch_assoc() ) { ?>
                                    <option <?php echo $ejercicio["nombre"] == $salida["nombre"] ? "selected='Selected'" : "" ?> value="<?php echo $salida["id_ejercicio"] ?>"><?php echo $salida["nombre"] ?></option>
                                <?php } ?>  
                                </select>
                            </div>
                            <div class="col-4">
                                <img src="<?php echo $ejercicio["url_gif"] ?>" class="imagen-ejercicio" alt="Ejercicio">
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
                                <input type="number" class="form-control" name="serie[]" value="<?php echo $ejercicio["serie"] ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="repeticion">Repeticiones</label>
                                <input type="number" class="form-control" name="repeticion[]" value="<?php echo $ejercicio["repeticion"] ?>">
                            </div>

                        </div>
                    
                    <button class="btn btn-danger col-12" id="eliminar">Eliminar</button>
                </div>

                <?php } ?>



                <button class="tarjeta col-md-4 m-3" id="agregar">
                    <i class="fa-solid fa-plus"></i>
                </button>

            </div>


        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <input type="hidden" name="registro" value="crear">
            <input type="submit" class="btn btn-primary" value="Agregar"></input>
        </div>
    </form>
</div>

<?php include_once "templates/footer.php"; ?>
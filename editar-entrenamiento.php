<?php include_once "templates/header.php"; ?>
<?php include_once "templates/sidebar.php" ?>
<?php include_once "functions/connection.php" ?>

<?php 

$id = $_GET['id'];
$crear = $_GET['copiar'];
if(!filter_var($id,FILTER_VALIDATE_INT)){
    die('Error se cambio el id manualmente');
}

$sql = "SELECT * FROM entrenamiento WHERE id_entrenamiento=$id";
$resultado = $conn->query($sql);
$entrenamiento = $resultado->fetch_assoc();


?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Editor de Entrenamiento</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="models/modelo-entrenamiento.php" method="post" id="guardar-registro">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo !isset($_GET["copiar"]) ? $entrenamiento["nombre"] : "Copia de ".$entrenamiento["nombre"] ;?>" id="nombre">
                </div>

                <div class="form-group col-md-3">
                    <label>Clasificación</label>
                    <select class="form-control" id="clasificacion" name="clasificacion">
                        <option <?php echo $entrenamiento["clasificacion"] == 'Adaptación Anatómica' ? "selected='Selected'" : "" ?> >Adaptación Anatómica</option>
                        <option <?php echo $entrenamiento["clasificacion"] == 'Fuerza' ? "selected='Selected'" : "" ?> >Fuerza</option>
                        <option <?php echo $entrenamiento["clasificacion"] == 'Hipertrofia' ? "selected='Selected'" : "" ?> >Hipertrofia</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label>Nivel</label>
                    <select class="form-control" id="nivel_entrenamiento" name="nivel_entrenamiento">
                        <option <?php echo $entrenamiento["nivel"] == 'Basico' ? "selected='Selected'" : "" ?> >Basico</option>
                        <option <?php echo $entrenamiento["nivel"] == 'Intermedio' ? "selected='Selected'" : "" ?>>Intermedio</option>
                        <option <?php echo $entrenamiento["nivel"] == 'Avanzado' ? "selected='Selected'" : "" ?>>Avanzado</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label>Sub-Nivel</label>
                    <select class="form-control" id="subnivel_entrenamiento" name="subnivel_entrenamiento">
                        <option <?php echo $entrenamiento["sub_nivel"] == '1' ? "selected='Selected'" : "" ?> >1</option>
                        <option <?php echo $entrenamiento["sub_nivel"] == '2' ? "selected='Selected'" : "" ?> >2</option>
                        <option <?php echo $entrenamiento["sub_nivel"] == '3' ? "selected='Selected'" : "" ?> >3</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <h2 class="col-12" style="font-size:18px ;">Rutinas</h2>
            </div>

            <?php
            $rutinas = json_decode($entrenamiento["rutinas"], true);
            
            ?>
            <div class="row" id="rutinas">
            <?php foreach ($rutinas as $rutina) { ?>


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
                                    <option <?php echo $rutina["id_rutina"] == $row["id_rutina"] ? "selected" : "" ?>  value="<?php echo $row["id_rutina"] ?>"><?php echo $row["nombre"] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nivel">Nivel</label>
                            <input type="text" id="nivel" class="form-control" value="<?php echo $rutina["nivel"] ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="subnivel">Subnivel</label>
                            <input type="text" id="sub_nivel" class="form-control" value="<?php echo $rutina["sub_nivel"] ?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <button class="btn btn-danger col-9" id="eliminar">Eliminar</button>
                        <button href="#" class="btn btn-primary col-2 ver-entrenamiento" id="ver"><i class="fa-solid fa-eye-low-vision"></i></button>
                    </div>

                </div>
                <?php } ?>

                <button class="tarjeta col-md-4 m-3" id="agregar">
                    <i class="fa-solid fa-plus"></i>
                </button>


            </div>


        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <?php if (!$crear) { ?>
                <input type="hidden" name="registro" value="editar">
                <input type="hidden" name="id"  value="<?php echo $entrenamiento["id_entrenamiento"]; ?>">
                <input type="submit" class="btn btn-success col-12" value="Editar Entrenamiento">
            <?php } else { ?>
                <input type="hidden" name="registro" value="crear">
                <input type="submit" class="btn btn-success col-12" value="Copiar Entrenamiento"></input>
            <?php } ?>
        </div>
    </form>
</div>

<?php include_once "templates/footer.php"; ?>
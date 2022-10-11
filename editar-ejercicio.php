
<?php
$id = $_GET['id'];
if(!filter_var($id,FILTER_VALIDATE_INT)){
    die('Error se cambio el id manualmente');
}

include_once "templates/header.php"; 
include_once "templates/sidebar.php";
include_once "functions/connection.php";
 
$sql = "SELECT * FROM ejercicio WHERE id_ejercicio=$id";
$resultado = $conn->query($sql);
$ejercicio = $resultado->fetch_assoc();

                        
 ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Editar Ejercicio</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form name="guardar-registro" action="models/modelo-ejercicio.php" id="guardar-registro-archivo" method="post" enctype="multipart/form-data">
        <div class="card-body">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo $ejercicio["nombre"] ?>">
            </div>

            <div class="form-group col-md-6">
                <label>Nivel</label>
                <select class="form-control" name="nivel">
                    <option <?php echo $ejercicio["nivel"] == 'Basico' ? "selected='Selected'" : "" ?>>Basico</option>
                    <option <?php echo $ejercicio["nivel"] == 'Intermedio' ? "selected='Selected'" : "" ?>>Intermedio</option>
                    <option <?php echo $ejercicio["nivel"] == 'Avanzado' ? "selected='Selected'" : "" ?>>Avanzado</option>
                </select>
            </div>
        </div>

            <div class="row">

                <div class="form-group col-md-6">
                    <label>Zona de Cuerpo</label>
                    <select class="form-control" name="zona">
                        <option  <?php echo $ejercicio["zona"] == 'Tren Superior' ? "selected='Selected'" : "" ?>>Tren Superior</option>
                        <option  <?php echo $ejercicio["zona"] == 'Tren Inferior' ? "selected='Selected'" : "" ?>>Tren Inferior</option>
                        <option  <?php echo $ejercicio["zona"] == 'Core' ? "selected='Selected'" : "" ?>>Core</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Musculo</label>
                    <select class="select2" style="width: 100%;" name="musculo">
                        <option  <?php echo $ejercicio["musculo"] == 'Triceps' ? "selected='Selected'" : "" ?>>Triceps</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Pecho' ? "selected='Selected'" : "" ?>>Pecho</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Deltoides' ? "selected='Selected'" : "" ?>>Deltoides</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Trapecio' ? "selected='Selected'" : "" ?>>Trapecio</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Antebrazo' ? "selected='Selected'" : "" ?>>Antebrazo</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Gemelos' ? "selected='Selected'" : "" ?>>Gemelos</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Isquiotibiales' ? "selected='Selected'" : "" ?>>Isquiotibiales</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Aductores' ? "selected='Selected'" : "" ?>>Aductores</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Abductores' ? "selected='Selected'" : "" ?>>Abductores</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Gluteo' ? "selected='Selected'" : "" ?>>Gluteo</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Cuadriceps' ? "selected='Selected'" : "" ?>>Cuadriceps</option>
                        <option <?php echo $ejercicio["musculo"] == 'Biceps Femoral' ? "selected='Selected'" : "" ?>>Biceps Femoral</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Soleos' ? "selected='Selected'" : "" ?>>Soleos</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Recto Abdominal' ? "selected='Selected'" : "" ?>>Recto Abdominal</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Psoas' ? "selected='Selected'" : "" ?>>Psoas</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Iliocostal' ? "selected='Selected'" : "" ?>>Iliocostal</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Oblicuos' ? "selected='Selected'" : "" ?>>Oblicuos</option>
                        <option <?php echo $ejercicio["musculo"] == 'Cuadrado Lumbar' ? "selected='Selected'" : "" ?>">Cuadrado Lumbar</option>
                        <option  <?php echo $ejercicio["musculo"] == 'Transverso' ? "selected='Selected'" : "" ?>>Transverso</option>
                    </select>
                </div>

            </div>

            <div class="row">

                <div class="form-group col-md-6">
                    <label for="ejecucion">Gif de ejecución</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="ejecucion" class="custom-file-input" id="ejecucion">
                            <label class="custom-file-label" for="ejecucion">Elige un Archivo</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Subir</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <input type="hidden" name="id" value="<?php echo $ejercicio["id_ejercicio"] ?>">
            <input type="hidden" name="registro" value="editar">
            <input type="submit" class="btn btn-primary"></input>
        </div>
    </form>
</div>

<?php include_once "templates/footer.php"; ?>
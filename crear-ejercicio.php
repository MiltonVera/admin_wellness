<?php include_once "templates/header.php"; ?>
<?php include_once "templates/sidebar.php" ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Crear Ejercicio</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form>
        <div class="card-body">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Enter email">
            </div>

            <div class="form-group col-md-6">
                <label>Nivel</label>
                <select class="form-control" name="nivel">
                    <option>Basico</option>
                    <option>Intermedio</option>
                    <option>Avanzado</option>
                </select>
            </div>
        </div>

            <div class="row">

                <div class="form-group col-md-6">
                    <label>Zona de Cuerpo</label>
                    <select class="form-control" name="nivel">
                        <option>Tren Superior</option>
                        <option>Tren Inferior</option>
                        <option>Core</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Musculo</label>
                    <select class="select2" multiple="multiple" data-placeholder="Selecciona un musculo" style="width: 100%;" name="musculo">
                        <option>Triceps</option>
                        <option>Pecho</option>
                        <option>Deltoides</option>
                        <option>Trapecio</option>
                        <option>Antebrazo</option>
                        <option>Gemelos</option>
                        <option>Isquiotibiales</option>
                        <option>Aductores</option>
                        <option>Abductores</option>
                        <option>Glúteo</option>
                        <option>Cuadriceps</option>
                        <option>Biceps Femoral</option>
                        <option>Soleos</option>
                        <option>Recto Abdominal</option>
                        <option>Psoas</option>
                        <option>Iliocostal</option>
                        <option>Oblicuos</option>
                        <option>Cuadrado Lumbar</option>
                        <option>Transverso</option>
                    </select>
                </div>

            </div>

            <div class="row">

                <div class="form-group col-md-6">
                    <label for="portada">Imagen de Portada</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="portada">
                            <label class="custom-file-label" for="portada">Elige un Archivo</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Subir</span>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="ejecucion">Gif de ejecución</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="ejecucion">
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
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>

<?php include_once "templates/footer.php"; ?>
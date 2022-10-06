<?php include_once "templates/header.php"; ?>
<?php include_once "templates/sidebar.php" ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Creador de Rutina</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre de la Rutina">
                </div>

                <div class="form-group col-md-3">
                    <label>Nivel</label>
                    <select class="form-control" name="nivel">
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
                                <option value="Press">Press de Banca</option>
                                <option value="Fondos">Fondos</option>
                                <option value="Lagartijas">Lagartijas</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <img src="image/prueba.jpg" class="imagen-ejercicio" alt="Ejercicio">
                        </div>

                        <input type="hidden" id="id" name="id[]" value="2">
                        <input type="hidden" id="zona_cuerpo" name="zona_cuerpo[]" value="Superior">
                        <input type="hidden" id="musculo" name="musculo[]" value="Pecho">
                        <input type="hidden" id="nivel" name="nivel[]" value="Basico">
                        <input type="hidden" id="url_img" name="url_img[]" value="imagen/imagen1.jpg">
                        <input type="hidden" id="url_gif" name="url_gif[]" value="imagen/imagen1.gif">

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
                    <button class="btn btn-danger col-12" id="eliminar">Eliminar</button>
                </div>

                <button class="tarjeta col-md-4 m-3" id="agregar">
                    <i class="fa-solid fa-plus"></i>
                </button>

            </div>


        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>

<?php include_once "templates/footer.php"; ?>
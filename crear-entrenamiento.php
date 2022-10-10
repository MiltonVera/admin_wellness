<?php include_once "templates/header.php"; ?>
<?php include_once "templates/sidebar.php" ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Creador de Entrenamiento</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre del Entrenamiento">
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
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Rutina</label>
                            <select class="select2" style="width: 100%;" name="rutina">
                                <option value="Fantastica">Rutina Fantástica</option>
                                <option value="Chevere">Rutina Chevere</option>
                                <option value="Otra">Hola, soy otra rutina</option>
                            </select>
                        </div>
                        <input type="hidden" id="id" name="id[]" value="2">

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nivel">Nivel</label>
                            <input type="text" id="nivel" class="form-control" name="nivel[]" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="subnivel">Subnivel</label>
                            <input type="number" id="sub_nivel" class="form-control" name="subnivel[]" readonly >
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
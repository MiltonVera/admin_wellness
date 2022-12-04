<?php include_once "templates/header.php"; ?>
<?php include_once "templates/sidebar.php" ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Crear Administrador</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="models/modelo-admin.php">
        <div class="card-body">

            <div class="form-group col-4">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre del Coach" name="nombre">
            </div>

            <div class="form-group col-4">
                <label for="correo">Correo Institucional</label>
                <input type="email" class="form-control" id="correo" placeholder="Tu Correo" name="correo">
            </div>

            <div class="form-group col-4">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" placeholder="Contraseña de usuario" name="password">
            </div>

            <div class="form-group col-4">
                <label>Rol</label>
                <select class="form-control" name="admin">
                    <option value="0">Coach</option>
                    <option value="1">Rector</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <input type="hidden" name='registro' value='nuevo'>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>

<?php include_once "templates/footer.php"; ?>
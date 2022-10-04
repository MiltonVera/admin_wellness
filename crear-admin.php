<?php include_once "templates/header.php"; ?>
 <?php include_once "templates/sidebar.php" ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Crear Administrador</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form>
        <div class="card-body">
            <div class="form-group col-4">
                <label for="correo">Correo Institucional</label>
                <input type="email" class="form-control" id="correo" placeholder="Tu Correo">
            </div>
            <div class="form-group col-4">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Contraseña">
            </div>
            <div class="form-group col-4">
                <label>Rol</label>
                <select class="form-control">
                    <option>Coach</option>
                    <option>Rector</option>
                </select>
            </div>
            
            
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>

<?php include_once "templates/footer.php"; ?>
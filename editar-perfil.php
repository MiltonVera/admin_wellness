<?php include_once "templates/header.php"; ?>
<?php include_once "templates/sidebar.php" ?>
<?php include_once "functions/connection.php" ?>

<?php 
    $id = $_SESSION['id'];
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
      die("Error!");
    }

    $sql = "SELECT * FROM entrenador WHERE id_entrenador = $id";
    $admin = $conn->query($sql)->fetch_assoc();

?>


<div class="card">
    <div class="card-header">
        <h3 class="card-title">Editar Administrador</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="models/modelo-admin.php">
        <div class="card-body">

            <div class="form-group col-4">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre del Coach" name="nombre" value="<?php echo $admin["nombre"] ?>">
            </div>

            <div class="form-group col-4">
                <label for="correo">Correo Institucional</label>
                <input type="email" class="form-control" id="correo" placeholder="Tu Correo" name="correo" value="<?php echo $admin["correo"] ?>">
            </div>

            <div class="form-group col-4">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" placeholder="Si no la va a cambiar deje este campo vacío" name="password">
            </div>
            
        </div>
        <div class="card-footer">
            <input type="hidden" name='registro' value='actualizar'>
            <input type="hidden" name='id_registro' value='<?php echo $id ?>'>
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>
</div>

<?php include_once "templates/footer.php"; ?>


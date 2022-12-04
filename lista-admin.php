<?php include_once "templates/header.php"; ?>
<?php include_once "templates/sidebar.php" ?>
<?php include_once "functions/connection.php" ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Administradores</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabla" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <th>Admin</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM entrenador";
                                $resultado = $conn->query($sql);

                                while ($row = $resultado->fetch_assoc()) {
                                ?>

                                    <tr>
                                        <td><?php echo $row["correo"] ?></td>
                                        <td><?php echo $row["nombre"] ?></td>
                                        <td><?php echo $row["admin"] ?></td>
                                        <td>
                                            <a href="editar-admin.php?id=<?php echo $row['id_entrenador'] ?>" href="#" class="btn bg-orange btn-flat margin">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a  href="#" data-id="<?php echo $row['id_entrenador']; ?>" data-tipo="admin"  class="btn bg-maroon bnt-flat borrar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>

                                <?php } ?>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?php include_once "templates/footer.php"; ?>
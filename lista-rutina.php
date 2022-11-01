<?php include_once "templates/header.php"; ?>
<?php include_once "templates/sidebar.php" ?>
<?php include_once "functions/connection.php" ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Rutinas</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabla" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Nivel</th>
                                    <th>Subnivel</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                         <?php
                                try {
                                    $sql = "SELECT * FROM rutina";
                                    $resultado = $conn->query($sql);
                                } catch (Exception $e) {
                                    $error = $e->getMessage();
                                    echo $error;
                                }
                                
                                while($rutina = $resultado->fetch_assoc() ) { ?>
                                        <tr>
                                            <td><?php echo $rutina["nombre"] ?></td>
                                            <td><?php echo $rutina["clasificacion"] ?></td>
                                            <td><?php echo $rutina["nivel"] ?></td>

                                            <td>
                                                <a href="editar-rutina.php?id=<?php echo $rutina["id_rutina"] ?>" class="btn mx-2 bg-orange btn-flat margin">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a href="#" data-id="<?php echo $rutina["id_rutina"]?>" class="btn mx-2 bg-indigo bnt-flat modal_rutina">
                                                    <i class="fa-solid fa-eye"></i>    
                                                </a>
                                                <a href="#" data-tipo="rutina" data-id="<?php echo $rutina["id_rutina"] ?>" class="btn mx-2 bg-maroon bnt-flat borrar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                <a href="editar-rutina.php?id=<?php echo $rutina["id_rutina"]?>&copiar=True" class="btn mx-2 bg-blue bnt-flat">
                                                    <i class="fa-solid fa-copy"></i>
                                                </a>
                                            </td>
                                            
                                        </tr>                             
                          <?php } ?> 
                                
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Nivel</th>
                                    <th>Subnivel</th>
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
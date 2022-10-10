<?php include_once "templates/header.php"; ?>
<?php include_once "templates/sidebar.php" ?>
<?php include_once "functions/connection.php" ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ejercicios</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabla" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Portada</th>
                                    <th>Nombre</th>
                                    <th>Zona de Cuerpo</th>
                                    <th>Músculo</th>
                                    <th>Nivel</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                        <?php
                        try {
                            $sql = "SELECT * FROM ejercicio";
                            $resultado = $conn->query($sql);
                        } catch (Exception $e) {
                            $error = $e->getMessage();
                            echo $error;
                        }
                        
                        while($ejercicio = $resultado->fetch_assoc() ) { ?>
                                <tr>
                                    <td><img width="100" src="<?php echo $ejercicio["url_gif"] ?>" /></td>
                                    <td><?php echo $ejercicio["nombre"] ?></td>
                                    <td><?php echo $ejercicio["zona_cuerpo"] ?></td>
                                    <td><?php echo $ejercicio["musculo"] ?></td>
                                    <td><?php echo $ejercicio["nivel"] ?></td>
                                    <td>
                                        <a href="editar-ejercicio.php?id=<?php echo $ejercicio["id_ejercicio"] ?>" class="btn bg-orange btn-flat margin">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </td>
                                    
                                </tr>                             
                          <?php } ?>      
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Portada</th>
                                    <th>Nombre</th>
                                    <th>Zona de Cuerpo</th>
                                    <th>Músculo</th>
                                    <th>Nivel</th>
                                    <th>Editar</th>
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
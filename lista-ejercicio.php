<?php include_once "templates/header.php"; ?>
<?php include_once "templates/sidebar.php" ?>


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
                        <table id="admins" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Portada</th>
                                    <th>Nombre</th>
                                    <th>Zona de Cuerpo</th>
                                    <th>Músculo</th>
                                    <th>Nivel</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr>
                                    <td><img width="100" src="image\prueba.jpg" /></td>
                                    <td>Press Militar</td>
                                    <td>Tren Superior</td>
                                    <td>Pecho</td>
                                    <td>
                                        <a href="#" class="btn bg-orange btn-flat margin">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="#" class="btn bg-maroon bnt-flat">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td><img width="100" src="./image/prueba.jpg" /></td>
                                    <td>Press de Banca</td>
                                    <td>Tren Superior</td>
                                    <td>Pecho</td>
                                    <td>
                                        <a href="#" class="btn bg-orange btn-flat margin">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="#" class="btn bg-maroon bnt-flat">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td><img width="100" src="./image/prueba.jpg" /></td>
                                    <td>Otro Press</td>
                                    <td>Tren Superior</td>
                                    <td>Pecho</td>
                                    <td>
                                        <a href="#" class="btn bg-orange btn-flat margin">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="#" class="btn bg-maroon bnt-flat">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                    
                                </tr>
                                
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Portada</th>
                                    <th>Nombre</th>
                                    <th>Zona de Cuerpo</th>
                                    <th>Músculo</th>
                                    <th>Nivel</th>
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
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
                        <table id="tabla" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr>
                                    <td>a00833393@tec.mx</td>
                                    <td>Venorica Perez</td>
                                    <td>Coach</td>
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
                                    <td>a00833393@tec.mx</td>
                                    <td>Mario Rodriguez</td>
                                    <td>Rector</td>
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
                                    <td>a00833393@tec.mx</td>
                                    <td>Pedro Infante</td>
                                    <td>Rector</td>
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
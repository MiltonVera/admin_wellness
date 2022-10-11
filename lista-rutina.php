<?php include_once "templates/header.php"; ?>
<?php include_once "templates/sidebar.php" ?>


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
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr>
                                    <td>Rutina Fantástica</td>
                                    <td>Básico</td>
                                    <td>1</td>
                                    <td>
                                        <a href="#" class="btn bg-orange btn-flat margin">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="#" class="btn bg-maroon bnt-flat">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <a href="#" class="btn bg-blue bnt-flat">
                                            <i class="fa-solid fa-copy"></i>
                                        </a>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>Rutina Chevere</td>
                                    <td>Básico</td>
                                    <td>2</td>
                                    <td>
                                        <a href="#" class="btn bg-orange btn-flat margin">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="#" class="btn bg-maroon bnt-flat">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <a href="#" class="btn bg-blue bnt-flat">
                                            <i class="fa-solid fa-copy"></i>
                                        </a>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>Hola, soy otra rutina</td>
                                    <td>Básico</td>
                                    <td>3</td>
                                    <td>
                                        <a href="#" class="btn bg-orange btn-flat margin">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="#" class="btn bg-maroon bnt-flat">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <a href="#" class="btn bg-blue bnt-flat">
                                            <i class="fa-solid fa-copy"></i>
                                        </a>
                                    </td>
                                    
                                </tr>
                                
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Nivel</th>
                                    <th>Subnivel</th>
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
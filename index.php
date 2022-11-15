 <?php include_once "templates/header.php"; ?>
 <?php include_once "templates/sidebar.php" ?>

    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <a href="lista-ejercicio.php">
              <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fa-solid fa-person-running"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Ejercicios</span>
                  <span class="info-box-number">
                    10
                    <small>%</small>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          </a>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <a href="lista-rutina.php">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-dumbbell"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Rutinas</span>
                  <span class="info-box-number">41,410</span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <a href="lista-entrenamiento.php">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fa-solid fa-star"></i></span>
              
                <div class="info-box-content">
                  <span class="info-box-text">Entrenamientos</span>
                  <span class="info-box-number">760</span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Estudiantes</span>
                <span class="info-box-number">2,000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 id="card-header--h2_Resultado_Buscador_alumno" class="mb-0">
                <button id="card-header--h2--button_Resultado_Buscador_alumno" class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Javier Hernández Balcázar
                </button>
                <div id="card-header--h2--div_Resultado_Buscador_alumno">
                    <button type="button" class="btn btn-primary"><i class="fa-duotone fa-dumbbell"></i> Asignar Rutina</button>
                    <button type="button" class="btn btn-danger"><i class="fa-solid fa-check-to-slot"></i></button>
                    <button type="button" class="btn btn-success"><i class="fa-solid fa-chart-line"></i></button>
                </div>
              </h2>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">

                <canvas id="myChart" width="400" height="400"></canvas>
                <canvas id="miChart" width="400" height="400"></canvas>

              </div>
            </div>
          </div>
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
  <script>


  </script>


  
<?php include_once "templates/footer.php"; ?>
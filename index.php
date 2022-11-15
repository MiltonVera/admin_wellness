 <?php include_once "templates/header.php"; ?>
 <?php include_once "templates/sidebar.php" ?>

    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <a class="Dashboard__link" href="lista-ejercicio.php">
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
            <a class="Dashboard__link" href="lista-rutina.php">
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
            <a class="Dashboard__link" href="lista-entrenamiento.php">
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

        <form class="barraBuscadora">
          <fieldset class="barraBuscadora__fieldset">
            <legend class="barraBuscadora__legend">Búsqueda</legend>

            <input class="barraBuscadora__input" type="text">
            <button class="barraBuscadora__boton" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
          </fieldset>
        </form>

        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 id="card-header--h2_Resultado_Buscador_alumno" class="mb-0">
                <button id="card-header--h2--button_Resultado_Buscador_alumno" class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Javier Hernández Balcázar
                </button>
                <div id="card-header--h2--div_Resultado_Buscador_alumno">
                    <button type="button" class="btn btn-primary"><i class="fa-duotone fas fa-dumbbell"></i> <span id="asingarRutina__boton__texto">Asignar Rutina</span></button>
                    <button type="button" class="btn btn-danger"><i class="fa-solid fa-check-to-slot"></i></button>
                    <button type="button" class="btn btn-success"><i class="fa-solid fa-chart-line"></i></button>
                </div>
              </h2>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body graficasAccordion">
                <div class="espacioGrafica__asistencia">
                  <h3 class="graficas__texto">Gráfica Asistencia</h3>
                  <canvas id="myChart" class="grafica__asistencia" width="800" height="400"></canvas>
                </div>

                <div class="espacioGrafica__pesoAlumno">
                  <h3 class="graficas__texto">Gráfica Peso Alumno</h3>
                  <canvas id="miChart" class="grafica__pesoAlumno" width="800" height="400"></canvas>
                </div>

                <div class="espacioGrafica__RM">
                  <h3 class="graficas__texto">Gráfica RM's Básico</h3>
                  <canvas id="monChart" class="grafica__PR" width="400" height="200"></canvas>
                </div>

                <div class="espacioGrafica__emocional">
                  <h3 class="graficas__texto">Gráfica Emocional</h3>
                  <canvas id="mChart" class="grafica__emocional" width="400" height="200"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

        <section>
          <div>
            <h2 class="grafica__fueraAccordion__texto">Gráfica de Asistencia Mensual General</h2>
            <canvas id="maChart" width="400" height="200"></canvas>
          </div>
          <hr class="grafica__fueraAccordion__lineaDivisioria">
          <div>
            <h2 class="grafica__fueraAccordion__texto">Gráfica de Asistencia Semanal General</h2>
            <canvas id="meChart" width="400" height="200"></canvas>
          </div>
        </section>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
  <script>

  </script>


  
<?php include_once "templates/footer.php"; ?>
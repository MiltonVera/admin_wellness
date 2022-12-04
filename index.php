<?php include_once "templates/header.php"; ?>
 <?php include_once "templates/sidebar.php" ?>
 <?php include_once "functions/connection.php" ?>

 <?php
  $sql = "SELECT (SELECT COUNT(*) FROM ejercicio ) as ejercicios, (SELECT COUNT(*) FROM rutina ) as rutinas,(SELECT COUNT(*) FROM entrenamiento ) as entrenamientos,(SELECT COUNT(*) FROM alumno ) as alumnos";
  $datos = $conn->query($sql);
  $datos = $datos->fetch_assoc();
?>

    
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
                    <?php echo $datos["ejercicios"] ?>
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
                  <?php echo $datos["rutinas"] ?>
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
                  <?php echo $datos["entrenamientos"] ?>
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
                <span class="info-box-number"><?php echo $datos["alumnos"] ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <form class="barraBuscadora" id="buscador" method="post">
          <fieldset class="barraBuscadora__fieldset">
            <legend class="barraBuscadora__legend">Búsqueda</legend>

            <input class="barraBuscadora__input" name="busqueda" type="text">
            <button class="barraBuscadora__boton" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
          </fieldset>
        </form>

        <div class="modal_index"></div>

        <div class="accordion" id="alumno-buscador"> <!--onclcik primeravez = false etiqueta también cambiar-->
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 id="card-header--h2_Resultado_Buscador_alumno" class="mb-0">
                <button id="card-header--h2--button_Resultado_Buscador_alumno" class="btn btn-link btn-block text-left alumno" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  
                </button>
                <div id="card-header--h2--div_Resultado_Buscador_alumno">
                    <button type="button" class="btn btn-primary accionar_modal"><i class="fa-duotone fas fa-dumbbell"></i> <span class="asignarRutina__boton__texto">Asignar Rutina</span></button>
                    <button type="button" class="btn btn-warning asistencia"><i class="fa-solid fa-check-to-slot"></i></button>
                </div>
              </h2>
            </div>

            <section class="accordion__datosElementales">
              <div>
                <p class="accordion__datosElementales__subtitulo">Matrícula</p>
                <p id="matricula"></p>
              </div>
              <div>
                <p class="accordion__datosElementales__subtitulo">Nivel</p>
                <p id="nivel"></p>
              </div>
              <div>
                <p class="accordion__datosElementales__subtitulo">Objetivos</p>
                <ol class="accordion__datosElementales__objetivos" id="objetivos">
                  
                </ol>
              </div>
              <div>
                <p class="accordion__datosElementales__subtitulo" >Lesión</p>
                <p id="lesion"></p>
              </div>
              <div>
                <p class="accordion__datosElementales__subtitulo" >Tiempo sin entrenar</p>
                <p id="descanso"></p>
              </div>
            </section>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#alumno-buscador">
              <div class="card-body graficasAccordion">
                <div class="espacioGrafica__asistencia">
                  <h3 class="graficas__texto">Gráfica Asistencia</h3>
                  <canvas id="GraficaAsistencia" class="grafica__asistencia" width="800" height="400"></canvas>
                </div>

                <div class="espacioGrafica__pesoAlumno">
                  <h3 class="graficas__texto">Gráfica Peso Alumno</h3>
                  <canvas id="GraficaPesoAlumno" class="grafica__pesoAlumno" width="800" height="400"></canvas>
                </div>

                <div class="espacioGrafica">
                  <h3 class="graficas__texto">Carga Semanal</h3>
                  <canvas id="GraficaCargaSemanal" width="400" height="200"></canvas>
                </div>
                <div class="espacioGrafica">
                  <h3 class="graficas__texto">Monotonía</h3>
                  <canvas id="GraficaMonotonia" width="400" height="200"></canvas>
                </div>
                <div class="espacioGrafica">
                  <h3 class="graficas__texto">Fatiga</h3>
                  <canvas id="GraficaFatiga" width="400" height="200"></canvas>
                </div>

                


              </div>
            </div>
          </div>
        </div>

        <section>
          <div>
            <h2 class="grafica__fueraAccordion__texto">Gráfica de Asistencia Mensual General</h2>
            <canvas id="GraficaMensualGeneral" width="400" height="200"></canvas>
          </div>
          <hr class="grafica__fueraAccordion__lineaDivisioria">
          <div>
            <h2 class="grafica__fueraAccordion__texto">Gráfica de Asistencia Semanal General</h2>
            <canvas id="GraficaSemanalGeneral" width="400" height="200"></canvas>
          </div>
        </section>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
  <script>

  </script>


  
<?php include_once "templates/footer.php"; ?>
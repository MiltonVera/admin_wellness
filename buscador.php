<?php
 include_once "../functions/connection.php";
 include_once "templates/header.php"; 
 include_once "templates/sidebar.php" ?>

    <section class="content">
      <div class="container-fluid">
        

        <form class="barraBuscadora" id="buscador" method="post">
          <fieldset class="barraBuscadora__fieldset">
            <legend class="barraBuscadora__legend">Búsqueda</legend>

            <input class="barraBuscadora__input" name="busqueda" type="text">
            <button class="barraBuscadora__boton" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
          </fieldset>
        </form>

        <div class="modal_index"></div>

        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 id="card-header--h2_Resultado_Buscador_alumno" class="mb-0">
                <button id="card-header--h2--button_Resultado_Buscador_alumno" class="btn btn-link btn-block text-left alumno" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  
                </button>
                <div id="card-header--h2--div_Resultado_Buscador_alumno">
                    <button type="button" class="btn btn-primary accionar_modal"><i class="fa-duotone fas fa-dumbbell"></i> <span id="asingarRutina__boton__texto">Asignar Rutina</span></button>
                    <button type="button" class="btn btn-danger asistencia"><i class="fa-solid fa-check-to-slot"></i></button>
                    <button type="button" class="btn btn-success"><i class="fa-solid fa-chart-line"></i></button>
                </div>
              </h2>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
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
                  <div class="form-floating">
                    <select class="form-select espacioGrafica__RM__select" id="floatingSelect" aria-label="Floating label select example">
                      <option selected>Escoge un RM</option>
                      <option value="1">Sentadilla</option>
                      <option value="2">Press de Banca</option>
                      <option value="3">Peso Muerto</option>
                      <option value="4">Press Militar</option>
                    </select>
                  </div>
                  <canvas id="monChart" class="grafica__PR" width="400" height="200"></canvas>
                </div>

                <div class="espacioGrafica__emocional">
                  <h3 class="graficas__texto">Gráfica de Percepcion del Esfuerzo</h3>
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
$(function () {
  /* Inicializamos las graficas */
  const ctx = document.getElementById("GraficaAsistencia").getContext("2d");
  const GraficaAsistencia = new Chart(ctx, {
    type: "bar",
    data: {
      labels: [],
      datasets: [
        {
          label: "# de Asistencias",
          data: [],
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        },
      },
      responsive: true,
      maintainAspectRatio: true,
    },
  });

  const cty = document.getElementById("GraficaPesoAlumno").getContext("2d");
  const GraficaPesoAlumno = new Chart(cty, {
    type: "line",
    data: {
      labels: [],
      datasets: [
        {
          label: "Kg del Alumno",
          data: [],
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        x: {
          ticks: {
            maxRotation: 90,
            minRotation: 90,
          },
        },
        y: {
          beginAtZero: true,
        },
      },
      responsive: true,
      maintainAspectRatio: true,
    },
  });

  const cta = document
    .getElementById("GraficaPercepcionEsfuerzo")
    .getContext("2d");
  const GraficaPercepcionEsfuerzo = new Chart(cta, {
    type: "line",
    data: {
      labels: [],
      datasets: [
        {
          label: "# de puntos",
          data: [],
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
      responsive: true,
      maintainAspectRatio: true,
    },
  });
  /* Fin de inicializacion de las graficas y comienzo de la implementacion de buscador */
  let buscador = document.querySelector("#buscador");
  buscador.addEventListener("submit", function (e) {
    e.preventDefault();
    let busqueda = $(this).serializeArray()[0].value;

    // Revisa si se esta buscando por matricula
    if (busqueda.substring(0, 2).toLowerCase() == "a0") {
      $.ajax({
        type: "post",
        data: {
          accion: "buscar_matricula",
          matricula: busqueda,
        },
        url: "models/modelo-alumno.php",
        dataType: "json",
        success: function (data) {
          //Si existe una respuesta es porque hubo un error

          if (data.respuesta) {
            Swal.fire({
              icon: "error",
              title: "No se encontro el alumno",
              text: "Revisa la matricula o intenta la busqueda por nombre",
              footer: "",
            });
            return;
          }

          $(".alumno").text(data.nombre);
          $(".accionar_modal").attr("id", data.id_alumno);
          $(".asistencia").attr("id", data.id_alumno);
          actualizarGraficas(
            GraficaAsistencia,
            GraficaPesoAlumno,
            GraficaPercepcionEsfuerzo,
            data.id_alumno
          );

        },
      });
      return;
    }
    $.ajax({
      type: "post",
      data: {
        accion: "buscar",
        nombre: busqueda,
      },
      url: "models/modelo-alumno.php",
      dataType: "json",
      success: function (data) {
        if (data.respuesta) {
          Swal.fire({
            icon: "error",
            title: "No se encontro el alumno",
            text: "Revisa el nombre o intenta la busqueda por matricula",
            footer: "",
          });
          return;
        }
        $(".alumno").text(data.nombre);
        $(".accionar_modal").attr("id", data.id_alumno);
        $(".asistencia").attr("id", data.id_alumno);
        actualizarGraficas(
          GraficaAsistencia,
          GraficaPesoAlumno,
          GraficaPercepcionEsfuerzo,
          GraficaRMBasico,
          data.id_alumno
        );



      },
    });

  });
});

function actualizarGraficas(asistencia, peso, esfuerzo, id) {
  //Ahora hay que hacer la consulta a la base de datos para obtener los datos necesatios para graficar
  $.ajax({
    type: "post",
    data: {
      accion: "datos",
      alumno: id,
    },
    async:false,
    url: "models/modelo-alumno.php",
    dataType: "json",
    success: function (data) {
      //Actualizaremos primero la de asistencia
      console.log("Actualizar Graficas");
      actualizarGrafica(
        asistencia,
        data.asistencia.labels,
        data.asistencia.values
      );
      actualizarGrafica(peso, data.peso.labels, data.peso.values);
      actualizarGrafica(esfuerzo, data.esfuerzo.labels, data.esfuerzo.values);

      
      
    },
  });
}
function actualizarGrafica(grafico, labels, values) {
  grafico.data.labels = labels;
  grafico.data.datasets[0].data = values;
}
function actualizarRM()
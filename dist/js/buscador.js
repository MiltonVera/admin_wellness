$(function () {
  /* Inicializamos las graficas */ 
  const ctx = document.getElementById("GraficaAsistencia").getContext("2d");
  const GraficaAsistencia = new Chart(ctx, {
    type: "line",
    data: {
      labels: [
        "07/11/22",
        "08/11/22",
        "09/11/22",
        "10/11/22",
        "11/11/22",
        "12/11/22",
        "13/11/22",
      ],
      datasets: [
        {
          label: "# de Asistencias",
          data: [12, 19, 3, 5, 2, 3],
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

  const cty = document.getElementById("GraficaPesoAlumno").getContext("2d");
  const GraficaPesoAlumno = new Chart(cty, {
    type: "line",
    data: {
      labels: [
        "17/10/22 - 23/10/22",
        "24/10/22 - 30/10/22",
        "31/10/22 - 06/11/22",
        "07/11/22 - 13/11/22",
      ],
      datasets: [
        {
          label: "Kg del Alumno",
          data: [12, 19, 3, 5, 2, 3],
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

  const ctz = document.getElementById("GraficaRMBasico").getContext("2d");
  const GraficaRMBasico = new Chart(ctz, {
    type: "line",
    data: {
      labels: ["Sentadilla"],
      datasets: [
        {
          label: "Kg",
          data: [12, 19, 3, 5],
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

  const cta = document
    .getElementById("GraficaPercepcionEsfuerzo")
    .getContext("2d");
  const GraficaPercepcionEsfuerzo = new Chart(cta, {
    type: "line",
    data: {
      labels: [
        "07/11/22",
        "08/11/22",
        "09/11/22",
        "10/11/22",
        "11/11/22",
        "12/11/22",
        "13/11/22",
      ],
      datasets: [
        {
          label: "# de puntos",
          data: [12, 19, 3, 5, 2, 3],
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
          actualizarGraficas(GraficaAsistencia,GraficaPesoAlumno,GraficaRMBasico,GraficaPercepcionEsfuerzo,data.id_alumno)
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
      },
    });
  });
});

function actualizarGraficas(asistencia,peso,rm,esfuerzo,id){
  console.log(asistencia)
  console.log(peso)
  console.log(rm)
  console.log(esfuerzo)
  console.log(id)
}

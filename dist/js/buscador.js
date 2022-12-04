$(function () {
  let ctx = [];
  /* Inicializamos las graficas */
  ctx.push(document.getElementById("GraficaAsistencia").getContext("2d"));
  ctx.push(document.getElementById("GraficaPesoAlumno").getContext("2d"));
  ctx.push(document.getElementById("GraficaCargaSemanal").getContext("2d"));
  ctx.push(document.getElementById("GraficaMonotonia").getContext("2d"));
  ctx.push(document.getElementById("GraficaFatiga").getContext("2d"));
  //const ctxx = ;
  const GraficaAsistencia = new Chart(ctx[0], {
    type: "bar",
    data: {
      labels: [],
      datasets: [
        {
          label: "# de Asistencias",
          data: [],
          backgroundColor: ["#007bff"],
          borderColor: ["#007bff"],
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

  const GraficaPesoAlumno = new Chart(ctx[1], {
    type: "line",
    data: {
      labels: [],
      datasets: [
        {
          label: "Kg del Alumno",
          data: [],
          backgroundColor: ["#007bff"],
          borderColor: ["#007bff"],
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

  const GraficaCargaSemanal = new Chart(ctx[2], {
    type: "line",
    data: {
      labels: [],
      datasets: [
        {
          label: "# de puntos",
          data: [],
          backgroundColor: ["#007bff"],
          borderColor: ["#007bff"],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
        x: {
          title: {
            display: true,
            align: "center",
            text: "Semana",
          },
        },
      },
      responsive: true,
      maintainAspectRatio: true,
    },
  });
  const GraficaMonotonia = new Chart(ctx[3], {
    type: "line",
    data: {
      labels: [],
      datasets: [
        {
          label: "# de puntos",
          data: [],
          backgroundColor: ["#007bff"],
          borderColor: ["#007bff"],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
        x: {
          title: {
            display: true,
            align: "center",
            text: "Semana",
          },
        },
      },
      responsive: true,
      maintainAspectRatio: true,
    },
  });
  const GraficaFatiga = new Chart(ctx[4], {
    type: "line",
    data: {
      labels: [],
      datasets: [
        {
          label: "# de puntos",
          data: [],
          backgroundColor: ["#007bff"],
          borderColor: ["#007bff"],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
        x: {
          title: {
            display: true,
            align: "center",
            text: "Semana",
          },
        },
      },
      responsive: true,
      maintainAspectRatio: true,
    },
  });
  /* Fin de inicializacion de las graficas y comienzo de la implementacion de buscador */

  let buscador = document.querySelector("#buscador");
  buscador.addEventListener("submit", function (e) {
    document.querySelector(".preloader").style.height = null;
    document.querySelector(".animation__wobble").style.display = null;

    document.querySelector(".collapse").classList.remove("show");

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
          respuestaHandler(
            data,
            "nombre",
            GraficaAsistencia,
            GraficaPesoAlumno,
            GraficaCargaSemanal,
            GraficaMonotonia,
            GraficaFatiga
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
        respuestaHandler(
          data,
          "matricula",
          GraficaAsistencia,
          GraficaPesoAlumno,
          GraficaCargaSemanal,
          GraficaMonotonia,
          GraficaFatiga
        );
      },
    });
  });
});
function respuestaHandler(
  data,
  busqueda,
  GraficaAsistencia,
  GraficaPesoAlumno,
  GraficaCargaSemanal,
  GraficaMonotonia,
  GraficaFatiga
) {
  document.querySelector(".preloader").style.height = "0";
  document.querySelector(".animation__wobble").style.display = "none";

  if (data.respuesta) {
    Swal.fire({
      icon: "error",
      title: `No se encontro el alumno`,
      text: `Revisa el nombre o intenta la busqueda por ${busqueda}`,
      footer: "",
    });
    return;
  }
  actualizarAlumno(data);
  actualizarGraficas(
    GraficaAsistencia,
    GraficaPesoAlumno,
    GraficaCargaSemanal,
    GraficaMonotonia,
    GraficaFatiga,
    data.id_alumno
  );
}

function actualizarGraficas(asistencia, peso, carga, monotonia, fatiga, id) {
  //Ahora hay que hacer la consulta a la base de datos para obtener los datos necesatios para graficar
  $.ajax({
    type: "post",
    data: {
      accion: "datos",
      alumno: id,
    },
    async: false,
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

      actualizarGrafica(
        carga,
        data.carga_semanal.labels,
        data.carga_semanal.values
      );
      actualizarGrafica(
        monotonia,
        data.monotonia.labels,
        data.monotonia.values
      );
      actualizarGrafica(fatiga, data.fatiga.labels, data.fatiga.values);
    },
  });
}
function actualizarGrafica(grafico, labels, values) {
  grafico.data.labels = labels;
  grafico.data.datasets[0].data = values;
}

function actualizarAlumno(data) {
  let objetivosParser = {
    1: "Bajar de Peso",
    2: "Hipertrofia",
    3: "Mantenerse Sano",
    4: "Ganar Fuerza",
    5: "Estetica",
  };

  let nivelParser = ["Nada de Experiencia","Menos de un año","De 1 a 2 años","Mas de dos años"]
  let descansoParser = ["Nunca ha entranado","Maximo Dos Semanas","De 3 a 6 semanas","Mas de 6 semanas"]
  let lesionParser = ["No","Si"]

  $(".alumno").text(data.nombre);

  matricula.textContent = data.matricula;
  nivel.textContent = nivelParser[parseInt(data.experiencia)];;
  objetivos.innerHTML = `
    ${JSON.parse(data.objetivos).map((objetivo) => {
      return `<li>${objetivosParser[parseInt(objetivo)]}</li>`;
    }).join("")}
  `;
  lesion.textContent = lesionParser[parseInt(data.lesion)];
  descanso.textContent = descansoParser[parseInt(data.descanso)];

  

  $(".accionar_modal").attr("id", data.id_alumno);
  $(".asistencia").attr("id", data.id_alumno);
}

$(function(){
    $.ajax({
        type: "post",
        data: {
          accion: "graficas"
        },
        url: "models/modelo-datos.php",
        dataType: "json",
        success: function (data) {
            inicializarGraficasGenerales(data);
        },
      });
    
})

function inicializarGraficasGenerales(data){
 
  let {mensual,semanal} = data;
  let ctx = [];
  /* Inicializamos las graficas */
  ctx.push(document.getElementById("GraficaMensualGeneral").getContext("2d"));
  ctx.push(document.getElementById("GraficaSemanalGeneral").getContext("2d"));

    const GraficaMensualGeneral = new Chart(ctx[0], {
        type: 'bar',
        data: {
            labels: mensual.labels,
            datasets: [{
                label: '# de Asistencias',
                data: mensual.values,
                backgroundColor: [
                    "#007bff"
                  ],
                  borderColor: [
                    "#007bff"
                  ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: true
        }
    });

    const GraficaSemanalGeneral = new Chart(ctx[1], {
        type: 'bar',
        data: {
            labels: semanal.labels,
            datasets: [{
                label: '# de Asistencias',
                data: semanal.values,
                backgroundColor: [
                    "#007bff"
                  ],
                  borderColor: [
                    "#007bff"
                  ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: true
        }
    });
}

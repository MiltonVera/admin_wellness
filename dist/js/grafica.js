$(function(){
    inicializarGraficasGenerales();
})

function inicializarGraficasGenerales(){
    const ctc = document.getElementById('GraficaMensualGeneral').getContext('2d');
    const GraficaMensualGeneral = new Chart(ctc, {
        type: 'line',
        data: {
            labels: ['Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre'],
            datasets: [{
                label: '# de Asistencias',
                data: [12, 19, 3, 5, 2, 3],
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

    const cts = document.getElementById('GraficaSemanalGeneral').getContext('2d');
    const GraficaSemanalGeneral = new Chart(cts, {
        type: 'line',
        data: {
            labels: ['07/11/22', '08/11/22', '09/11/22', '10/11/22', '11/11/22', '12/11/22', '13/11/22'],
            datasets: [{
                label: '# de Asistencias',
                data: [12, 19, 3, 5, 2, 3],
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

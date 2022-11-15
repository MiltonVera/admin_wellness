$(function () {

    $(".modal_rutina").on("click", e => modal_app(e, true))

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['07/11/22', '08/11/22', '09/11/22', '10/11/22', '11/11/22', '12/11/22', '13/11/22'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
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



    const cty = document.getElementById('miChart').getContext('2d');
    const miChart = new Chart(cty, {
        type: 'line',
        data: {
            labels: ['17/10/22 - 23/10/22', '24/10/22 - 30/10/22', '31/10/22 - 06/11/22', '07/11/22 - 13/11/22'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    ticks: {
                        maxRotation: 90,
                        minRotation: 90
                    }
                },
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: true
        }
    });

    const ctz = document.getElementById('monChart').getContext('2d');
    const monChart = new Chart(ctz, {
        type: 'bar',
        data: {
            labels: ['Sentadilla', 'Press de Banca', 'Peso Muerto', 'Press Militar'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
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

    const cta = document.getElementById('mChart').getContext('2d');
    const mChart = new Chart(cta, {
        type: 'line',
        data: {
            labels: ['07/11/22', '08/11/22', '09/11/22', '10/11/22', '11/11/22', '12/11/22', '13/11/22'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
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

    const ctc = document.getElementById('maChart').getContext('2d');
    const maChart = new Chart(ctc, {
        type: 'line',
        data: {
            labels: ['Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
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

    const cts = document.getElementById('meChart').getContext('2d');
    const meChart = new Chart(cts, {
        type: 'line',
        data: {
            labels: ['07/11/22', '08/11/22', '09/11/22', '10/11/22', '11/11/22', '12/11/22', '13/11/22'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
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

});

function modal_app(e) {
    console.log("Corriendo app")
    let id = $(e.currentTarget).attr('data-id');
    let padre = $(".table");
    let modal = document.createElement("div");
    //Creamos la ventana modal
    modal.classList.add("modal");
    modal.innerHTML = `
    <div class="cuerpo">
        <div class="row">
            <button class="col-6 btn btn-danger cerrar">CERRAR</button>
        </div>
        <h3> Ejercicios de la Rutina </h3>
        <div class="row centrar">

        </div>
    </div>
    `;
    let tarjetas = $(modal).find(".centrar")[0];//Seleccinamos el row donde van los ejercicios
    let cerrar = $(modal).find(".cerrar");//Seleccionamos el boton de cerrar
    let tarjetas_array = []
    cerrar.on("click", e => $(e.target).parent().parent().parent().remove())

   

    $.ajax({
        type: 'POST',
        url: 'models/modelo-entrenamiento.php',
        data: {
            "registro": "buscar",
            "id": id
        },
        dataType: 'json',
        success: function (data) {
            let ejercicios = data.ejercicios;
            let i = 0;

            ejercicios.forEach(function (ejercicio) {

                tarjetas_array.push(document.createElement("div"));
                tarjetas_array[i].classList.add("col-md-3");
                tarjetas_array[i].classList.add("m-3");
                tarjetas_array[i].classList.add("tarjeta");
                //Creamos una tarjeta de prueba
                tarjetas_array[i].innerHTML = `
            
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="ejercicio">Ejercicio</label>
                        <input type="text" class="form-control" id="ejercicio" value="${ejercicio.nombre}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="serie">Series</label>
                        <input type="text" class="form-control" id="serie" value="${ejercicio.serie}" disabled>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="repeticion">Repeticiones</label>
                        <input type="text" class="form-control" id="repeticion" value="${ejercicio.repeticion}" disabled>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="repeticion">Descanso</label>
                        <input type="text" class="form-control" id="descanso" value="${ejercicio.descanso}" disabled>
                    </div>
                </div>
                `
                i++;
                //Juntamos todo
                tarjetas_array.forEach(tarjeta => tarjetas.appendChild(tarjeta))

                padre.prepend(modal);

            });



        }
    });

    
}
    



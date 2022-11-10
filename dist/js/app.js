$(function () {

    $(".modal_rutina").on("click", e => modal_app(e, true))

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
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
            }
        }
    });



    const cty = document.getElementById('miChart').getContext('2d');
    const miChart = new Chart(cty, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
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
            }
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
    



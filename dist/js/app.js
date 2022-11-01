$(function () {

    $(".modal_rutina").on("click", e => modal_app(e, true))

});

function modal_app(e) {
    console.log("Corriendo app")
    let id = $(e.currentTarget).attr('data-id');
    console.log(e.currentTarget);
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
    



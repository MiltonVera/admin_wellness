$(function () {
    /*Funcion que añade un nuevo ejercicio*/
    let boton = document.querySelector("#agregar");
    let eliminar = document.querySelectorAll("#eliminar");

    //Event Listener de darle click al boton de nuevo ejercicio
    boton.addEventListener("click", function (e) {
        e.preventDefault();
        let rutinas = document.querySelector("#rutinas");
        let rutina = document.createElement("div");
        rutina.classList.add("tarjeta");
        rutina.classList.add("col-md-3");
        rutina.classList.add("m-3");
        //Boton de eliminar
        let eliminar = document.createElement("button");
        eliminar.classList.add("btn");
        eliminar.classList.add("btn-danger");
        eliminar.classList.add("col-9");
        eliminar.innerHTML = `Eliminar`;
        //Boton de ver
        let verBoton = document.createElement("button");
        verBoton.classList.add("btn");
        verBoton.classList.add("btn-primary");
        verBoton.classList.add("col-2");
        verBoton.classList.add("ver-entrenamiento");
        verBoton.innerHTML = `
        <i class="fa-solid fa-eye-low-vision"></i>
        `


        rutina.innerHTML = `

        <div class="row">
            <div class="form-group col-12">
                <label>Rutina</label>
                <select class="select2" style="width: 100%;" name="rutina[]">
                    <option disabled selected="selected" >---Seleccionar---</option>
                </select>
            </div>

        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="nivel">Nivel</label>
                <input type="text" id="nivel" class="form-control" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="subnivel">Subnivel</label>
                <input type="number" id="sub_nivel" class="form-control" readonly >
            </div>
        </div>
                
    `;

        let buttonRow = document.createElement("div");
        buttonRow.classList.add("row");

        buttonRow.appendChild(eliminar);
        buttonRow.appendChild(verBoton);


        rutina.appendChild(buttonRow);
        //Cada que creamos un elemento le añadimos su event listener
        eliminar.addEventListener("click", function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
        //Le añadimos su event listener al boton de ver

        verBoton.addEventListener("click", e => {
            console.log(e);
            e.preventDefault();
            modal(e);
        });

        //Buscamos el select
        let select = $(rutina).find(".select2");

        //Le añadimos un event listener cuando cambie
        select.on("change", selectChange);

        //Agregar los select de rutinas
        $.ajax({
            type: 'POST',
            url: 'models/modelo-entrenamiento.php',
            data: {
                "registro": "buscar_todos",
            },
            dataType: 'json',
            success: function (data) {
                let { id, nombre } = data;
                let elemento;
                for (let i = 0; i < id.length; i++) {
                    elemento = document.createElement("option");
                    $(elemento).val(id[i]);
                    $(elemento)[0].text = nombre[i];
                    select[0].appendChild(elemento);
                }


            }
        })

        //Añadimos el rutina a los rutinas
        $(this).before(rutina);

        //Actualizamos el select para que funcione correctamente
        $('.select2').select2();
        $('.select2').select2("NULL", "---Seleccionar---");

    });

    eliminar.forEach(e => e.addEventListener("click",function (e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    }))


    //Le ponemos el change event listener al select
    let select = $(".select2");
    select.on("change", selectChange);
    //select.select2("NULL", "---Seleccionar---");

    //Colocamos el event listener al boton de ver
    //Funcion que al dar click llama al modal
    let botonesVer = document.querySelectorAll(".ver-entrenamiento");
    botonesVer.forEach(boton => boton.addEventListener("click",e => {e.preventDefault();modal(e);}))

});

function selectChange() {


    let padre = $(this).parent().parent().parent();
    let id = $(this).val();
    let nivel = padre.find("#nivel");
    let sub_nivel = padre.find("#sub_nivel");


    //Llamado ajax
    $.ajax({
        type: 'POST',
        url: 'models/modelo-entrenamiento.php',
        data: {
            "registro": "buscar",
            "id": id
        },
        dataType: 'json',
        success: function (data) {
            nivel.val(data.nivel);
            sub_nivel.val(data.subnivel);

        }
    });

}

function modal(e) {

    let id = $(e.target).parent().parent().parent().find(".select2").val();
    console.log(id);
    if (id != null) {
        let padre = $("#guardar-registro");
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
            async: false,
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
                });



            }
        });

        //Juntamos todo
        tarjetas_array.forEach(tarjeta => tarjetas.appendChild(tarjeta))

        padre.prepend(modal);
    }
    else{
        Swal.fire({
            icon: 'error',
            title: 'Selecciona una Rutina',
            text: 'Selecciona una rutina antes de poder ver sus ejercicios',
            footer: ''
        });
    }
    


}

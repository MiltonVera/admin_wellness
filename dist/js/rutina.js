$(function () {
    /*Funcion que añade un nuevo ejercicio*/
    let boton = document.querySelector("#agregar");
    let eliminar = document.querySelector("#eliminar");

    //Event Listener de darle click al boton de nuevo ejercicio
    boton.addEventListener("click", function (e) {
        e.preventDefault();
        let ejercicios = document.querySelector("#ejercicios");
        let ejercicio = document.createElement("div");
        ejercicio.classList.add("tarjeta");
        ejercicio.classList.add("col-md-3");
        ejercicio.classList.add("m-3");
        eliminar = document.createElement("button");
        eliminar.classList.add("btn");
        eliminar.classList.add("btn-danger");
        eliminar.classList.add("col-12");
        eliminar.innerHTML = `Eliminar`;
        ejercicio.innerHTML = `
    
                    <div class="row">
                        <div class="form-group col-8">
                            <label>Ejercicio</label>
                            <select class="select2" style="width: 100%;" name="ejercicio">
                                <option disabled selected="selected" >---Seleccionar---</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <img src="image/prueba.jpg" class="imagen-ejercicio" alt="Ejercicio">
                        </div>

                        <input type="hidden" id="id" name="id[]">
                        <input type="hidden" id="nombre_ejercicio" name="nombre_ejercicio[]">
                        <input type="hidden" id="zona_cuerpo" name="zona_cuerpo[]">
                        <input type="hidden" id="musculo" name="musculo[]">
                        <input type="hidden" id="nivel" name="nivel[]">
                        <input type="hidden" id="url_gif" name="url_gif[]">

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="serie">Series</label>
                            <input type="number" class="form-control" name="serie[]">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="repeticion">Repeticiones</label>
                            <input type="number" class="form-control" name="repeticion[]">
                        </div>

                    </div>

    `;
        ejercicio.appendChild(eliminar);
        //Cada que creamos un elemento le añadimos su event listener
        eliminar.addEventListener("click", function(e){ 
            e.preventDefault();
            $(this).parent().remove();
        });
        //Buscamos el select
        let select = $(ejercicio).find(".select2");

        //Le añadimos un event listener cuando cambie
        select.on("change",selectChange);
        


        //Agregar los select de ejercicios
        $.ajax({
            type: 'POST',
            url: 'models/modelo-rutina.php',
            data : {
                "registro": "buscar_todos",
            },
            dataType :'json',
            success: function(data) { 
                let {id,nombre,zona,musculo,nivel,url_gif} = data;
                let elemento;
                for(let i = 0;i<id.length;i++){
                    elemento = document.createElement("option");
                    $(elemento).val(id[i]);
                    $(elemento)[0].text = nombre[i];
                    select[0].appendChild(elemento);
                }
                
                                   
            }
        }) 
        
        //Añadimos el ejercicio a los ejercicios
        ejercicios.prepend(ejercicio);


        //Actualizamos el select para que funcione correctamente
        $('.select2').select2();
        $('.select2').select2("NULL", "---Seleccionar---");

    });

    eliminar.addEventListener("click", function(e){ 
        e.preventDefault();
        $(this).parent().remove();
    });

    //Le ponemos el change event listener al select
    let select = $(".select2");
    select.on("change",selectChange);
    select.select2("NULL", "---Seleccionar---");
    
    
});

function selectChange(){
    //TODO Ejecutar petición ajax al servidor e introducir los datos donde corresponden
    let padre = $(this).parent().parent();
    let id_elemento = padre.find("#id");
    let nombre = padre.find("#nombre_ejercicio");
    let zona = padre.find("#zona_cuerpo");
    let musculo = padre.find("#musculo");
    let nivel = padre.find("#nivel");
    let url_gif = padre.find("#url_gif");
    let imagen = padre.find(".imagen-ejercicio");

    let id = $(this).val();

    //Test de ejecucion ajax en archivo JSON local
    $.ajax({
        type: 'POST',
        url: 'models/modelo-rutina.php',
        data : {
            "registro": "buscar",
            "id" : id
        },
        dataType :'json',
        success: function(data) {  
            console.log(data);
            id_elemento.val(id);
            nombre.val(data.nombre)
            zona.val(data.zona);
            musculo.val(data.musculo);
            nivel.val(data.nivel);
            url_gif.val(data.url_gif);
            imagen.attr("src",data.url_gif);

        }
    }) 
}
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
                                <option value="Press">Press de Banca</option>
                                <option value="Fondos">Fondos</option>
                                <option value="Lagartijas">Lagartijas</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <img src="image/prueba.jpg" class="imagen-ejercicio" alt="Ejercicio">
                        </div>

                        <input type="hidden" id="id" name="id[]" value="2">
                        <input type="hidden" id="zona_cuerpo" name="zona_cuerpo[]" value="Superior">
                        <input type="hidden" id="musculo" name="musculo[]" value="Pecho">
                        <input type="hidden" id="nivel" name="nivel[]" value="Basico">
                        <input type="hidden" id="url_img" name="url_img[]" value="imagen/imagen1.jpg">
                        <input type="hidden" id="url_gif" name="url_gif[]" value="imagen/imagen1.gif">

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="serie">Series</label>
                            <input type="number" class="form-control" id="serie">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="repeticion">Repeticiones</label>
                            <input type="number" class="form-control" id="repeticion">
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
        select.on("change",function(){
            //TODO Ejecutar petición ajax al servidor e introducir los datos donde corresponden
            let padre = $(this).parent().parent();
            let id = padre.find("#id");
            let zona = padre.find("#zona_cuerpo");
            let musculo = padre.find("#musculo");
            let nivel = padre.find("#nivel");
            let url_img = padre.find("#url_img");
            let url_gif = padre.find("#url_gif");
            let imagen = padre.find(".imagen-ejercicio");
            
            //Test de ejecucion ajax en archivo JSON local
            $.ajax({
                type: 'GET',
                url: 'test.json',
                dataType :'json',
                success: function(data) {  
                    id.val(data.id);
                    zona.val(data.zonaCuerpo);
                    musculo.val(data.musculo);
                    nivel.val(data.nivel);
                    url_img.val(data.url_img);
                    url_gif.val(data.url_gif);
                    imagen.attr("src",data.url_img);
                                       
                }
            }) 



        });
        


        //Añadimos el ejercicio a los ejercicios
        ejercicios.prepend(ejercicio);


        //Actualizamos el select para que funcione correctamente
        $('.select2').select2();

    });

    eliminar.addEventListener("click", function(e){ 
        e.preventDefault();
        $(this).parent().remove();
    });

    //Le ponemos el change event listener al select
    let select = $(".select2");
    select.on("change",function(){
        //TODO Ejecutar petición ajax al servidor e introducir los datos donde corresponden
        let padre = $(this).parent().parent();
        let id = padre.find("#id");
        let zona = padre.find("#zona_cuerpo");
        let musculo = padre.find("#musculo");
        let nivel = padre.find("#nivel");
        let url_img = padre.find("#url_img");
        let url_gif = padre.find("#url_gif");
        let imagen = padre.find(".imagen-ejercicio");
        
        //Test de ejecucion ajax en archivo JSON local
        $.ajax({
            type: 'GET',
            url: 'test.json',
            dataType :'json',
            success: function(data) {  
                id.val(data.id);
                zona.val(data.zonaCuerpo);
                musculo.val(data.musculo);
                nivel.val(data.nivel);
                url_img.val(data.url_img);
                url_gif.val(data.url_gif);
                imagen.attr("src",data.url_img);
                                   
            }
        }) 
    });
    
    
});
$(function () {
    /*Funcion que añade un nuevo ejercicio*/
    let boton = document.querySelector("#agregar");
    let eliminar = document.querySelector("#eliminar");

    //Event Listener de darle click al boton de nuevo ejercicio
    boton.addEventListener("click", function (e) {
        e.preventDefault();
        let rutinas = document.querySelector("#rutinas");
        let rutina = document.createElement("div");
        rutina.classList.add("tarjeta");
        rutina.classList.add("col-md-3");
        rutina.classList.add("m-3");
        eliminar = document.createElement("button");
        eliminar.classList.add("btn");
        eliminar.classList.add("btn-danger");
        eliminar.classList.add("col-12");
        eliminar.innerHTML = `Eliminar`;
        rutina.innerHTML = `

                    <div class="row">
                        <div class="form-group col-12">
                            <label>Rutina</label>
                            <select class="select2" style="width: 100%;" name="rutina">
                                <option value="Fantastica">Rutina Fantástica</option>
                                <option value="Chevere">Rutina Chevere</option>
                                <option value="Otra">Hola, soy otra rutina</option>
                            </select>
                        </div>

                        <input type="hidden" id="id" name="id[]" value="2">
                        <input type="hidden" id="rutina" name="rutinas[]" value="Rutina Fantastica">
                        <input type="hidden" id="nivel" name="nivel[]" value="Basico">
                        <input type="hidden" id="sub_nivel" name="sub_nivel[]" value="1">

                    </div>
                

    `;
    rutina.appendChild(eliminar);
        //Cada que creamos un elemento le añadimos su event listener
        eliminar.addEventListener("click", function(e){ 
            e.preventDefault();
            $(this).parent().remove();
        });
        //Buscamos el select
        let select = $(rutina).find(".select2");

        //Le añadimos un event listener cuando cambie
        select.on("change",function(){
            //TODO Ejecutar petición ajax al servidor e introducir los datos donde corresponden
            let padre = $(this).parent().parent();
            let id = padre.find("#id");
            let rutina = padre.find("#rutina");
            let nivel = padre.find("#nivel");
            let sub_nivel = padre.find("#sub_nivel");
            
            //Test de ejecucion ajax en archivo JSON local
            $.ajax({
                type: 'GET',
                url: 'test.json',
                dataType :'json',
                success: function(data) {  
                    id.val(data.id);
                    rutina.val(data.rutina);
                    nivel.val(data.nivel);
                    sub_nivel.val(data.sub_nivel);
                }
            }) 
        });

        //Añadimos el rutina a los rutinas
        rutinas.prepend(rutina);

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
            let rutina = padre.find("#rutina");
            let nivel = padre.find("#nivel");
            let sub_nivel = padre.find("#sub_nivel");
            
            //Test de ejecucion ajax en archivo JSON local
            $.ajax({
                type: 'GET',
                url: 'test.json',
                dataType :'json',
                success: function(data) {  
                    id.val(data.id);
                    rutina.val(data.rutina);
                    nivel.val(data.nivel);
                    sub_nivel.val(data.sub_nivel);
                }
            }) 
    });
    
    
});
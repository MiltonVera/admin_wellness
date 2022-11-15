var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

function inWords (num) {
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + a[n[5][1]]) : '';
    return str;
}

$(function () {
  let accionar = document.querySelectorAll(".accionar_modal");
  accionar.forEach((boton) =>
    boton.addEventListener("click", (e) => {
      e.preventDefault();
      //Le mandamos el id del alumno al que se le asignara la rutina
      modal_index(e.target.id);
    })
  );
});

const modal_index = (alumno) => {
  $.fn.modal.Constructor.prototype._enforceFocus = function() {};
  //Creamos el contenedor de la tabla
  let modal = document.querySelector(".modal_index");
  modal.classList.add("modal");

  let cuerpo = document.createElement("div");
  cuerpo.classList.add("card-body");
  cuerpo.classList.add("cuerpo");

  let eliminar = document.createElement("div")
  eliminar.classList.add("row")
  eliminar.innerHTML = `
  <button class="col-6 btn btn-danger cerrar">CERRAR</button>
  `

  
  

  modal.appendChild(cuerpo);
  //Rellenamos el HTML interno de la tabla sobre el cual despues vamos a sobre escribir
  cuerpo.innerHTML = `
  <div class="row">
    <button class="col-6 btn btn-danger cerrar">CERRAR</button>
  </div>
  <table id="tabla" class="table table-bordered table-striped">
      <thead>
          <tr>
              <th>Nombre</th>
              <th>Clasificación</th>
              <th>Nivel</th>
              <th>Subnivel</th>
              <th>Acciones</th>
          </tr>
      </thead>
      <tbody class="datos">
              
      </tbody>
      <tfoot>
          <tr>
              <th>Nombre</th>
              <th>Clasificación</th>
              <th>Nivel</th>
              <th>Subnivel</th>
              <th>Acciones</th>
          </tr>
      </tfoot>
  </table>`;

  imprimirTabla(alumno);
  $(".cerrar").on("click", e => {
    $(e.target).parent().parent().remove()
    modal.classList.remove("modal")

})
};

function imprimirTabla(alumno) {
  let datos = document.querySelector(".datos");
  let rutinas, entrenamiento_id;
  $.ajax({
    type: "POST",
    url: "models/modelo-entrenamiento.php",
    data: {
      registro: "buscar_entrenamientos",
    },
    dataType: "json",
    async: false,
    success: function (data) {
      let { id, clasificacion, nombre, nivel, subnivel } = data;
      rutinas = data.rutinas;
      rutinas.forEach((rutina, index) => {
        rutina.id_entrenamiento = id[index];
      });
      let dataConverted = [];

      for (let i = 0; i < id.length; i++) {
        dataConverted.push({
          id: id[i],
          clasificacion: clasificacion[i],
          nombre: nombre[i],
          nivel: nivel[i],
          subnivel: subnivel[i],
          rutinas: rutinas[i],
        });
      }

      let entrenamientos = Array(id.length);
      dataConverted.forEach((entrenamiento, index) => {
        entrenamientos[index] = document.createElement("tr");
        entrenamientos[index].innerHTML = `
                <tr>
                    <td>${entrenamiento.nombre}</td>
                    <td>${entrenamiento.clasificacion}</td>
                    <td>${entrenamiento.nivel}</td>
                    <td>${entrenamiento.subnivel}</td>
                    <td>
                        <a id=${entrenamiento.id} class="btn mx-2 bg-blue btn-flat margin seleccionar_entrenamiento">
                            <p style="text-transform:uppercase; font-size: 16px; font-weight:bold;">Seleccionar Entrenamiento</p>
                        </a>
                    </td>

                </tr>
                `;
        datos.appendChild(entrenamientos[index]);
      });
    },
  });

  $('#tabla').DataTable( {
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    'language': {
          paginate: {
              next: 'Siguiente',
              previous: 'Anterior',
              last: 'Ultimo',
              first: 'Primero'
          },
          info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
          emptyTable: 'No hay registros',
          infoEmpty: '0 Registros',
          search: 'Buscar: '
      }
  } );


  let seleccionar_entrenamientos = document.querySelectorAll(
    ".seleccionar_entrenamiento"
  );
  seleccionar_entrenamientos.forEach((boton) => {
    boton.addEventListener("click", (e) => ListarRutinas(e, alumno, rutinas));
  });

  
}

function ListarRutinas(e, alumno, rutinas) {
  
  $('#tabla').DataTable().destroy()
  $("table").hide()
  

  let id_entrenamiento = e.currentTarget.id;
  let rutinas_filtradas = rutinas.filter((rutina) => {
    return rutina.id_entrenamiento == id_entrenamiento;
  });

  let rutinas_dom = Array(rutinas_filtradas.length);

  let contenedor = document.createElement("form");
  contenedor.classList.add("row");
  contenedor.classList.add("centrar");
  contenedor.setAttribute("method","POST")
  contenedor.setAttribute("action","models/modelo-alumno.php")
  document.querySelector(".cuerpo").appendChild(contenedor)

  rutinas_filtradas.forEach((rutina, index) => {
    rutina.forEach((rut) => {
      rutinas_dom[index] = document.createElement("div")
      rutinas_dom[index].classList.add("col-md-3")
      rutinas_dom[index].classList.add("m-3")
      rutinas_dom[index].classList.add("tarjeta")
      rutinas_dom[index].innerHTML = `
        <div class="row">
            <div class="form-group col-md-12">
                <label for="ejercicio">Rutina</label>
                <input type="text" class="form-control" id="ejercicio" value="${rut.nombre}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="clasificacion">Clasificacion</label>
                <input type="text" class="form-control" id="clasificacion" value="${rut.clasificacion}" readonly>
            </div>
            <div class="form-group col-md-12">
             <label for="dia">Dia</label>
              <select class="programacion ${inWords(rut.id_rutina)}  col-md-12" name="programacion[${rut.id_rutina}][]" multiple>
                <option value="1">Lunes</option>
                <option value="2">Martes</option>
                <option value="3">Miercoles</option>
                <option value="4">Jueves</option>
                <option value="5">Viernes</option>
                <option value="6">Sabado</option>
                <option value="7">Domingo</option>
              </select>

            </div>
        </div>
        <input type="hidden" name="id[]" value="${rut.id_rutina}">

        `;
        contenedor.appendChild(rutinas_dom[index])

        console.log($(`.${inWords(rut.id_rutina)}`).select2({
          dropdownParent: $('.cuerpo')
        }))

    });
  });

 

  //Creamos el boton de submit
  let submit = document.createElement("input")
  submit.setAttribute("type","submit")
  submit.setAttribute("value","Asignar Entrenamiento")
  submit.classList.add("col-6")
  submit.classList.add("btn")
  submit.classList.add("bg-blue")

  let alumno_id = document.createElement("input")
  alumno_id.setAttribute("type","hidden")
  alumno_id.setAttribute("value",alumno)
  alumno_id.setAttribute("name","alumno")

  let entrenamiento_id = document.createElement("input")
  entrenamiento_id.setAttribute("type","hidden")
  entrenamiento_id.setAttribute("value",id_entrenamiento)
  entrenamiento_id.setAttribute("name","entrenamiento")



  $("form").append(submit);
  $("form").append(alumno_id);
  $("form").append(entrenamiento_id);
  
  
}

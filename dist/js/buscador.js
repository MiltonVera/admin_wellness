$(function () {
  let buscador = document.querySelector("#buscador");
  buscador.addEventListener("submit", function (e) {
    e.preventDefault();
    let busqueda = $(this).serializeArray()[0].value;

    // Revisa si se esta buscando por matricula
    if(busqueda.substring(0,2).toLowerCase() == "a0"){
      $.ajax({
        type: "post",
        data: {
          "accion" : "buscar_matricula",
          "matricula" : busqueda
        },
        url: "models/modelo-alumno.php",
        dataType: "json",
        success: function (data) {
          //Si existe una respuesta es porque hubo un error

          if(data.respuesta){
              Swal.fire({
                  icon: 'error',
                  title: 'No se encontro el alumno',
                  text: 'Revisa la matricula o intenta la busqueda por nombre',
                  footer: ''
              });
              return
          }
          $(".alumno").text(data.nombre)
          $(".accionar_modal").attr("id",data.id_alumno)
          $(".asistencia").attr("id",data.id_alumno)
  
        },
      });
      return;
    }
    $.ajax({
      type: "post",
      data: {
        "accion" : "buscar",
        "nombre" : busqueda
      },
      url: "models/modelo-alumno.php",
      dataType: "json",
      success: function (data) {
        if(data.respuesta){
            Swal.fire({
                icon: 'error',
                title: 'No se encontro el alumno',
                text: 'Revisa el nombre o intenta la busqueda por matricula',
                footer: ''
            });
            return
        }
        $(".alumno").text(data.nombre)
        $(".accionar_modal").attr("id",data.id_alumno)
        $(".asistencia").attr("id",data.id_alumno)

      },
    });
  });


});





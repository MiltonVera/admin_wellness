$(function () {

    let asistencia = document.querySelector(".asistencia");
    asistencia.addEventListener("click",e=>{
        e.preventDefault();
        if(!e.currentTarget.id){
            Swal.fire({
                icon: 'error',
                title: 'No existe un alumno',
                text: 'Debes buscar un alumno antes de marcar su asistencia',
                footer: ''
            })
            return
        }
        $.ajax({
            type: "post",
            data: {
              "accion" : "asistencia",
              "id":e.currentTarget.id
            },
            url: "models/modelo-alumno.php",
            dataType: "json",
            success: function (data) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'La asistencia del alumno ha sido marcada',
                    showConfirmButton: false,
                    timer: 1000
                  })
      
            },
          });
        
    })
});
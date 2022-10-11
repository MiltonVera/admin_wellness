$(function() {

    $('#guardar-registro').on('submit', function(e) {
        e.preventDefault();
        let datos = $(this).serializeArray();
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                let resultado = data;
                console.log(resultado);
                if (resultado.respuesta == "exito") {
                    Swal.fire(
                        'Correcto',
                        'Se guardo correctamente',
                        'success'
                    )
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error',
                        text: 'Prueba un nombre de ususario diferente',
                        footer: ''
                    })
                }

            }
        })
    });
    $('#guardar-registro-archivo').on('submit', function(e) {
        e.preventDefault();
        let datos = new FormData(this);
        
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function(data) {
                let resultado = data;
                console.log(resultado);
                if (resultado.respuesta == "exito") {
                    Swal.fire(
                        'Correcto',
                        'Se guardo correctamente',
                        'success'
                    );
                    $("#guardar-registro-archivo").trigger("reset");
                    setTimeout(() => {
                        window.location.replace(resultado.regreso);
                    }, 2000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error',
                        text: 'Prueba un nombre de ususario diferente',
                        footer: ''
                    });
                }

            }
        })
    });



});
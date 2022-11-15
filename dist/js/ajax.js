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
                Swal.fire(
                    'Correcto',
                    'Se guardo correctamente',
                    'success'
                )
                
                setTimeout(() => {
                    //window.location.replace(data.regreso);
                }, 2000);
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
                    console.log(resultado.regreso)
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

    $('.borrar').on('click', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let tipo = $(this).attr('data-tipo');
        console.log(id);
        console.log(tipo);

        Swal.fire({
            title: '¿Estas seguro?',
            text: "Esta accion no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Borrar'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Borrado!',
                    'Ha sido borrado',
                    'success'
                )
                $.ajax({
                    type: 'post',
                    data: {
                        'id': id,
                        'registro': 'eliminar'

                    },
                    url: 'models/modelo-' + tipo + '.php',
                    success: function(data) {                       
                        jQuery('[data-id="' + id + '"]').parents('tr').remove();
                        Swal.fire(
                            'Correcto',
                            'Se elimino correctamente',
                            'success'
                        )
                    }
                })
            }
        })
    });



});
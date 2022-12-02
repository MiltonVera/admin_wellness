</div>
</div>

<?php $pagina = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  ?>


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>


<?php 
if(substr($pagina,0,5) == "lista" || $pagina == "index.php" ){?>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>



<script>
  $(function () {

    if ( $.fn.dataTable.isDataTable( '#tabla' ) ) {
    table = $('#tabla').DataTable();
    }
    else {
        table = $('#tabla').DataTable( {
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
    }
    
  });
</script>

<?php } ?>


<?php 
if(substr($pagina,0,5) == "crear" || substr($pagina,0,6) == "editar" ||  $pagina == "index.php"){?>

<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>


<script>


$(function () {
  bsCustomFileInput.init();
  $('.select2').select2();
});

</script>
<?php } ?>


<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>


<?php 
if($pagina == "crear-rutina.php" || $pagina == "editar-rutina.php" ){?>
<script src="dist/js/rutina.js"></script>
<?php } ?>

<?php 
if($pagina == "crear-entrenamiento.php"  || $pagina == "editar-entrenamiento.php"){?>
<script src="dist/js/entrenamiento.js"></script>
<?php } ?>


<script src="dist/js/grafica.js"></script>
<script src="dist/js/app.js"></script>
<!--  -->
<script src="dist/js/modal.js"></script>
<script src="dist/js/buscador.js"></script>
<script src="dist/js/asistencia.js"></script>
<script src="dist/js/ajax.js"></script>




</body>
</html>

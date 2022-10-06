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
if($pagina == "lista-admin.php"){?>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
  $(function () {
    
    let tabla = $('#admins').DataTable({
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
    });
  });
</script>

<?php } ?>


<?php 
if($pagina == "crear-ejercicio.php" || $pagina == "crear-rutina.php"  ){?>

<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

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
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>

<?php 
if($pagina == "crear-rutina.php" ){?>
<script src="dist/js/rutina.js"></script>
<?php } ?>

<?php 
if($pagina == "crear-entrenamiento.php" ){?>
<script src="dist/js/entrenamiento.js"></script>
<?php } ?>

</body>
</html>

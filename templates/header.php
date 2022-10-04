<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Wellness Center Admin</title>
  <?php $pagina = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  ?>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <?php if($pagina == "crear-ejercicio.php"){?>
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <?php } ?>



  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="stylesheet" href="dist/css/styles.css">
</head>


<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

<div class="wrapper">

  <!-- Loader -->
  <div class="preloader flex-column justify-content-center align-items-center ">
    <img class="animation__wobble" src="dist/img/logo.png" alt="Logo Tec" height="60" width="60">
  </div>

<nav class="main-header navbar navbar-expand navbar-light elevation-1">
    <!-- Menu Hamburguesa -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Contenedor de navegacion de la derecha -->
    <ul class="navbar-nav ml-auto">
      <!-- Elemento de la navegacion -->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>

  <div class="content-wrapper">
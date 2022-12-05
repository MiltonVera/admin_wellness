<?php 
function usuario_autenticado(){
    if(!revisar_usuario()){
        header('Location:login.php');
        exit();
    }
}
function revisar_usuario(){
    return isset($_SESSION['correo']);
}

$pagina = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
if($pagina != "editar-ejercicio.php"){
    session_start();
    usuario_autenticado();  
}


if(($pagina=="crear-admin.php" || $pagina=="editar-admin.php" ) && $_SESSION["admin"] == 0){
    header('Location: /');
}
?>
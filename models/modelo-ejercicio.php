<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once "../functions/connection.php";
include_once "../functions/ruta.php";
$nombre = $_POST["nombre"];
$nivel = $_POST["nivel"];
$zona = $_POST["zona"];
$musculo = $_POST["musculo"];

if($_POST["registro"] == "nuevo"){
   
    $nombreImagen = md5(uniqid(rand(),true));
    //-----Subimos el gif de ejecución
    if(!is_dir($directorio_gif)){
        mkdir($directorio_gif,0755,true);
    }
    //Mover el archivo
    if(move_uploaded_file($_FILES['ejecucion']['tmp_name'],$directorio_gif . $nombreImagen.".gif")){
        $imagen_ejecucion_url =substr($directorio_gif,3) .$nombreImagen.".gif";
        $imagen_ejecucion_resultado = "Se subio correctamente";
    }else{
        $respuesta = array(
            'respuesta' => error_get_last()
        );
    }

    //-----Ejecutamos la inserción de los datos a la base de datos
    try {
        $stmt = $conn->prepare('INSERT INTO ejercicio (nombre,zona_cuerpo,musculo,nivel,url_gif) VALUES (?,?,?,?,?) ');
        $stmt->bind_param("sssss", $nombre,$zona,$musculo,$nivel,$imagen_ejecucion_url);
        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_insertado,
                'resultado_imagen_ejecucion' => $imagen_ejecucion_resultado,
                'regreso' => "lista-ejercicio.php"
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));


}
if($_POST['registro'] == 'editar'){

    $id = $_POST["id"];

    if(!is_dir($directorio_gif)){
        mkdir($directorio_gif,0755,true);
    }
    //Eliminacion de foto anterior
    if($_FILES['ejecucion']['size'] > 0){//Si se subio un nuevo archivo
        //Buscar nombre de la imagen anterior en la base de datos
        try {
            $sql = "SELECT url_gif FROM ejercicio WHERE id_ejercicio=".$id;
            $imagen_bd = $conn->query($sql);
            $imagen_bd = $imagen_bd->fetch_assoc();
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo $error;
        }
        unlink("../".$imagen_bd['url_gif']);
    }
    
    //Subir archivo por defecto, descomentar si no funciona la solucion anterior 
    if(move_uploaded_file($_FILES['ejecucion']['tmp_name'],$directorio_gif . $nombre.".gif")){
        $imagen_url = substr($directorio_gif,3) .$nombre.".gif";
        $imagen_resultado = "Se subio correctamente";
    }else{
        $respuesta = array(
            'respuesta' => error_get_last()
        );
    }
    //Subir archivo por defecto, descomentar si no funciona la solucion anterior
    try {
        if($_FILES['ejecucion']['size'] > 0){
            $stmt = $conn->prepare("UPDATE ejercicio SET nombre = ?,zona_cuerpo= ?,musculo= ?,nivel= ?,url_gif= ? WHERE id_ejercicio=?");
            $stmt->bind_param("sssssi",$nombre,$zona,$musculo,$nivel,$imagen_url,$id);
        }else{
            $stmt = $conn->prepare("UPDATE ejercicio SET nombre= ?,zona_cuerpo= ?,musculo= ?,nivel= ? WHERE id_ejercicio=?");
            $stmt->bind_param("ssssi",$nombre,$zona,$musculo,$nivel,$id);
        }       
        $estado = $stmt->execute();       
        if($estado) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_actualizado' => $id,
                'regreso' => "lista-ejercicio.php"
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    
    die(json_encode($respuesta));
    
}


<?php

include_once "../functions/connection.php";
include_once "../functions/ruta.php";


if($_POST["registro"] == "nuevo"){
    //Leer la entrada POST
    $nombre = $_POST["nombre"];
    $nivel = $_POST["nivel"];
    $zona = $_POST["zona"];
    $musculo = $_POST["musculo"];

    //-----Subimos el gif de ejecución
    if(!is_dir($directorio_gif)){
        mkdir($directorio_gif,0755,true);
    }
    //Mover el archivo
    if(move_uploaded_file($_FILES['ejecucion']['tmp_name'],$directorio_gif . $_FILES['ejecucion']['name'])){
        $imagen_ejecucion_url =trim($directorio_gif,"../") ."/".$_FILES['ejecucion']['name'];
        $imagen_ejecucion_resultado = "Se subio correctamente";
    }else{
        $respuesta = array(
            'respuesta' => error_get_last()
        );
    }

    //-----Ejecutamos la inserción de los datos a la base de datos
    try {
        $stmt = $conn->prepare('INSERT INTO ejercicio (nombre,zona_cuerpo,musculo,nivel,url_gif) VALUES (?,?,?,?,?) ');
        $stmt->bind_param("ssssss", $nombre,$zona,$musculo,$nivel,$imagen_ejecucion_url);
        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_insertado,
                'resultado_imagen_portada' => $imagen_portada_resultado,
                'resultado_imagen_ejecucion' => $imagen_ejecucion_resultado,
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
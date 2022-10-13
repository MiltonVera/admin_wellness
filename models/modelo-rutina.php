<?php 

include_once "../functions/connection.php";

if($_POST["registro"] == "buscar"){
    $id  = (int)$_POST["id"];

    $stmt = $conn->prepare("SELECT * FROM ejercicio WHERE id_ejercicio=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();

    $respuesta = array(
        "id" => $id,
        "nombre" => $resultado["nombre"],
        "zona" => $resultado["zona_cuerpo"],
        "musculo" => $resultado["musculo"],
        "nivel" => $resultado["nivel"],
        "url_gif" => $resultado["url_gif"],
    );

    die(json_encode($respuesta));


}
if($_POST["registro"] == "buscar_todos"){
    
    $stmt = $conn->prepare("SELECT * FROM ejercicio");
    $stmt->execute();
    $resultado = $stmt->get_result();

    $respuesta = array(
        "id" => [],
        "nombre" => [],
        "zona" => [],
        "musculo" => [],
        "nivel" => [],
        "url_gif" => []
    );

    while($ejercicio = $resultado->fetch_assoc() ) { 
        $respuesta["id"][] = $ejercicio["id_ejercicio"];
        $respuesta["nombre"][] = $ejercicio["nombre"];
        $respuesta["zona"][] = $ejercicio["zona_cuerpo"];
        $respuesta["musculo"][] = $ejercicio["musculo"];
        $respuesta["nivel"][] = $ejercicio["nivel"];
        $respuesta["url_gif"][] = $ejercicio["url_gif"];

    }
    die(json_encode($respuesta));


}
if($_POST["registro"] == "crear"){
    $nombre  = $_POST["nombre"];
    $clasificacion  = $_POST["clasificacion"];
    $nivel_rutina  = $_POST["nivel_rutina"];
    $subnivel  = $_POST["subnivel"];

    $id = $_POST["id"];
    $nombres = $_POST["nombre_ejercicio"];
    $zona_cuerpo = $_POST["zona_cuerpo"];
    $musculo = $_POST["musculo"];
    $nivel = $_POST["nivel"];
    $url_gif = $_POST["url_gif"];
    $serie = $_POST["serie"];
    $repeticion = $_POST["repeticion"];
    
    $ejercicios_entrada = array();

    for($i = 0;$i<count($id);$i++){

        $ejercicios_entrada[] = array(
            "id" => $id[$i],
            "nombre" => $nombres[$i],
            "zona_cuerpo" => $zona_cuerpo[$i],
            "musculo" => $musculo[$i],
            "nivel" => $nivel[$i],
            "url_gif" => $url_gif[$i],
            "serie" => $serie[$i],
            "repeticion" => $repeticion[$i]
        
        );
    }


    $ejercicios_json = json_encode($ejercicios_entrada);
    
    try {
        $stmt = $conn->prepare('INSERT INTO rutina (nombre,clasificacion,nivel,sub_nivel,ejercicios) VALUES (?,?,?,?,?)');
        $stmt->bind_param("sssss", $nombre,$clasificacion,$nivel_rutina,$subnivel,$ejercicios_json);
        $stmt->execute();
        $respuesta= array(
            "respuesta" => "exito"
        );
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }

    die(json_encode($respuesta));

}



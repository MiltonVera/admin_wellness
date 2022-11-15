<?php
    include_once "../functions/connection.php";

    $id_entrenamiento = (int)$_POST["entrenamiento"];
    $programacion = $_POST["programacion"];
    $id_rutinas = $_POST["id"];
    $alumno = (int)$_POST["alumno"];

    $conn->autocommit(false);
    $stmt = $conn->prepare("SELECT * FROM entrenamiento WHERE id_entrenamiento=?");
    $stmt->bind_param("i",$id_entrenamiento);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $entrenamiento_alumno = array(
        "id" => [],
        "clasificacion" => [],
        "nombre" => [],
        "nivel" => [],
        "subnivel" => [],
        "rutinas" => [],
    );

    $row = $resultado->fetch_assoc();
    $entrenamiento_alumno["id"] = $row["id_entrenamiento"];
    $entrenamiento_alumno["clasificacion"] = $row["clasificacion"];
    $entrenamiento_alumno["nombre"] = $row["nombre"];
    $entrenamiento_alumno["nivel"] = $row["nivel"];
    $entrenamiento_alumno["subnivel"] = $row["sub_nivel"];
    $entrenamiento_alumno["rutinas"] = json_decode($row["rutinas"],true);

    
    foreach($id_rutinas as $key=>$rutina){
    
        $entrenamiento_alumno["rutinas"][$key]["programacion"] =$programacion[$rutina];
    }

    $entrenamiento_alumno = json_encode($entrenamiento_alumno);
    

    $stmt2 = $conn->prepare("UPDATE alumno set entrenamiento=? WHERE id_alumno=?");
    $stmt2->bind_param("si",$entrenamiento_alumno,$alumno);
    $stmt2->execute();  

    
    $conn->autocommit(true);
    $stmt->close();
    $conn->close();

    

?>
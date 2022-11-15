<?php 

include_once "../functions/connection.php";


//die(var_dump($_POST));
if($_POST["registro"] == "buscar"){
    $id  = (int)$_POST["id"];

    $stmt = $conn->prepare("SELECT * FROM rutina WHERE id_rutina=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();

    $respuesta = array(
        "id" => $id,
        "nombre" => $resultado["nombre"],
        "nivel" => $resultado["nivel"],
        "subnivel" => $resultado["sub_nivel"],
        "ejercicios" => json_decode($resultado["ejercicios"],true)
    );

    die(json_encode($respuesta));


}
if($_POST["registro"] == "buscar_todos"){
    
    $stmt = $conn->prepare("SELECT * FROM rutina");
    $stmt->execute();
    $resultado = $stmt->get_result();

    $respuesta = array(
        "id" => [],
        "clasificacion" => [],
        "nombre" => [],
        "nivel" => [],
        "subnivel" => [],
        "ejercicios" => [],
    );

    while($row = $resultado->fetch_assoc() ) { 
        $respuesta["id"][] = $row["id_rutina"];
        $respuesta["clasificacion"][] = $row["clasificacion"];
        $respuesta["nombre"][] = $row["nombre"];
        $respuesta["nivel"][] = $row["nivel"];
        $respuesta["subnivel"][] = $row["sub_nivel"];
        $respuesta["ejercicios"][] = json_decode($row["ejercicios"],true);

    }
    die(json_encode($respuesta));


}

if($_POST["registro"] == "buscar_entrenamientos"){
    
    $stmt = $conn->prepare("SELECT * FROM entrenamiento");
    $stmt->execute();
    $resultado = $stmt->get_result();

    $respuesta = array(
        "id" => [],
        "clasificacion" => [],
        "nombre" => [],
        "nivel" => [],
        "subnivel" => [],
        "rutinas" => [],
    );

    while($row = $resultado->fetch_assoc() ) { 
        $respuesta["id"][] = $row["id_entrenamiento"];
        $respuesta["clasificacion"][] = $row["clasificacion"];
        $respuesta["nombre"][] = $row["nombre"];
        $respuesta["nivel"][] = $row["nivel"];
        $respuesta["subnivel"][] = $row["sub_nivel"];
        $respuesta["rutinas"][] = json_decode($row["rutinas"],true);

    }
    die(json_encode($respuesta));


}

if($_POST["registro"] == "crear"){
    $nombre  = $_POST["nombre"];
    $clasificacion  = $_POST["clasificacion"];
    $nivel_entrenamiento  = $_POST["nivel_entrenamiento"];
    $subnivel_entrenamiento  = (int)$_POST["subnivel_entrenamiento"];


    $rutina =array_map('intval', $_POST["rutina"]);//Id de las rutinas
    $rutinas = array();


    try{
        $conn->autocommit(false);
        $stmts = $conn->prepare('SELECT * FROM rutina WHERE id_rutina IN (' . implode(',', array_map('intval', $rutina)) . ')');
        $stmts->execute();
        $resultado = $stmts->get_result();

        while($row = $resultado->fetch_assoc()){
            $rut = array(
                "id_rutina" => $row["id_rutina"],
                "nombre" => $row["nombre"],
                "clasificacion" => $row["clasificacion"],
                "nivel" => $row["nivel"],
                "sub_nivel" => $row["sub_nivel"],
                "ejercicios" => json_decode($row["ejercicios"],True)
            );
            $rutinas[] = $rut;
        }

        $rutinas = json_encode($rutinas);

        
        $stmt = $conn->prepare('INSERT INTO entrenamiento (nombre,clasificacion,nivel,sub_nivel,rutinas) VALUES (?,?,?,?,?)');
        $stmt->bind_param("sssis", $nombre,$clasificacion,$nivel_entrenamiento,$subnivel_entrenamiento,$rutinas);
        $stmt->execute();
        $respuesta= array(
            "respuesta" => "exito",
            'regreso' => "/lista-entrenamiento.php"
        );

        $conn->autocommit(true);
        $stmts->close();
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }

    die(json_encode($respuesta));

}

if($_POST["registro"] == "editar"){
    $id = (int)$_POST["id"];
    $nombre  = $_POST["nombre"];
    $clasificacion  = $_POST["clasificacion"];
    $nivel_entrenamiento  = $_POST["nivel_entrenamiento"];
    $subnivel_entrenamiento  = (int)$_POST["subnivel_entrenamiento"];


    $rutina =array_map('intval', $_POST["rutina"]);//Id de las rutinas
    $rutinas = array();


    try{
        $conn->autocommit(false);
        $stmts = $conn->prepare('SELECT * FROM rutina WHERE id_rutina IN (' . implode(',', array_map('intval', $rutina)) . ')');
        $stmts->execute();
        $resultado = $stmts->get_result();

        while($row = $resultado->fetch_assoc()){
            $rut = array(
                "id_rutina" => $row["id_rutina"],
                "nombre" => $row["nombre"],
                "clasificacion" => $row["clasificacion"],
                "nivel" => $row["nivel"],
                "sub_nivel" => $row["sub_nivel"],
                "ejercicios" => json_decode($row["ejercicios"],True)
            );
            $rutinas[] = $rut;
        }

        $rutinas = json_encode($rutinas);

        
        $stmt = $conn->prepare('UPDATE entrenamiento SET nombre = ?,clasificacion = ?,nivel = ?,sub_nivel = ?,rutinas = ? WHERE id_entrenamiento=?');
        $stmt->bind_param("sssisi", $nombre,$clasificacion,$nivel_entrenamiento,$subnivel_entrenamiento,$rutinas,$id);
        $stmt->execute();
        $respuesta= array(
            "respuesta" => "exito",
            'regreso' => "/lista-entrenamiento.php"
        );
        $conn->autocommit(true);
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage(),
            'regreso' => "/lista-entrenamiento.php"
        );
    }

    die(json_encode($respuesta));

}



if($_POST["registro"] == "eliminar"){

    $id = (int) $_POST["id"];

    try {
        $stmt = $conn->prepare('DELETE FROM entrenamiento WHERE id_entrenamiento=?');
        $stmt->bind_param("i", $id);
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
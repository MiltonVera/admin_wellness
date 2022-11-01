<?php 

$conn = new mysqli('sql562.main-hosting.eu','u271638276_tests','TestWellness-1','u271638276_tests');
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$id = (int)$_GET["id"];

if(empty($id)){
    $stmt = $conn->prepare("SELECT id_entrenamiento FROM entrenamiento");
    $stmt->execute();

    $resultado = $stmt->get_result();
    $ids = array();

    while($row = $resultado->fetch_assoc()){
        $id=array(
            "id" => $row["id_entrenamiento"]
        );
        $ids[] = $id;
   
    }
die(json_encode($ids));
}



$stmt = $conn->prepare("SELECT * FROM entrenamiento WHERE id_entrenamiento=?");
$stmt->bind_param("i",$id);
$stmt->execute();

$resultado = $stmt->get_result()->fetch_assoc();

$entrenamiento = array(
    "id_entrenamiento" => $resultado["id_entrenamiento"],
    "nombre" => $resultado["nombre"],
    "clasificacion" => $resultado["clasificacion"],
    "nivel" => $resultado["nivel"],
    "sub_nivel" => $resultado["sub_nivel"],
    "rutinas" => json_decode($resultado["rutinas"],True));
   
    


die(json_encode($entrenamiento));
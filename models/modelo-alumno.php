<?php
include_once "../functions/connection.php";

class Esfuerzo
{
    private $fecha;
    private $esfuerzo;
    private $duracion;

    public function __construct($fecha, $esfuerzo, $duracion)
    {
        $this->fecha = new DateTime($fecha);
        $this->esfuerzo = (int)$esfuerzo;
        $this->duracion = (int)$duracion;
    }
    public function semana()
    {
        return $this->fecha->format("W");
    }
    public function carga()
    {
        return $this->esfuerzo * $this->duracion;
    }
}

if ($_POST["accion"] == "asignar") {
    $id_entrenamiento = (int)$_POST["entrenamiento"];
    $programacion = $_POST["programacion"];
    $id_rutinas = $_POST["id"];
    $alumno = (int)$_POST["alumno"];

    $conn->autocommit(false);
    $stmt = $conn->prepare("SELECT * FROM entrenamiento WHERE id_entrenamiento=?");
    $stmt->bind_param("i", $id_entrenamiento);
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
    $entrenamiento_alumno["rutinas"] = json_decode($row["rutinas"], true);


    foreach ($id_rutinas as $key => $rutina) {

        $entrenamiento_alumno["rutinas"][$key]["programacion"] = $programacion[$rutina];
    }

    $entrenamiento_alumno = json_encode($entrenamiento_alumno);


    $stmt2 = $conn->prepare("UPDATE alumno set entrenamiento=? WHERE id_alumno=?");
    $stmt2->bind_param("si", $entrenamiento_alumno, $alumno);
    $stmt2->execute();


    $conn->autocommit(true);
    $stmt->close();
    $conn->close();
    die(json_encode(array("respuesta" => "Exito")));
}
if ($_POST["accion"] == "buscar") {
    $busqueda = "%" . $_POST["nombre"] . "%";

    $stmt = $conn->prepare("SELECT * FROM alumno WHERE nombre LIKE ?");
    $stmt->bind_param("s", $busqueda);
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();
    if (empty($resultado)) {
        $resultado = array("respuesta" => "error");
    }

    die(json_encode($resultado));
}
if ($_POST["accion"] == "buscar_matricula") {
    $busqueda = $_POST["matricula"];

    $stmt = $conn->prepare("SELECT * FROM alumno WHERE matricula = ?");
    $stmt->bind_param("s", $busqueda);
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();
    if (empty($resultado)) {
        $resultado = array("respuesta" => "error");
    }

    die(json_encode($resultado));
}
if ($_POST["accion"] == "datos") {
    //Debe devolver los datos historicos del alumno: Asistencia, Peso, Fuerzas Máximas y gráfica de esfuerzo
    $alumno = (int)$_POST["alumno"];

    $salida = array(
        "asistencia" => array("labels" => [], "values" => []),
        "peso" => array("labels" => [], "values" => [])

    );
    $conn->autocommit(false);

    //---------------------------------------------------------------------------
    $asistencia = $conn->prepare("SELECT * FROM (SELECT * FROM asistencia WHERE id_alumno = ? ORDER BY id_alumno DESC LIMIT 10) AS sub ORDER BY id_alumno ASC;");
    $asistencia->bind_param("i", $alumno);
    $asistencia->execute();

    $resultado = $asistencia->get_result();

    while ($row = $resultado->fetch_assoc()) {
        $salida["asistencia"]["labels"][] = $row["fecha"];
        $salida["asistencia"]["values"][] = 1;
    }
    //---------------------------------------------------------------------------
    $peso = $conn->prepare("SELECT * FROM peso WHERE id_alumno=?");
    $peso->bind_param("i", $alumno);
    $peso->execute();

    $resultado = $peso->get_result();

    while ($row = $resultado->fetch_assoc()) {
        $salida["peso"]["labels"][] = $row["fecha"];
        $salida["peso"]["values"][] = $row["peso"];
    }
    //---------------------------------------------------------------------------
    $esfuerzo = $conn->prepare("SELECT * FROM esfuerzo WHERE id_alumno=?");
    $esfuerzo->bind_param("i", $alumno);
    $esfuerzo->execute();

    $resultado = $esfuerzo->get_result();

    $esfuerzos = array();
    $semanas = array();

    // Leemos la entrada de mysql y se creamos un array de objetos esfuerzo
    while ($row = $resultado->fetch_assoc()) {
        $esfuerzo = new Esfuerzo($row["fecha"], $row["valor"], $row["duracion"]);
        $semanas[] = $esfuerzo->semana();
        $esfuerzos[] = $esfuerzo;
    }
    // Creamos un array de las semanas que tenemos
    $semanas = array_map('intval', array_values(array_unique($semanas)));
    sort($semanas);

    $semanaEsfuerzos = array();
    $cargaSemanales = array();
    $mediaCargasSemanales = array();
    $desviacionCargasSemanales = array();
    $monotoniasSemanales = array();
    $fatigasSemanales = array();

    $fatiga = array(
        "carga_semanal" => [],
        "monotonia" => [],
        "fatiga" => []
    );
    // Hacemos un array asociativo donde la llave es el numero de la semana y el valor es un arreglo de objetos esfuerzo

    foreach ($semanas as $semana) {
        foreach ($esfuerzos as $esfuerzo) {
            if ($esfuerzo->semana() == $semana) {
                $semanaEsfuerzos[$semana][] = $esfuerzo;
            }
        }
    }

    // Llenamos cada semana con un objeto 0 en los días de la semana que no tienen datos
    foreach ($semanaEsfuerzos as $semana => $esfuerzos) {
        $longitud = count($esfuerzos);
        $diasFaltantes = 7 - $longitud;
        for ($i = 0; $i < $diasFaltantes; $i++) {
            $semanaEsfuerzos[$semana][] = new Esfuerzo("2000-1-1", "0", "0");
        }
        
        
    }

    // Creamos las cargas semanales
    foreach ($semanaEsfuerzos as $semana => $esfuerzos) {

        foreach ($esfuerzos as $esfuerzo) {
            $cargaSemanales[$semana] += (int)$esfuerzo->carga();

            $mediaCargasSemanales[$semana] += (int)$esfuerzo->carga();
        }

        $mediaCargasSemanales[$semana] = round($mediaCargasSemanales[$semana] / 7, 1);

        foreach ($esfuerzos as $esfuerzo) {
            $desviacionCargasSemanales[$semana] += pow((int)$esfuerzo->carga() - $mediaCargasSemanales[$semana], 2);
        }
        $desviacionCargasSemanales[$semana] = round(sqrt($desviacionCargasSemanales[$semana] / 6), 1);

        $monotoniasSemanales[$semana] = round($mediaCargasSemanales[$semana] / $desviacionCargasSemanales[$semana],2);

        $fatigasSemanales[$semana] = round($cargaSemanales[$semana] * $monotoniasSemanales[$semana],2);

        
        
    }
    $fatiga["carga_semanal"][] = $cargaSemanales;
    $fatiga["monotonia"][] = $monotoniasSemanales;
    $fatiga["fatiga"][] = $fatigasSemanales;

    $salida["carga_semanal"]["labels"] = array_keys($cargaSemanales); 
    $salida["carga_semanal"]["values"] = array_values($cargaSemanales); 


    $salida["monotonia"]["labels"] = array_keys($monotoniasSemanales);
    $salida["monotonia"]["values"] =array_values($monotoniasSemanales);

    $salida["fatiga"]["labels"] = array_keys($fatigasSemanales);
    $salida["fatiga"]["values"] = array_values($fatigasSemanales);

    $conn->autocommit(true);
    $asistencia->close();
    $peso->close();
    $conn->close();
    die(json_encode($salida));
}
if ($_POST["accion"] == "asistencia") {
    $id = (int)$_POST["id"];
    date_default_timezone_set('America/Monterrey');
    $fecha = date('y-m-d', time());
    $hora = date('h:i:s', time());

    $stmt = $conn->prepare("INSERT INTO asistencia (id_alumno,fecha,hora) VALUES (?,?,?)");
    $stmt->bind_param("iss", $id, $fecha, $hora);
    $stmt->execute();
    die(json_encode(array("respuesta" => "exito")));
}

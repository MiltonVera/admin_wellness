<?php

include_once "../functions/connection.php";
include_once "../functions/sesion.php";


if($_POST["accion"] == "graficas"){
    $conn->query("SET lc_time_names = 'es_MX'");

    //Obteniendo las asistencias mensuales
    $stmt1 = $conn->prepare("SELECT COUNT(*) as asistencias, monthname(fecha) as mes FROM asistencia GROUP BY MONTH(fecha)");
    $stmt1->execute();

    $resultado = $stmt1->get_result();

    $asistenciaMensual = array("labels" => [],"values" => []);

    while($row = $resultado->fetch_assoc()){
        $asistenciaMensual["labels"][] = $row["mes"];
        $asistenciaMensual["values"][] = $row["asistencias"];
    }

    $stmt1->close();

    //Obteniendo las asistencias semanales
    $stmt2 = $conn->prepare("SELECT dayname(fecha) as dia ,COUNT(*) as asistencias FROM asistencia WHERE week(fecha) = week(curdate()) GROUP BY day(fecha) ORDER BY dayofweek(fecha)");
    $stmt2->execute();

    $resultado = $stmt2->get_result();

    $asistenciaSemanal = array("labels" => [],"values" => []);

    while($row = $resultado->fetch_assoc()){
        $asistenciaSemanal["labels"][] = $row["dia"];
        $asistenciaSemanal["values"][] = $row["asistencias"];
    }

    $stmt2->close();
    $conn->close();

    die(json_encode(array("mensual" => $asistenciaMensual,"semanal" => $asistenciaSemanal)));


}
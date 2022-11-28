<?php
    include_once "../functions/connection.php";

    if($_POST["accion"] == "asignar"){
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
        die(json_encode(Array("respuesta"=>"Exito")));
    }
    if($_POST["accion"] == "buscar"){
        $busqueda = "%".$_POST["nombre"]."%";

        $stmt = $conn->prepare("SELECT * FROM alumno WHERE nombre LIKE ?");
        $stmt->bind_param("s",$busqueda);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        if(empty($resultado)){
            $resultado = Array("respuesta" =>"error");
        }

        die(json_encode($resultado));

    }
    if($_POST["accion"] == "buscar_matricula"){
        $busqueda = $_POST["matricula"];

        $stmt = $conn->prepare("SELECT * FROM alumno WHERE matricula = ?");
        $stmt->bind_param("s",$busqueda);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        if(empty($resultado)){
            $resultado = Array("respuesta" =>"error");
        }

        die(json_encode($resultado));

    }
    if($_POST["accion"] == "datos"){
        //Debe devolver los datos historicos del alumno: Asistencia, Peso, Fuerzas Máximas y gráfica de esfuerzo
        $alumno = (int)$_POST["alumno"];

        $salida = array(
            "asistencia" => Array("labels" => [] , "values" => []),
            "peso" => Array("labels" => [] , "values" => []),
            "Sentadilla" => Array("labels" => [] , "values" => []),
            "PressBanca" => Array("labels" => [] , "values" => []),
            "PesoMuerto" => Array("labels" => [] , "values" => []),
            "PressMilitar" => Array("labels" => [] , "values" => []),
            "esfuerzo" => Array("labels" => [] , "values" => [])
        );
        $conn->autocommit(false);

        //---------------------------------------------------------------------------
        $asistencia = $conn->prepare("SELECT * FROM asistencia WHERE id_alumno=?");
        $asistencia->bind_param("i",$alumno);
        $asistencia->execute();

       $resultado = $asistencia->get_result();

        while($row =$resultado->fetch_assoc()){
            $salida["asistencia"]["labels"][] = $row["fecha"];
            $salida["asistencia"]["values"][] = 1;
        }
        //---------------------------------------------------------------------------
        $peso = $conn->prepare("SELECT * FROM peso WHERE id_alumno=?");
        $peso->bind_param("i",$alumno);
        $peso->execute();

        $resultado = $peso->get_result();

        while($row = $resultado->fetch_assoc()){
            $salida["peso"]["labels"][] = $row["fecha"];
            $salida["peso"]["values"][] = $row["peso"];
        }
        //---------------------------------------------------------------------------
        $sentadilla = $conn->prepare("SELECT * FROM basico WHERE id_alumno=? AND ejercicio='Sentadilla'");
        $sentadilla->bind_param("i",$alumno);
        $sentadilla->execute();

        $resultado = $sentadilla->get_result();

        while($row = $resultado->fetch_assoc()){
            $salida["Sentadilla"]["labels"][] = $row["fecha"];
            $salida["Sentadilla"]["values"][] = $row["peso"];
        }
        //---------------------------------------------------------------------------
        $pressbanca = $conn->prepare("SELECT * FROM basico WHERE id_alumno=? AND ejercicio='PressBanca'");
        $pressbanca->bind_param("i",$alumno);
        $pressbanca->execute();

        $resultado = $pressbanca->get_result();

        while($row = $resultado->fetch_assoc()){
            $salida["PressBanca"]["labels"][] = $row["fecha"];
            $salida["PressBanca"]["values"][] = $row["peso"];
        }
        //---------------------------------------------------------------------------
        $pesomuerto = $conn->prepare("SELECT * FROM basico WHERE id_alumno=? AND ejercicio='PesoMuerto'");
        $pesomuerto->bind_param("i",$alumno);
        $pesomuerto->execute();

        $resultado = $pesomuerto->get_result();

        while($row = $resultado->fetch_assoc()){
            $salida["PesoMuerto"]["labels"][] = $row["fecha"];
            $salida["PesoMuerto"]["values"][] = $row["peso"];
        }
        //---------------------------------------------------------------------------
        $pressmilitar = $conn->prepare("SELECT * FROM basico WHERE id_alumno=? AND ejercicio='PressMilitar'");
        $pressmilitar->bind_param("i",$alumno);
        $pressmilitar->execute();

        $resultado = $pressmilitar->get_result();

        while($row = $resultado->fetch_assoc()){
            $salida["PressMilitar"]["labels"][] = $row["fecha"];
            $salida["PressMilitar"]["values"][] = $row["peso"];
        }
        //---------------------------------------------------------------------------
        $esfuerzo = $conn->prepare("SELECT * FROM esfuerzo WHERE id_alumno=?");
        $esfuerzo->bind_param("i",$alumno);
        $esfuerzo->execute();

       $resultado = $esfuerzo->get_result();

        while($row =$resultado->fetch_assoc()){
            $salida["esfuerzo"]["labels"][] = $row["fecha"];
            $salida["esfuerzo"]["values"][] = $row["valor"];
        }

        $conn->autocommit(true);
        $asistencia->close();
        $peso->close();
        $conn->close();
        die(json_encode($salida));
    }
    if($_POST["accion"] == "asistencia"){
        $id = (int)$_POST["id"];
        date_default_timezone_set('America/Monterrey');
        $fecha = date('y-m-d', time());
        $hora = date('h:i:s', time());

        $stmt = $conn->prepare("INSERT INTO asistencia (id_alumno,fecha,hora) VALUES (?,?,?)");
        $stmt->bind_param("iss",$id,$fecha,$hora);
        $stmt->execute();
        die(json_encode(Array("respuesta" => "exito")));
    }

    

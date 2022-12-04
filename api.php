<?php

include_once "functions/connection.php";

// ===== Funciones helper

// Función que genera un hash con el algoritmo Bcrpy usando la matricula, contraseña y el timestamp actual
function generarToken($matricula,$contra){
    date_default_timezone_set('America/Monterrey');
    $date = new Datetime();
    $timestamp =  $date->format('U');
    return password_hash($matricula . $contra . $timestamp, PASSWORD_BCRYPT, array("cost" => 5));
}

// Funcion que verifica si el token existe y devuelve a que id_usuario pertenece
function validarSesion($conn,$token) : bool{
    //Primero Verifica si el token fue reseteado(Logout)
    if($token == "0"){
        return false;
    }
    
    $stmt = $conn->prepare("SELECT id_alumno FROM alumno WHERE token = ?");
    $stmt->bind_param("s",$token);
    $stmt->execute();

    // Verificamos que exista un usuario con ese token de sesión
    if($stmt->fetch()){
        $stmt->close();
        // Si si existe un alumno con ese token entonces devolvemos el id obtenido
        return true;
    }
    $stmt->close();
    //En caso de que no exista un alumno con ese token devolvemos falso
    return false;
}

function parseExperiencia($experiencia){
    $experiencias = Array("Nula","Basico","Intermedio","Avanzado");
    return $experiencias[$experiencia];
}
function obtenerId($conn,$token) :int{
    $stmt = $conn->prepare("SELECT id_alumno FROM alumno WHERE token = ?");
    $stmt->bind_param("s",$token);
    $stmt->execute();
    $id = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $id["id_alumno"];
}

// ===== Fin de funciones helper

//Paremetros de la api
// Accion: Se debe mandar cual es la accion a ejecutar
// Token: Se manda el token de usuario para funciones que requieren de autenticacion



//========Funciones de creacion de usuario o login de usuario son las unicas que no requieren de un token
if ($_POST["accion"] == "login") {
    //Leemos los datos enviados por POST
    $matricula = $_POST["matricula"];
    $contra = $_POST["pass"];

    // Consultamos en la base de datos el id y la contraseña hasheada del alumno
    $stmt = $conn->prepare("SELECT id_alumno,contra FROM alumno WHERE matricula=?");
    $stmt->bind_param("s", $matricula);
    $stmt->execute();
    $stmt->bind_result($id_alumno, $contraHash);
    // Convertirmos el id alumno en entero
    $id_alumno = (int)$id_alumno;
    //Si esto es verdadero es porque si hay un alumno con esa matricula
    // Hacemos una segunda comprobación guardando todo en una variables
    $existe = $stmt->fetch();
    // Si la variables tiene algo entonces hace la verificación de la contraseña
    if ($existe) {
        // Si la contra hasheada que recibimos es la misma que la que tenemos guardada en la base de datos
        if ($contra == $contraHash) {
            //Si todo es correcto entonces creamos el token y lo devolvemos
            $stmt->close();

            
            //Creamos un otken usando el algoritmo BCRYPT con un costo de 5, hacemos este hash usando la matricula, la contrasela y el timestamp actual
            $token = generarToken($matricula,$contra);

            // Guardamos el nuevo token de sesión en el alumno
            $stmt2 = $conn->prepare("UPDATE alumno SET token = ? WHERE id_alumno=?");
            $stmt2->bind_param("si", $token, $id_alumno);
            $stmt2->execute();

            // Si el login fue correcto devolvemos el token de sesión
            $respuesta = array(
                "token" => $token
            );
            $stmt2->close();
        }else{
            $respuesta = array(
                "error" => "pass"
            );
        }
    }
    // Si no hay un alumno con esa matricula lo informamos
    else {
        $respuesta = array(
            "error" => "matricula"
        );
    }
    $conn->close();
    die(json_encode($respuesta));
}

if ($_POST["accion"] == "registro") {
    $nombre = $_POST["nombre"];
    $matricula = $_POST["matricula"];
    $contra = $_POST["pass"];
    $formulario = $_POST["formulario"];

    //Primer paso, verificar que el alumno no esta registrado previamente
    $stmt = $conn->prepare("SELECT matricula FROM alumno WHERE matricula=?");
    $stmt->bind_param("s", $matricula);
    $stmt->execute();

    // Primero verificaremos si existe el registro
    $existe = $stmt->fetch();
    $stmt->close();
    // Primero verificamos si el usuario no existia oreviamente
    if (!$existe) {

            // Ya que comprobamos que el usuario no ha sido registrado ahora si realizamos el registro
            
            //Antes de insertar el usuario y generar un token de sesión debemos formatear el formulario
            $formulario = json_decode($formulario,true);

            $experiencia = (int)$formulario["experiencia"];     // Valor que va del 0 al 3 | 0: Nada de experiencia, 1: Menos de un año entrenando, 2: De 1 a 2 años , 3: mas de dos años entrenando
            $descanso = (int)$formulario["descanso"];           // Valor que va del 0 al 4
            $objetivos = json_encode($formulario["objetivos"]); // Array con elementos que van del 1 al 5 | Bajar de Peso:1, Hipertrofia:2, Mantenerse Sano:3, Ganar Fuerza:4, Estetica:5
            $lesion = (int)$formulario["lesion"];               // Valor que es 0 si no hay lesion y 1 si si la hay
            $altura = (int)$formulario["altura"];               // Altura en centimetros
            $edad = (int)$formulario["edad"];                   // Edad en años

            //Creamos un otken usando el algoritmo BCRYPT con un costo de 5, hacemos este hash usando la matricula, la contraseña y el timestamp actual
            $token = generarToken($matricula,$contra);
            
            // Ya tenemos todos los datos ahora solo hay que hacer una inserción a la base de datos
            $stmt2= $conn->prepare("INSERT INTO alumno (nombre,matricula,contra,edad,altura,experiencia,objetivos,lesion,descanso,token) VALUES (?,?,?,?,?,?,?,?,?,?)");
            $stmt2->bind_param("sssiiisiis",$nombre,$matricula,$contra,$edad,$altura,$experiencia,$objetivos,$lesion,$descanso,$token);
            $stmt2->execute();
            $stmt2->close();

            //Ahora que insertamos al alumno solo queda marcar a este alumno como registrado
            $stmt3 = $conn->prepare("UPDATE autorizados SET registrado = 1 WHERE matricula= ?");
            $stmt3->bind_param("s",$matricula);
            $stmt3->execute();
            $stmt3->close();

            $respuesta = array("token"=> $token);

     
    } else {
        // Si no esta autorizado lo informamos
        $respuesta = array("error" => "registrado");
    }



    $conn->close();
    die(json_encode($respuesta));
}
// =============== Fin de funciones que no requieren de token para ser usadas

// ============ Funciones del sistema movil que requieren estar autenticado para poder funcionar
if($_POST["accion"] == "logout"){
    $token = $_POST["token"];
    
    
    $stmt = $conn->prepare("UPDATE alumno SET token='0' WHERE token=?");
    $stmt->bind_param("s",$token);
    $stmt->execute();

    if($stmt->affected_rows){
        //Si se afectaron columnas entonces todo salio bien
        die(json_encode(array("respuesta"=>"correcto")));
    }
    die(json_encode(array("error"=>"Token Invalido")));
}
if($_POST["accion"] == "home"){
    $token = $_POST["token"];

    // Verificamos si el token es valido es decir: no es 0(logout) y existe un usuario con ese token
    if(!validarSesion($conn,$token)){
        //Si el token enviado no es valido se lo indicamos al usuario
        die(json_encode(Array("error"=> "Token Invalido")));
    }
    //Primero Solicitaremos todos los datos de la tabla de alumnos
    $stmt = $conn->prepare("SELECT id_alumno,nombre,experiencia,entrenamiento FROM alumno WHERE token=?");
    $stmt->bind_param("s",$token);
    $stmt->execute();

    //Guardamos el alumno en u array asociativo
    $alumno = $stmt->get_result()->fetch_assoc();

    //Guardamos el id para buscar su asistenci posteriormente
    $id = (int)$alumno['id_alumno'];
    //Borramos el Id de la respuesta para no exponer datos sensibles
    unset($alumno['id_alumno']);
    //Decodificamos el json para poder luego volverlo a parsear en la respuesta
    $alumno["entrenamiento"] = json_decode($alumno["entrenamiento"],true);


    //Ahora hacemos algo similar con la experiencia
    $alumno["experiencia"] = parseExperiencia($alumno["experiencia"]);
    $stmt->close();

    //Ahora que tenemos los datos generales del alumno procedemos a buscar sus datos de asistencia
    $stmt2 = $conn->prepare("SELECT * FROM asistencia WHERE id_alumno=?");
    $stmt2->bind_param("i",$id);
    $stmt2->execute();

    $asistencia = array("labels" => [] , "values" => []);

    $resultado = $stmt2->get_result();

        while($row =$resultado->fetch_assoc()){
            $asistencia["labels"][] = $row["fecha"];
            $asistencia["values"][] = 1;
        }
    $stmt2->close();

    $alumno["asistencia"] = $asistencia;
    die(json_encode($alumno));

}
if($_POST["accion"] == "peso"){
    $token = $_POST["token"];
    $peso = (float)$_POST["peso"];

     // Verificamos si el token es valido es decir: no es 0(logout) y existe un usuario con ese token
     if(!validarSesion($conn,$token)){
        //Si el token enviado no es valido se lo indicamos al usuario
        die(json_encode(Array("error"=> "Token Invalido")));
    }

    //Obtenemos el id correspondiente al token
    $id = obtenerId($conn,$token);
    date_default_timezone_set('America/Monterrey');
    $fecha = date('y-m-d', time());

    $stmt = $conn->prepare("INSERT INTO peso (id_alumno,peso,fecha) VALUES (?,?,?)");
    $stmt->bind_param("ids",$id,$peso,$fecha);
    $stmt->execute();
    $stmt->close();

    die(json_encode(Array("respuesta" => "exito")));
}
if($_POST["accion"] == "rm"){
    $token = $_POST["token"];
    $peso = (int)$_POST["peso"];
    // Las opciones para ejercicio son PressBanca,PesoMuerto, Sentadilla, PressMilitar
    $ejercicio =$_POST["ejercicio"];
     // Verificamos si el token es valido es decir: no es 0(logout) y existe un usuario con ese token
     if(!validarSesion($conn,$token)){
        //Si el token enviado no es valido se lo indicamos al usuario
        die(json_encode(Array("error"=> "Token Invalido")));
    }

    //Obtenemos el id correspondiente al token
    $id = obtenerId($conn,$token);
    date_default_timezone_set('America/Monterrey');
    $fecha = date('y-m-d', time());

    //Ahora que insertamos el nuevo rm del usuario debemos actualizar el json de este usuario
    $stmt = $conn->prepare("INSERT INTO rm (peso,id_alumno,id_ejercicio,fecha) VALUES (?,?,?,?)");
    $stmt->bind_param("diis",$peso,$id,$ejercicio,$fecha);
    $stmt->execute();
    $stmt->close();

    //Primero obtenemos el json del usuario
    $stmt2 = $conn->prepare("SELECT entrenamiento FROM alumno WHERE id_alumno=?");
    $stmt2->bind_param("i",$id);
    $stmt2->execute();
    $alumno = $stmt2->get_result()->fetch_assoc();
    $stmt2->close();

    $alumno = json_decode($alumno["entrenamiento"],true);
    
    foreach($alumno["rutinas"] as $key =>&$rutina){
        foreach($rutina["ejercicios"] as &$ejer ){
            if($ejer["id"] == $ejercicio){
                $ejer["peso"]= $peso;
            }
        }
    }

    $alumno = json_encode($alumno);

    //Ya que añadimos el peso al JSON del alumno ahora volvemos a insertar en json con el nuevo peso registrado}
    $stmt3 = $conn->prepare("UPDATE alumno SET entrenamiento=?");
    $stmt3->bind_param("s",$alumno);
    $stmt3->execute();


    
    die(json_encode(Array("respuesta" => "exito")));
}
if($_POST["accion"] == "esfuerzo"){
    $token = $_POST["token"];
    $valor = (int)$_POST["valor"];
    $duracion = (int)$_POST["duracion"];
    // Las opciones para ejercicio son PressBanca,PesoMuerto, Sentadilla, PressMilitar
    $id_rutina = (int)$_POST["id_rutina"];
     // Verificamos si el token es valido es decir: no es 0(logout) y existe un usuario con ese token
     if(!validarSesion($conn,$token)){
        //Si el token enviado no es valido se lo indicamos al usuario
        die(json_encode(Array("error"=> "Token Invalido")));
    }

    //Obtenemos el id correspondiente al token
    $id = obtenerId($conn,$token);
    date_default_timezone_set('America/Monterrey');
    $fecha = date('y-m-d', time());

    $stmt = $conn->prepare("INSERT INTO esfuerzo (id_alumno,valor,fecha,rutina,duracion) VALUES (?,?,?,?,?)");
    $stmt->bind_param("iisii",$id,$valor,$fecha,$id_rutina,$duracion);
    $stmt->execute();

    $stmt->close();
    
    die(json_encode(Array("respuesta" => "exito")));
}





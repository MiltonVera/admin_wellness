<?php
include_once "../functions/connection.php";
include_once "functions/sesion.php";

$nombre  = $_POST['nombre'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$admin = (int)$_POST['admin'];
$id_registro = $_POST['id_registro'];

if($_POST['registro'] == 'nuevo'){
    $opciones = array(
        'cost' => 10
    );
    $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);

    try {
        $stmt = $conn->prepare('INSERT INTO entrenador (nombre, correo, password,admin) VALUES (?,?,?,?)');
        $stmt->bind_param("sssi", $nombre,$correo, $password_hashed,$admin);
        $stmt->execute();
        $id_registro = $stmt->insert_id;
        if($id_registro > 0) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_admin' => $id_registro
            );
            
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    
    die(json_encode($respuesta));
}

if($_POST['registro'] == 'actualizar'){

    try {
        if(empty($_POST['password']) ) {
            $stmt = $conn->prepare("UPDATE entrenador SET nombre = ?,correo = ?, admin=? WHERE id_entrenador = ? ");
            $stmt->bind_param("ssii",$nombre, $correo, $admin, $id_registro);
        } else {
            $opciones = array(
                'cost' => 10
            );            
            $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
            $stmt = $conn->prepare('UPDATE entrenador SET nombre = ?,correo = ?, password = ?,admin=? WHERE id_entrenador = ? ');
            $stmt->bind_param("sssii",  $nombre,$correo, $hash_password,$admin,$id_registro);
        }
        
        

        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_actualizado' => $stmt->insert_id
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
if($_POST['registro'] == 'eliminar'){
    $id_borrar = $_POST['id'];

    try{
        $stmt = $conn->prepare("DELETE FROM entrenador WHERE id_entrenador=?");
        $stmt->bind_param("i",$id_borrar);
        $stmt->execute();
        $respuesta = array(
            'respuesta' => 'exito',
            'id_eliminado' => $id_borrar
        );
        $stmt->close();
        $conn->close();
    }catch(Exception $e){
        $resultado = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($resultado));
}
if (isset($_POST['login-admin'])) {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    try {       
        $stmt = $conn->prepare("SELECT * FROM entrenador where correo = ?");
        $stmt->bind_param("s", $correo);       
        $stmt->execute();
        $stmt->bind_result($id_admin,$nombre_admin,$correo_admin,$password_admin,$admin);
        if($stmt->affected_rows){
            $existe = $stmt->fetch();
            if($existe){
                if(password_verify($password,$password_admin)){
                    session_start();

                    $_SESSION['nombre'] = $nombre_admin;
                    $_SESSION['correo'] = $correo_admin;
                    $_SESSION['admin'] = $admin;
                    $_SESSION['id'] = $id_admin;

                    $respuesta = array(
                        'respuesta' => 'exito'
                    );
                }else{
                    $respuesta = array(
                        'respuesta' => 'error'
                    );
                }
                
            }else{
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo 'Error:'. $e->getMessage();
    }
    die(json_encode($respuesta));
}                                                                                                      
?>

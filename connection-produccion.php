<?php 
// Production credentials do not share
$conn = new mysqli('localhost','gymwadp','Ap9ZaA4URDCVvUB','gymwellness_academiadeportiva_org');
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

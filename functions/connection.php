<?php 

$conn = new mysqli('sql562.main-hosting.eu','u271638276_tests','TestWellness-1','u271638276_tests');
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
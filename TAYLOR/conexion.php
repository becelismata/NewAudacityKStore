<?php
$hostname = 'localhost';
$database = 'audacity';
$username = 'root';
$pasword = '12345';
$conexion = new mysqli($hostname, $username, $pasword, $database);
if($conexion->connect_errno){
    echo "No se pudo conectar a la base de datos";
}
else{
    echo "Conexión exitosa";
}   

?>
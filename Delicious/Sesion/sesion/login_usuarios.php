<?php

//ENTRADA A USUARIOS YA REGISTRADOS Y AL ADMINISTRADOR
include '../../baseDatos/conexion.php';
session_start();
$_SESSION['usuario']=$correo;

$correo =$_POST['correos'];
$contrasena =$_POST['contrasenas'];
if($correo == "goku46265@gmail.com" && $contrasena == "goku500"){
    $_SESSION['usuario'] = $correo;
    header("location:../../admin/vista_bebidas.php");
}else{
$validar_login = mysqli_query($conexion, "SELECT * FROM login_usuarios WHERE correo='$correo' and contrasena='$contrasena'");
if(mysqli_num_rows($validar_login) > 0){
    $_SESSION['usuario'] = $correo;
    header("location: ../../index.html");
}else{
    echo'
    <script>
        alert("Usuario no existente, porfavor verifique los datos");
        window.location = "../Sesion/Inicio de sesion.html";
    </script>
    ';
    exit();
}
}
?>

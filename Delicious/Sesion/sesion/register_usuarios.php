<?php
//GUARDAR LOS REGISTROS A LA BASE DE DATOS

include '../../baseDatos/conexion.php';

$nombre_completo = $_POST['nombre_completo'];
$telefono = $_POST['numtel'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

if($nombre_completo==""||$telefono==""||$correo==""||$contrasena==""){
    echo '
        <script>
        alert("Por favor llene todos los campos");
        window.location="registro.html";    
        </script>  
    ';
    exit();
}

$query = "INSERT INTO login_usuarios(nombre_completo, telefono, correo, contrasena) 
            VALUES('$nombre_completo', '$telefono', '$correo', '$contrasena')"; 

//Verificar que el correo no se repita

$verificar_correo = mysqli_query($conexion, "SELECT * FROM login_usuarios WHERE correo='$correo'");

if(mysqli_num_rows($verificar_correo) > 0){
    echo '
    <script>
        alert("Este correo ya esta registrado intenta con otro diferente");
        window.location="registro.html";
    </script>
    ';
    exit();
}

//ejecutar codogo de gurdar datos en la base


$ejecutar = mysqli_query($conexion, $query);

if("$ejecutar"){
    echo'
    <script>
    window.location="Inicio de sesion.html";
    alert("usuario registrado exitosamente")
    </script>
    ';
}else{
    echo'
    <script>
    alert("Intentelo de nuevo, Usuario no almacenado");
    window.location="registro.html"
    </script>
    ';
}

mysqli_close($conexion);


?>
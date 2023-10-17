<?php
include_once '../baseDatos/bd.php';
$conexionBD=BD::crearInstancia();

$id=isset($_POST['id'])?$_POST['id']:'';
$producto=isset($_POST['producto'])?$_POST['producto']:'';
$precio=isset($_POST['precio'])?$_POST['precio']:'';
$ruta=isset($_POST['ruta'])?$_POST['ruta']:'';
$accion=isset($_POST['accion'])?$_POST['accion']:'';

/* print_r($_POST);*/

if($accion!=''){
    switch($accion){
        case 'agregar':
        $sql="INSERT INTO postres(id, producto, precio, ruta) VALUES(:id, :producto, :precio, :ruta)";
        $consulta=$conexionBD->prepare($sql);
        $consulta->bindParam(':id',$id);
        $consulta->bindParam(':producto',$producto);
        $consulta->bindParam(':precio',$precio);
        $consulta->bindParam(':ruta',$ruta);
        $consulta->execute();
        /*echo $sql;*/
        break;
        case 'editar':
            $sql="UPDATE postres SET producto=:producto, precio=:precio, ruta=:ruta WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->bindParam('producto',$producto);
            $consulta->bindParam(':precio',$precio);
            $consulta->bindParam(':ruta',$ruta);
            $consulta->execute();
    /*  echo $sql; */
        break;
        case 'borrar':
            $sql="DELETE FROM postres WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();

        break;
        case "Seleccionar":
            $sql="SELECT * FROM postres WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            $bebidas=$consulta->fetch(PDO::FETCH_ASSOC);
            $producto=$bebidas['producto'];
            $precio=$bebidas['precio'];
            $ruta=$bebidas['ruta'];

        break;
    }
}

$consulta=$conexionBD->prepare("SELECT * FROM postres");
$consulta->execute();
$listaProductos=$consulta->fetchAll();

/*
$nombre_prenda = $_POST['nombre_prenda'];
$talla = $_POST['talla'];
$precio = $_POST['precio'];
$texto = $_POST['texto'];
$existencia = $_POST['existencia'];

$query = "INSERT INTO `ninos`(`nombre_prenda`, `talla`, `precio`, `texto`, `existencia`) VALUES ('$nombre_prenda','$talla','$precio','$texto','$existencia')";

$resultado=$con->query($query);
if ($resultado){
    echo "Correcto";
}
else{
    echo "Error";
}*/


?>
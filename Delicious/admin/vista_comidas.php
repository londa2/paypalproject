<!doctype html>
<html lang="es">

<head>
  <title>AdminDeli</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../Sesion/css/admin.css">
</head>

<style>
      
        body {
            background-color: #f8f9fa;
        }

        .header {
            background-color: #6A6F4C;
            color:#6A6F4C;
            padding: 10px 0;
        }

        .navbar {
            background-color: #6A6F4C;
        }

        .navbar a {
            color: #ffffff;
            margin-right: 20px;
            text-decoration: none;
        }

        .container {
            margin-top: 20px;
        }

        .card-header {
            background-color: #6A6F4C;
            color: #ffffff;
        }

        .card {
            margin-bottom: 20px;
        }

        .btn-group button {
            margin-right: 10px;
        }

        table {
            background-color: #ffffff;
        }

        th {
            background-color: #343a40;
            color: #ffffff;
        }
    </style>
<body>
<div class="header">



<nav class="navbar">
      <a href="../index.html">Inicio</a>
      <a href="../admin/vista_bebidas.php">Bebidas</a>
      <a href="../admin/vista_desayunos.php">Desayunos</a>
      <a href="../admin/vista_comidas.php">Comidas</a>
      <a href="../admin/vista_postres.php">Postres</a>
</nav>
</div>
<br><br><br><hr>

<div class="conteiner">
    
    <?php include('../php/comi.php'); ?>
    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-md-5">
            <form action="" method="post">
              <div class="card">
                <div class="card-header">Registro Producto</div>
                <div class="card-body">
                  <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" class="form-control" name="id" value="<?php echo $id; ?>"
                      aria-describedby="helpId" placeholder="id">
                  </div>
                  <div class="mb-3">
                    <label for="producto" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="producto" value="<?php echo $producto; ?>"
                      aria-describedby="helpId" placeholder="Nombre del producto">
                  </div>
                  <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="text" class="form-control" name="precio" value="<?php echo $precio; ?>"
                      aria-describedby="helpId" placeholder="Precio del platillo">
                  </div>
                  <div class="mb-3">
                    <label for="ruta" class="form-label">Ruta</label>
                    <input type="text" class="form-control" name="ruta" value="<?php echo $ruta; ?>" 
                     aria-describedby="helpId" placeholder="Ruta">
                  </div>
                  
                  <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button>
                    <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>
                  </div>
                </div>
              </div>
            </form>
          </div>

          <div class="col-md-7">
            <table class="table">
              <thead>
                <tr>
                  <!--  <th scope="col">ID</th> -->
                  <th scope="col">Nombre</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Ruta</th>
                  <th scope="col">Accion</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php foreach($listaProductos as $mos){ ?>
                  <!--<td><?php echo $mos['id']; ?></td>-->
                  <td>
                    <?php echo $mos['producto'];?>
                  </td>

                  <td>
                    <?php echo $mos['precio'];?>
                  </td>
                  <td>
                    <?php echo $mos['ruta'];?>
                  </td>
                  <td>
                    <form action="" method="post">
                      <input type="hidden" name="id" id="id" value="<?php echo $mos['id']; ?>" />
                      <input type="submit" value="Seleccionar" name="accion" class="btn btn-info">
                    </form>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>

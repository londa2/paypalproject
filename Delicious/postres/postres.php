<?php
session_start();

include('../php/post.php');
$conexionBD = BD::crearInstancia();

$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
    $sql = $conexionBD->prepare("SELECT id, producto, precio, ruta FROM postres WHERE producto LIKE :search");
    $sql->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Si no se ingresó un término de búsqueda, puedes mostrar todos los productos de desayunos
    $sql = $conexionBD->prepare("SELECT id, producto, precio, ruta FROM postres");
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}


?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <title>Postres</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nombre+de+la+Fuente">
</head>
<style>
        /* Estilos CSS para el carrusel, el menú y el botón de búsqueda */
        body {
            font-family: 'Nombre de la Fuente', sans-serif;
        }


        .imagen-grande {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.imagen-grande img {
    width: 100%;
    height: 100%;
    object-fit: cover; 
}


        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 90%;
            padding: 20px 100px;
            background: #6A6F4C;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
        }

        .navbar {
            display: flex;
            gap: 20px;
        }

        .navbar a {
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            font-size: 18px;
            margin-left: 40px;
        }

        /* Estilos para el botón de búsqueda */
      

        .search-container {
            display: flex;
            align-items: center;
        }

        #search-input {
            border: none;
            border-radius: 20px; 
            padding: 8px 12px;
            margin-right: 10px;
            
        }

        button {
            background-color: #6A6F4C;
            color: #fff;
            border: none;
            border-radius: 20px; 
            padding: 8px 12px;
            cursor: pointer;
            
        }


            .portada  {
          border-radius: 100px;
          border: 2px solid #3F0C1F;
          overflow: hidden;
          width: 200px; /*automatically center image: give width, and margin left/right to auto */
          height: 200px;
        
        }
        .portada img {
            width:100%;
            height:100%;
            transition: all 0.8s;
        }
        .portada:hover > img {
        transform: scale(1.2);
        }

        .contenidos {
    display: grid;
    grid-template-columns: repeat(4, 1fr); 
    gap: 20px; 
    justify-content: center; 
}
        .bebida {
            padding:100px;
        }

        .bebida {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
    transition: transform 0.3s ease;
    text-align: center;
    width: 200px;
    margin: 10px; 
}

.bebida:hover {
    transform: translateY(-5px); 
}

/*carro*/
.carrito {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #fff;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        display: none;
    }

    .carrito h4 {
        margin: 0;
    }

    .carrito ul {
        list-style: none;
        padding: 0;
    }

    .carrito li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }

    .total {
        text-align: right;
        margin-top: 10px;
    }
    /* Estilos para el icono de carrito */
    .carrito-icon {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #6A6F4C;
        color: #fff;
        font-size: 24px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    /* Estilos para el carrito desplegable */
    .carrito-desplegable {
        position: fixed;
        bottom: 70px;
        right: 20px;
        background-color: #fff;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        display: none;
        max-height: 200px;
        overflow-y: auto;
    }

    .carrito-desplegable h4 {
        margin: 0;
    }

    .carrito-desplegable ul {
        list-style: none;
        padding: 0;
    }

    .carrito-desplegable li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }

    .total {
        text-align: right;
        margin-top: 10px;
    }
    </style>
</head>
<body>
    
    <div class="header">
    <form>
    <input type="text" id="search-input" name="search" placeholder="Buscar...">
    <button type="submit"><i class="fas fa-search"></i></button>
</form>

        <nav class="navbar">
            <a href="../index.html">Inicio</a>
            <a href="../bebidas/bebidas.php">Bebidas</a>
            <a href="../desayunos/desayunos.php">Desayunos</a>
            <a href="../Comida/comidas.php">Comidas</a>
            <a href="../postres/postres.php">Postres</a>

        </nav>
    </div>

    <div class="imagen-grande">
        <img src="../imagen/8.png" alt="Imagen Grande">
    </div>

    <hr>

       
      </div>
    <div class="contenidos">
    <?php foreach ($resultado as $mos) { ?>
        <div class="bebida">
            <?php
                $imagen = $mos['ruta'];
                if (!file_exists($imagen)) {
                    $imagen = "../bebidas/no-photo.jpg";
                }
            ?>
            <div class="portada"><img src="<?php echo $imagen; ?>" alt="bebida "></div>
            <h3><?php echo $mos['producto'] ?></h3>
            <h4><?php echo $mos['precio'] ?></h4>
            <!--<button onclick="ordenar('<?php echo $mos['producto'] ?>', <?php echo $mos['precio'] ?>)">Ordenar</button>-->
           
        </div>
    <?php } ?>
    </div>
<!--
    <div class="carrito-icon" onclick="mostrarCarrito()">
        <i class="fas fa-shopping-cart"></i>
    </div>
            
     Carrito de compras desplegable 
    <div class="carrito-desplegable" id="carrito-desplegable">
        <h4>Carrito de Compras</h4>
        <ul id="carrito-lista">
            Los productos seleccionados se agregarán aquí 
        </ul>
        <div class="total">
            Total: $<span id="carrito-total">0.00</span>
        </div>
    </div>
            -->
    <script>
        const carrito = [];
        let total = 0;

        function ordenar(producto, precio) {
            // Agregar el producto al carrito
            carrito.push({ nombre: producto, precio: precio });
            
            // Actualizar la lista de productos en el carrito
            actualizarCarrito();

            // Actualizar el total
            total += precio;
            document.getElementById("carrito-total").textContent = total.toFixed(2);
            
            // Mostrar el carrito
            document.querySelector('.carrito-desplegable').style.display = 'block';
        }

        function actualizarCarrito() {
            const carritoLista = document.getElementById("carrito-lista");
            carritoLista.innerHTML = '';

            carrito.forEach((producto) => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <span>${producto.nombre}</span>
                    <span>$${producto.precio.toFixed(2)}</span>
                `;
                carritoLista.appendChild(li);
            });
        }

        function mostrarCarrito() {
            const carritoDesplegable = document.getElementById("carrito-desplegable");
            if (carritoDesplegable.style.display === 'block') {
                carritoDesplegable.style.display = 'none';
            } else {
                carritoDesplegable.style.display = 'block';
            }
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>NegocioRand</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="Negocios.css">
        <style>
            * {
                font-family: 'Roboto', sans-serif;
            }
        </style>
    </head>
    <body>
       <nav class="navbar bg-info border-bottom border-body sticky-top">
            <div name="BarraSuperior" style="text-align: center;" class="container-fluid">
                <div class="d-flex">
                    <a href="#" onclick="window.history.back(); return false;"><button class="btn btn-danger"><i class="fa-solid fa-arrow-left"></i></button></a>
                </div>
                <div class="d-flex">
                    <a href="../Carrito.php"><button class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i></button></a>
                </div>
            </div>
       </nav>
       <main class="contenedorPrincipal" style="display: grid; grid-template-columns: auto auto; ">
            <section class="ContenedorInfo" style="width:350px">
                <?php
                // Conexión a la base de datos
                $conn = new mysqli("localhost", "root", "", "ucabits");
                
                if ($conn->connect_error) {
                    die("Error de conexión: " . $conn->connect_error);
                }
                
                // Id perteneciente a la tienda
                $id_tienda = 4;
                
                // Consulta de tienda
                $sql_tienda = "SELECT id_tienda, nombreTienda, encargado, telefono, descripcion FROM tienda WHERE id_tienda = ?";
                $stmt_tienda = $conn->prepare($sql_tienda);
                $stmt_tienda->bind_param("i", $id_tienda);
                $stmt_tienda->execute();
                $result_tienda = $stmt_tienda->get_result();
                
                if ($result_tienda->num_rows > 0) {
                    $tienda = $result_tienda->fetch_assoc();
                    echo "<h1>" . htmlspecialchars($tienda['nombreTienda']) . "</h1>";
                    echo "<figure class='BuissnesImage' style='width:350px; height:350px;'>";
                    echo "<img src='../Images/caf1.jpg' style='width:94%; height:100%; object-fit: cover;'>";
                    echo "</figure>";
                    echo "<h3>" . htmlspecialchars($tienda['descripcion']) . "</h3>";

                    echo "<article style='display:grid; grid-template-columns: auto auto;'>";
                    echo "<div style='grid-column:1;'>";
                    echo "<h6>Encargado:</h6>";
                    echo "<p>" . htmlspecialchars($tienda['encargado']) . "</p>";
                    echo "</div>";
                    echo "<div style='grid-column:2;'>";
                    echo "<h6>Teléfono:</h6>";
                    echo "<p>" . htmlspecialchars($tienda['telefono']) . "</p>";
                    echo "</div>";
                    echo "</article>";
                } else {
    echo "<h2>No se encontraron productos</h2>";
}
                $stmt_tienda->close();
                ?>
            </section>    
            
            <section class="ContenedorItems">
                <?php
                // Consulta para productos de la tienda 1
                $sql_productos = "SELECT id_prod, nombre_prod, descrip_prod, precio 
                                  FROM productos 
                                  WHERE id_tienda = ? 
                                  ORDER BY id_prod ASC";
                $stmt_productos = $conn->prepare($sql_productos);
                $stmt_productos->bind_param("i", $id_tienda);
                $stmt_productos->execute();
                $result_productos = $stmt_productos->get_result();

                // contador para asignar imagen por índice
                $contador = 1;

                // set de imágenes
                $imagenes = [
                    1 => "chilaquilesRojos.jpg",
                    2 => "Chila.jpg",
                    3 => "enchiladas.jpg",
                    4 => "tacos.jpeg",
                    5 => "torta.jpg"
                ];
                
                if ($result_productos->num_rows > 0) {
                    while($producto = $result_productos->fetch_assoc()) {

                        // asignar imagen según el índice
                        if (isset($imagenes[$contador])) {
                            $imagen = "../Images/" . $imagenes[$contador];
                        } else {
                            $imagen = "../Images/placeholder.png";
                        }

                        echo "<div class='Item' style='display: grid; grid-template-rows:100px,20px;'>";
                        echo "<div class='FoodCard' style='display: flex;'>";
                        echo "<figure class='FoodImage' style='width:150px; height:150px;'>";
                        echo "<img src='" . $imagen . "' style='width:100%; height:100%; object-fit: cover;'>";
                        echo "</figure>";
                        echo "<div class='FoodDescription'>";
                        echo "<h2>" . htmlspecialchars($producto['nombre_prod']) . "</h2>";
                        echo "<p><i>$" . number_format($producto['precio'], 2) . "</i></p>";
                        echo "<p>" . htmlspecialchars($producto['descrip_prod']) . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "<footer class='FoodBtns' style='display:flex'>";
                        echo "<button class='button'>Ordenar</button>";
                        echo "<button class='button Mas'>+</button>";
                        echo "<p>Agregar</p>";
                        echo "<button class='button Menos'>-</button>";
                        echo "</footer>";
                        echo "</div>";

                        $contador++;
                    }
                }
                
                $stmt_productos->close();
                $conn->close();
                ?>
            </section>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/a8d9f3784b.js" crossorigin="anonymous"></script>
    </body>
</html>
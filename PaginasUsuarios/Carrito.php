<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../Login/login.html");
    exit;
}

// Procesar acciones del carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        $producto_id = $_POST['producto_id'];
        
        switch ($_POST['accion']) {
            case 'aumentar':
                foreach ($_SESSION['carrito'] as &$item) {
                    if ($item['id'] == $producto_id) {
                        $item['cantidad']++;
                        break;
                    }
                }
                break;
                
            case 'disminuir':
                foreach ($_SESSION['carrito'] as $key => &$item) {
                    if ($item['id'] == $producto_id) {
                        $item['cantidad']--;
                        if ($item['cantidad'] <= 0) {
                            unset($_SESSION['carrito'][$key]);
                        }
                        break;
                    }
                }
                break;
                
            case 'eliminar':
                foreach ($_SESSION['carrito'] as $key => $item) {
                    if ($item['id'] == $producto_id) {
                        unset($_SESSION['carrito'][$key]);
                        break;
                    }
                }
                break;
        }
        
        // Reindexar array
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
        
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Calcular totales
$subtotal = 0;
foreach ($_SESSION['carrito'] as $item) {
    $subtotal += $item['precio'] * $item['cantidad'];
}
$descuento = 0;
$total = $subtotal - $descuento;
?>

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
        <link rel="stylesheet" href="Carrito.css">
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
            </div>
       </nav>
       <main class="contenedorPrincipal" style="display: grid; grid-template-columns: auto auto; "> 
            <section class="ContenedorItems">
                <?php if (empty($_SESSION['carrito'])): ?>
                    <!-- Mostrar mensaje si el carrito está vacío -->
                    <div class="Item" style="display: grid; grid-template-rows:100px,20px; background:white; text-align: center; padding: 20px;">
                        <div class="FoodCard" style="display: flex; justify-content: center;">
                            <div class="FoodDescription">
                                <h2>Carrito Vacío</h2>
                                <p>No hay productos en el carrito</p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($_SESSION['carrito'] as $item): ?>
                    <div class="Item" style="display: grid; grid-template-rows:100px,20px; background:white;">
                        <div class="FoodCard" style="display: flex;">
                            <figure class="FoodImage"style="width:150px; height:150px;  ">
                                <img src="./Images/<?php echo strtolower(str_replace(' ', '', $item['nombre'])); ?>.jpg" style="width:100%; height:100%; object-fit: cover;" onerror="this.src='./Images/molletes.jpg'">
                            </figure>
                            <div class="FoodDescription">
                                <h2><?php echo htmlspecialchars($item['nombre']); ?></h2>
                                <p><i>$<?php echo number_format($item['precio'], 2); ?></i></p>
                                <p>Cantidad: <?php echo $item['cantidad']; ?></p>
                                <p>Subtotal: $<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></p>
                            </div>
                        </div>
                        <footer class="FoodBtns" style="display:flex">
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="producto_id" value="<?php echo $item['id']; ?>">
                                <input type="hidden" name="accion" value="aumentar">
                                <button type="submit" class="button Mas">+</button>
                            </form>
                            <p>Agregar</p>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="producto_id" value="<?php echo $item['id']; ?>">
                                <input type="hidden" name="accion" value="disminuir">
                                <button type="submit" class="button Menos">-</button>
                            </form>
                            <form method="post" style="display: inline; margin-left: 10px;">
                                <input type="hidden" name="producto_id" value="<?php echo $item['id']; ?>">
                                <input type="hidden" name="accion" value="eliminar">
                                <button type="submit" class="button" style="background: #dc3545;">Eliminar</button>
                            </form>
                        </footer>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>
            <section class="ContenedorPago" style=" width:400px">
                <article class="Precio">
                    <p>subtotal: $<?php echo number_format($subtotal, 2); ?></p>
                    <p>descuento: $<?php echo number_format($descuento, 2); ?></p>
                    <hr>
                    <h5>Total: $<?php echo number_format($total, 2); ?></h5>
                </article>
                <footer style="display:flex; padding-top:10px;">
                    <a href="pago.php" style="width: 100%;">
                        <button class="button" style="width:100%" <?php echo empty($_SESSION['carrito']) ? 'disabled' : ''; ?>>Comprar</button>
                    </a>
                </footer>
            </section>    
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/a8d9f3784b.js" crossorigin="anonymous"></script>
    </body>
</html>
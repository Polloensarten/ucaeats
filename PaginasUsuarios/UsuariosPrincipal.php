<?php
    // Iniciar la sesión (necesario en cada página que use sesiones)
        session_start();

        // Verificar si el usuario ha iniciado sesión
        if (!isset($_SESSION['name'])) {
            header("Location: ../Login/login.html"); // Redirigir al login si no ha iniciado sesión
            exit();
        }
    ?>    
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>UsuariosPrincipal</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="UsuariosPrincipal.css">
    <style>
            * {
                font-family: 'Roboto', sans-serif;
                }
                 body {
        background: url('./Images/fondo1.png') no-repeat center center fixed;
        background-size: cover;
    }
        </style>
    </head>
    <body>
       <nav class="navbar bg-info border-bottom border-body sticky-top">
            <div class="BarraSuperior" style="text-align: center;" class="container-fluid">
                <p class="navbar-brand mb-0 h1">Bienvenido <?php echo htmlspecialchars($_SESSION['name']);?></p>
                <div class="d-flex">
                    <a href="Carrito.php"><button class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i></button></a>
                </div>
            </div>
       </nav>
    <div class="div1">
            <figure class="figura1">
                <a href="NegocioRand.php" style="text-decoration:none;">
                    <img src="./Images/caf1.jpg"
                         style="width:100%; height:100%; object-fit: cover;">
                    <p style="
                        position: absolute;
                        bottom: 10px;
                        left: 0;
                        right: 0;
                        text-align: center;
                        margin: 0;
                        color: white;
                        font-weight: bold;
                        background: rgba(0,0,0,0.4);
                        padding: 5px 0;
                    ">Cafeteria_1</p>
                </a>
            </figure>

            <figure style="
                border: 1px solid black;
                border-radius: 10px;
                overflow: hidden;
                position: relative;
                height: 250px;
            ">
                <a href="NegocioRand.php" style="text-decoration:none;">
                    <img src="./Images/tacos.jpeg"
                         style="width:100%; height:100%; object-fit: cover;">
                    <p style="
                        position: absolute;
                        bottom: 10px;
                        left: 0;
                        right: 0;
                        text-align: center;
                        margin: 0;
                        color: white;
                        font-weight: bold;
                        background: rgba(0,0,0,0.4);
                        padding: 5px 0;
                    ">Cafeteria_2</p>
                </a>
            </figure>

            <figure style="
                border: 1px solid black;
                border-radius: 10px;
                overflow: hidden;
                position: relative;
                height: 250px;
            ">
                <a href="NegocioRand.php" style="text-decoration:none;">
                    <img src="./Images/carrito.jpg"
                         style="width:100%; height:100%; object-fit: cover;">
                    <p style="
                        position: absolute;
                        bottom: 10px;
                        left: 0;
                        right: 0;
                        text-align: center;
                        margin: 0;
                        color: white;
                        font-weight: bold;
                        background: rgba(0,0,0,0.4);
                        padding: 5px 0;
                    ">Carrito</p>
                </a>
            </figure>

            <figure style="
                border: 1px solid black;
                border-radius: 10px;
                overflow: hidden;
                position: relative;
                height: 250px;
            ">
                <a href="NegocioRand.php" style="text-decoration:none;">
                    <img src="./Images/torta.jpg"
                         style="width:100%; height:100%; object-fit: cover;">
                    <p style="
                        position: absolute;
                        bottom: 10px;
                        left: 0;
                        right: 0;
                        text-align: center;
                        margin: 0;
                        color: white;
                        font-weight: bold;
                        background: rgba(0,0,0,0.4);
                        padding: 5px 0;
                    ">Cafeteria_3</p>
                </a>
            </figure>

        </div>
        <dialog open id="review-dialog" class="review-card">
            <div class="bg">
                <h2>Calificanos :D</h2>
                <a href="Resenas.html"><button>Escribe tu reseña</button><a>
            </div>
            <div class="blob"></div>    
        </dialog>
        <script>
            const dialog = document.getElementById("review-dialog")
            dialog.addEventListener("click",()=> dialog.close())
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/a8d9f3784b.js" crossorigin="anonymous"></script>
    </body>
</html>
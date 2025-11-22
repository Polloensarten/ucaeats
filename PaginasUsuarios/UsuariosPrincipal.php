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
            <div name="BarraSuperior" style="text-align: center;" class="container-fluid">
                <div class="d-flex">
                    <h1 class="navbar-brand mb-0 h1">Bienvenido <?php echo htmlspecialchars($_SESSION['name']);?></h1>
                </div>
                <div class="d-flex">
                    <a href="CerrarSesion.php"><button class="btn btn-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i></button></a>
                </div>
            </div>
       </nav>
    <div class="div1">
            <figure class="figura1">
                <a href="./Negocios/Negocio1.php" style="text-decoration:none;">
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
                <a href="./Negocios/Negocio2.php" style="text-decoration:none;">
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
                <a href="./Negocios/Negocio3.php" style="text-decoration:none;">
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
                <a href="./Negocios/Negocio4.php" style="text-decoration:none;">
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
       <!-- popUp que contiene el formulario de resenas -->
        <dialog id="review-page" class="popUp-review">
            <form action="Aqui php para inserta resenas" method="post">
                <h1>Reseñas</h1>
                <!-- parte del comentario -->
                <div class="review-page-group">
                        <input placeholder="" type="text" required="" disabled>
                        <label for="name"><?php echo htmlspecialchars($_SESSION['name']);?></label>
                </div>
                <!-- Estrellas de calificacion -->
                 <h6>calificacion</h6>
                <div class="calificacion">
                    <fieldset>
                        <input type="radio" id="star1" value="1" name="rating">
                        <label for="star1"><i class="fa-solid fa-star"></i></label>
                        <input type="radio" id="star2" value="2" name="rating">
                        <label for="star2"><i class="fa-solid fa-star"></i></label>
                        <input type="radio" id="star3" value="3" name="rating">
                        <label for="star3"><i class="fa-solid fa-star"></i></label>
                        <input type="radio" id="star4" value="4" name="rating">
                        <label for="star4"><i class="fa-solid fa-star"></i></label>
                        <input type="radio" id="star5" value="5" name="rating">
                        <label for="star5"><i class="fa-solid fa-star"></i></label>
                    </fieldset>
                </div>    
                <div class="review-page-group">
                    <textarea placeholder="" id="comment" name="comment" rows="5" required></textarea>
                    <label for="comment">Comentario</label>
                </div>
                
                <!-- Boton para enviar -->
                <button type="submit" method="post" action="">Enviar</button>
            </form>
        </dialog>
        <!-- Primer popUp -->
        <dialog id="review-dialog" class="review-card">
            <div class="bg">
                <h2>Calificanos :D</h2>
                <button onclick="abrirsegundo()">Escribe tu reseña</button>
            </div>
            <div class="blob"></div>    
        </dialog>
       
        
        <!-- script para abrir el popUp -->
        <script>
            function abrirsegundo() {
                const segundoDialogo = document.getElementById("review-page")
                //para mostrar el popup al clickear en el boton
                segundoDialogo.showModal()
                //esta parte cierra el popup si se hace click fuera de el
                segundoDialogo.addEventListener("click", e => {
                    const dialogDimensions = segundoDialogo.getBoundingClientRect()
                    if (
                        e.clientX < dialogDimensions.left ||
                        e.clientX > dialogDimensions.right ||
                        e.clientY < dialogDimensions.top ||
                        e.clientY > dialogDimensions.bottom
                    ) {
                        segundoDialogo.close()
                    }
                })
            }

        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/a8d9f3784b.js" crossorigin="anonymous"></script>
    </body>
</html>
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
                    <a href="NegocioRand.php"><button class="btn btn-danger"><i class="fa-solid fa-arrow-left"></i></button></a>
                </div>
            </div>
       </nav>
       <main class="contenedorPrincipal" style="display: grid; grid-template-columns: auto auto; "> 
            <section class="ContenedorItems">
                <div class="Item" style="display: grid; grid-template-rows:100px,20px; background:white;">
                    <div class="FoodCard" style="display: flex;">
                        <figure class="FoodImage"style="width:150px; height:150px;  ">
                            <img src="./Images/molletes.jpg" style="width:100%; height:100%; object-fit: cover;">
                        </figure>
                        <div class="FoodDescription">
                            <h2>Molletes</h2>
                            <p><i>$25.80</i></p>
                            <p>Molletes con chorizo</p>
                        </div>
                        
                    </div>
                    <footer class="FoodBtns" style="display:flex">
                       <button class="button">Ordenar</button>
    <button class="button Mas">+</button>
    <p>Agregar</p>
    <button class="button Menos">-</button>
                    </footer>
                </div>
                <div class="Item" style="display: grid; grid-template-rows:100px,20px; background:white;">
                    <div class="FoodCard" style="display: flex;">
                        <figure class="FoodImage"style="width:150px; height:150px;  ">
                            <img src="./Images/guajolota.jpg" style="width:100%; height:100%; object-fit: cover;">
                        </figure>
                        <div class="FoodDescription">
                            <h2>Guajolota</h2>
                            <p><i>$25.80</i></p>
                            <p>Torta de tamal verde, rojo o de rajas</p>
                        </div>
                        
                    </div>
                    <footer class="FoodBtns" style="display:flex">
                        <button class="button">Ordenar</button>
    <button class="button Mas">+</button>
    <p>Agregar</p>
    <button class="button Menos">-</button>
                    </footer>
                </div>
                <div class="Item" style="display: grid; grid-template-rows:100px,20px; background:white;">
                    <div class="FoodCard" style="display: flex;">
                        <figure class="FoodImage"style="width:150px; height:150px;  ">
                            <img src="./Images/chilaquilesRojos.jpg" style="width:100%; height:100%; object-fit: cover;">
                        </figure>
                        <div class="FoodDescription">
                            <h2>Chilaquiles Rojos</h2>
                            <p><i>$25.80</i></p>
                            <p>Chilaquiles rojos con crema, queso y pollo</p>
                        </div>
                        
                    </div>
                    <footer class="FoodBtns" style="display:flex">
                        <button class="button">Ordenar</button>
    <button class="button Mas">+</button>
    <p>Agregar</p>
    <button class="button Menos">-</button>

                    </footer>
                </div>
                <div class="Item" style="display: grid; grid-template-rows:100px,20px; background:white;">
                    <div class="FoodCard" style="display: flex;">
                        <figure class="FoodImage"style="width:150px; height:150px;  ">
                            <img src="./Images/enchiladas.jpg" style="width:100%; height:100%; object-fit: cover;">
                        </figure>
                        <div class="FoodDescription">
                            <h2>Enchiladas verdes</h2>
                            <p><i>$25.80</i></p>
                            <p>Unas clasicas enchiladas verdes, con pollo, queso rallado y crema</p>
                        </div>
                        
                    </div>
                  <footer class="FoodBtns" style="display:flex">
                        <button class="button">Ordenar</button>
    <button class="button Mas">+</button>
    <p>Agregar</p>
    <button class="button Menos">-</button>
                   </footer>
                </div>
                <div class="Item" style="display: grid; grid-template-rows:100px,20px; background:white;">
                    <div class="FoodCard" style="display: flex;">
                        <figure class="FoodImage"style="width:150px; height:150px;  ">
                            <img src="./Images/sincronizada.jpeg" style="width:100%; height:100%; object-fit: cover;">
                        </figure>
                        <div class="FoodDescription">
                            <h2>Sincronizadas</h2>
                            <p><i>$25.80</i></p>
                            <p>Tortilla de harina con queso oaxaca y jamon de pavo</p>
                        </div>
                        
                    </div>
                   <footer class="FoodBtns" style="display:flex">
<button class="button">Ordenar</button>
    <button class="button Mas">+</button>
    <p>Agregar</p>
    <button class="button Menos">-</button>

                    </footer>   
                </div>
                  
            </section>
            <section class="ContenedorPago" style=" width:400px">
                <article class="Precio">
                    <p>subtotal:</p>
                    <p>descuento:</p>
                    <hr>
                    <h5>Total:</h5>
                </article>
                <footer style="display:flex; padding-top:10px;">
                <button class="button" style="width:100%">Comprar</button>
                </footer>
            </section>    
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/a8d9f3784b.js" crossorigin="anonymous"></script>
    </body>
</html>
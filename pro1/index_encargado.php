<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal - encargado</title>
</head>



<?php
session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location: login.php");
    exit();
}
if ($_SESSION['nivel'] > 2) {

    header("Location: login.php");
    exit();
}

?>


<style>
    * {
        margin: 0px;
        font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
    }


    .encabezado {
        background-color: rgb(11, 96, 56);
        color: whitesmoke;
        padding: 20px;
        font-size: 2.5rem;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .info {
        background-color: rgb(11, 123, 71);
        display: flex;
        justify-content: flex-end;
        z-index: 2000;
        box-sizing: border-box;
        padding: 10px 10px;


    }

    .izq {
        display: flex;
        justify-content: end;

    }

    .circulo {
        margin-left: 15px;
        width: 45px;
        height: 45px;
        background-color: beige;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }


    .centrar {
        padding-top: 30px;
        padding-bottom: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-image: url('./iconos/backgroud-imagen.png');
        background-size: 200px;
        min-height: 70vh;
        position: relative;
    }

    .principal {
        display: flex;
        flex-wrap: wrap;

        justify-content: center;

        position: relative;
        font-size: 24px;
        width: 90%;
        height: auto;

        gap: 50px;
    }

    .cajas {


        flex: 1 1 250px;

        max-width: 300px;

        height: 250px;

        border: 10px solid rgb(11, 96, 56);
        background-color: rgb(246, 246, 193);
        border-radius: 30px;
        transition: transform 0.4s ease;
        box-shadow: -6px 6px 10px 0px rgba(11, 96, 56, 0.449);


    }

    .cajas:hover {
        transform: scale(1.04);
        cursor: pointer;

    }

    .div-ref {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;


    }

    .div-ref img {
        opacity: 0.3;
    }

    .foot {
        position: sticky;
        right: 0px;
        bottom: 0px;
        width: 100%;
        background-color: rgb(11, 96, 56);
        display: flex;
        height: 45px;
        align-items: center;
        padding-left: 20px;
        font-size: 24px;
        color: beige;

    }

    .menu_button {
        color: #fffacf;
        font-size: 18px;
        position: absolute;
        z-index: 2001;
        top: 105px;
        right: 95vw;
        left: 20px;
        min-width: 120px;
        min-height: 40px;
        background-color: rgba(16, 74, 45, 0.49);


        border-radius: 20px;
        border: none;
        transition: top 0.3s ease;

    }

    .menu_button.abierto {

        top: 20px;


    }


    .menu {
        position: fixed;
        top: 0px;
        left: -250px;
        width: 250px;
        height: 100%;
        background-color: #13a35b;
        padding-top: 70px;
        transition: left 0.3s ease;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3);
        z-index: 1000;
    }

    .menu ul {
        list-style-type: none;
        padding: 0;
    }

    .menu ul li {
        padding: 15px 20px;
    }

    .menu ul li a {
        color: #fffacf;
        text-decoration: none;
        font-size: 18px;
    }

    .menu.abierto {
        left: 0;
    }
</style>

<body>

    <div class="encabezado">
        Cafeteria
    </div>


    <nav id="menu-lateral" class="menu">
        <ul>
            <li><a href="index_encargado.php">Inicio Encargado</a></li>
            <li><a href="index_comida.php">Inicio</a></li>
            <li><a href="config_cuenta.php">Cuenta</a></li>
            <li><a href="#">Configuracion</a></li>
            <li><a href="#">Estadisticas</a></li>
            <li><a href="log_out.php">Salir</a></li>
        </ul>
    </nav>


    <header>
        <button id="btn-menu" class="menu_button">☰ Menu</button>
        <div class="info">
            <div class="izq">



                <a href="carrito.php">
                    <div class="circulo">
                        <img src="./iconos/carrito.png" alt="Carrito" width="25px">
                    </div>
                </a>
                <a href="config_cuenta.php">
                    <div class="circulo">
                        <img src="./iconos/usuario.png" alt="Usuario" width="25px">
                    </div>
                </a>
            </div>
        </div>


        <script>
            const btnMenu = document.getElementById('btn-menu');
            const menu = document.getElementById('menu-lateral');
            const boton_del_menu = document.getElementById('btn-menu');
            btnMenu.addEventListener('click', () => {
                menu.classList.toggle('abierto');
                boton_del_menu.classList.toggle('abierto');
            });
        </script>


    </header>


    <div class="centrar">
        <div class="principal">

            <div class="cajas">
                <a href="FrmComida.php">

                    <div class="div-ref">
                        <img src="./iconos/Bandeja.png" alt="" height="200px">
                    </div>
                </a>

            </div>


            <div class="cajas">
                <a href="FrmBebidas.php">
                    <div class="div-ref">
                        <img src="./iconos/bebidas.png" height="200px">
                    </div>
                </a>

            </div>


            <div class="cajas">
                <a href="Pedidos.php">

                    <div class="div-ref">
                        <img src="./iconos/pedidos.png" height="180px">
                    </div>
                </a>

            </div>
        </div>
    </div>


    <footer class="foot">
        Derechos reservados &copy; ; Duodecimo Informatica
    </footer>

</body>

</html>
<!DOCTYPE html>
<html lang="es">

<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] > 3) {
    header("Location: login.php");
    exit();
}
?>




<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Principal</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #0d745b;
            background-image: url('./iconos/backgroud-imagen.png');
            background-size: 200px;
            color: #333;
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

        .izq {
            display: flex;
            gap: 15px;
            margin-right: 10px;
        }

        .circulo {
            width: 45px;
            height: 45px;
            background-color: beige;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .info {
            background-color: rgb(11, 123, 71);
            display: flex;
            justify-content: flex-end;

            box-sizing: border-box;
            padding: 10px 10px;

        }



        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            padding: 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .card h3 {
            font-size: 1.3rem;
            color: #0b604b;
            margin-bottom: 5px;
        }

        .card p {
            font-size: 0.95rem;
            margin-bottom: 10px;
            color: #555;
        }

        .card span {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #0b604b;
        }

        .card button {
            background-color: #0b604b;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        .card button:hover {
            background-color: #0d745b;
        }

        footer.foot {
            position: sticky;
            right: 0px;
            bottom: 0px;
            width: 100%;
            background-color: rgb(11, 96, 56);
            color: beige;
            text-align: center;
            padding: 15px;
            font-size: 0.95rem;

        }

        .selecion {

            font-weight: 550;
            margin-top: 20px;
            width: 100%;
            display: flex;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;

        }

        .seleccion-div {
            display: flex;
            justify-content: center;

            background-color: rgba(11, 96, 56, 0.17);
            border-radius: 20px;
            backdrop-filter: blur(1px);
        }

        .Opcion {
            width: 120px;
            text-align: center;
            color: beige;
            margin: 20px 10px 20px 10px;
            padding: 10px 15px 10px 15px;
            background-color: #0b604b;
            border-radius: 40px;
            text-decoration: none;
        }

        .Opcion:first-child {
            background-color: rgba(65, 110, 99, 0.29);
            color: rgba(0, 0, 0, 0.44);
        }

        .menu_button {
            color: #fffacf;
            font-size: 18px;
            position: absolute;
            z-index: 2001;
            top: 100px;
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


</head>

<body>

    <div class="encabezado">
        Cafeteria
    </div>


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
    </header>

    <nav id="menu-lateral" class="menu">
        <ul>
            <?php
            if ($_SESSION['nivel'] < 3) : ?>
                <li><a href="index_encargado.php">Incio encargado</a></li>
            <?php endif; ?>
            <li><a href="index_comida.php">Inicio</a></li>
            <li><a href="config_cuenta.php">Cuenta</a></li>
            <li><a href="#">Configuracion</a></li>
            <?php
            if ($_SESSION['nivel'] < 3) : ?>
                <li><a href="#">Estadisticas</a></li>
            <?php endif; ?>

            <li><a href="log_out.php">Salir</a></li>
        </ul>
    </nav>

    <script>
        const btnMenu = document.getElementById('btn-menu');
        const menu = document.getElementById('menu-lateral');
        const boton_del_menu = document.getElementById('btn-menu');
        btnMenu.addEventListener('click', () => {
            menu.classList.toggle('abierto');
            boton_del_menu.classList.toggle('abierto');
        });
    </script>

    <div class="selecion">
        <div class="seleccion-div">
            <a href="index_comida.php" class="Opcion">
                Comida
            </a>
            <a href="index_Bebidas.php" class="Opcion">
                Bebidas
            </a>
        </div>
    </div>


    <div class="menu-grid">
        <?php
        $menu = [
            ["nombre" => "Coca - Cola", "precio" => 22, "imagen" => "./img_pruebas/coca_cola.jpg", "descripcion" => "Resfrecante coca-cola"],
            ["nombre" => "Agua", "precio" => 30, "imagen" => "./img_pruebas/agua.jpg", "descripcion" => "Agua 255ml"],
            ["nombre" => "Horchata", "precio" => 25, "imagen" => "./img_pruebas/horchata.jpg", "descripcion" => "Deliciosa bebida Natural"],
            ["nombre" => "Sprite", "precio" => 22, "imagen" => "./img_pruebas/sprite.jpg", "descripcion" => "Resfrescante sprite sabor lima"],
            ["nombre" => "Agua", "precio" => 30, "imagen" => "./img_pruebas/agua.jpg", "descripcion" => "Agua 255ml"],
            ["nombre" => "Agua", "precio" => 30, "imagen" => "./img_pruebas/agua.jpg", "descripcion" => "Agua 255ml"],
            ["nombre" => "Agua", "precio" => 30, "imagen" => "./img_pruebas/agua.jpg", "descripcion" => "Agua 255ml"],
            ["nombre" => "Agua", "precio" => 30, "imagen" => "./img_pruebas/agua.jpg", "descripcion" => "Agua 255ml"],
        ];

        foreach ($menu as $item): ?>
            <div class="card">
                <img src="<?= $item['imagen'] ?>" alt="<?= $item['nombre'] ?>">
                <h3><?= $item['nombre'] ?></h3>
                <p><?= $item['descripcion'] ?></p>
                <span>Lps <?= $item['precio'] ?></span>
                <button>¡Pedir!</button>
            </div>
        <?php endforeach; ?>
    </div>

    <footer class="foot">
        Derechos reservados &copy; Duodécimo Informática
    </footer>
</body>

</html>
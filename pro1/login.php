<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }







    body {
      background-color: #e8f5f0;
      background-image: url('./iconos/backgroud-imagen.png');
      background-repeat: repeat;
      background-size: 200px;
      font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .contenedor {
      background: rgba(255, 255, 255, 0.23);
      border-radius: 12px;
      padding: 40px 30px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      text-align: center;
      backdrop-filter: blur(2px);
    }

    .contenedor h1 {
      color: rgba(1, 76, 47, 0.87);
      font-size: 38px;
      margin-bottom: 30px;
    }

    .box {
      margin-bottom: 20px;
      text-align: left;
    }

    .box input {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border: 1px solid #a0d3bf;
      border-radius: 8px;
      background-color: #f2fcf9;
      color: #333;
      transition: border-color 0.3s ease;
    }

    button {
      width: 100%;
      height: 45px;
      background-color: #014c2f;
      color: #fffacf;
      border: none;
      border-radius: 8px;
      font-size: 18px;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #013822;
      cursor: pointer;
    }

    .box input:focus {
      border-color: #007bff;

      outline: none;

    }
  </style>
</head>

<body>
  <div class="contenedor">
    <form class="form" action="conexion.php" method="post">
      <h1>Login</h1>
      <div class="box">
        <input type="text" placeholder="Usuario" id="nombre_usuario" name="nombre_usuario" autocomplete="off" required />
      </div>
      <div class="box">
        <input type="password" placeholder="Contraseña" id="contraseña" name="contraseña" required />
      </div>
      <button type="submit">Iniciar sesión</button>
    </form>
  </div>
</body>

</html>
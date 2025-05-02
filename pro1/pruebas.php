<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $filename = $_FILES["imagen"]["name"];
    $filetype = $_FILES["imagen"]["type"];
    $filesize = $_FILES["imagen"]["size"];

    // Verificar la extensión del archivo
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!array_key_exists($ext, $allowed)) {
      $mensaje = "Error: Formato de archivo no válido.";
    }

    // Verificar el tipo MIME del archivo
    if (!in_array($filetype, $allowed)) {
      $mensaje = "Error: Tipo de archivo no válido.";
    }

    // Verificar el tamaño del archivo (ejemplo: 5MB)
    $maxsize = 5 * 1024 * 1024;
    if ($filesize > $maxsize) {
      $mensaje = "Error: El tamaño del archivo excede el límite.";
    }

    // Si no hay errores, intentar subir el archivo
    if (!isset($mensaje)) {
      $nombre_base = pathinfo($filename, PATHINFO_FILENAME);
      $nombre_unico = $nombre_base . "_" . uniqid() . "." . $ext; // Generar un nombre único
      $ruta_destino = "uploads/" . $nombre_unico; // Carpeta donde se guardarán las imágenes

      if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_destino)) {
        // La imagen se subió correctamente
        $url_imagen = $ruta_destino; // URL que guardarás en la base de datos
        $nombre_producto = $_POST["nombre"];

        // Aquí guardarías $nombre_producto y $url_imagen en tu base de datos
        // Ejemplo (debes adaptar a tu estructura de base de datos):
        $servername = "localhost";
        $username = "tu_usuario_db";
        $password = "tu_contraseña_db";
        $dbname = "tu_nombre_db";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
          die("Conexión fallida: " . $conn->connect_error);
        }

        $sql = "INSERT INTO productos (nombre, url_imagen) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nombre_producto, $url_imagen);

        if ($stmt->execute()) {
          $mensaje = "Producto guardado con imagen.";
        } else {
          $mensaje = "Error al guardar el producto: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
      } else {
        $mensaje = "Error al subir el archivo.";
      }
    }
  } else {
    $mensaje = "Error: No se ha seleccionado ningún archivo o hubo un error en la subida.";
  }

  // Puedes redirigir al usuario o mostrar un mensaje
  echo $mensaje;
  // header("Location: pagina_de_exito.php?mensaje=" . urlencode($mensaje));
  exit();
}

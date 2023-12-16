<?php


include '../DAL/conexion.php';

// Llamada a la función
$conn = Conecta();


// Configuración de conexión a la base de datos (conexion.php)

// Crear
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_create"])) {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $img = $_POST["img"];
    $precio = $_POST["precio"];
    $id_categoria = $_POST["id_categoria"];

    $sql = "INSERT INTO productos (nombre, descripcion, img, precio, id_categoria) VALUES ('$nombre', '$descripcion', '$img', $precio, $id_categoria)";

    if ($conn->query($sql) === TRUE) {
        $mensaje ="Producto creado con éxito";
        header("Location: ../productos.php?mensaje=" . urlencode($mensaje));
    } else {
        echo "Error al crear el producto: " . $conn->error;
    }
}

// Actualizar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_update"])) {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $img = $_POST["img"];
    $precio = $_POST["precio"];
    $id_categoria = $_POST["id_categoria"];

    $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', img='$img', precio=$precio, id_categoria=$id_categoria WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $mensaje ="Producto actualizado con éxito";
        header("Location: ../productos.php?mensaje=" . urlencode($mensaje));
    } else {
        echo "Error al actualizar el producto: " . $conn->error;
    }
}

// Borrar
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $conn->query("DELETE FROM productos WHERE id=$id");
    $mensaje ="Producto eliminado con éxito..";
    header("Location: ../productos.php?mensaje=" . urlencode($mensaje));
 
}

// Cerrar conexión
$conn->close();
?>

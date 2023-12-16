<?php


include '../DAL/conexion.php';

// Llamada a la función
$conn = Conecta();




// Configuración de conexión a la base de datos (sección 1)

// Crear
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_create"])) {
    $nombre_categoria = $_POST["nombre_categoria"];

    $sql = "INSERT INTO categorias (nombre_categoria) VALUES ('$nombre_categoria')";

    if ($conn->query($sql) === TRUE) {
    
        $mensaje ="Categoría creada con éxito.";
        header("Location: ../categorias.php?mensaje=" . urlencode($mensaje));
    } else {
        echo "Error al crear la categoría: " . $conn->error;
    }
}

// Actualizar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_update"])) {
    $id_categoria = $_POST["id_categoria"];
    $nombre_categoria = $_POST["nombre_categoria"];

    $sql = "UPDATE categorias SET nombre_categoria='$nombre_categoria' WHERE id_categoria=$id_categoria";

    if ($conn->query($sql) === TRUE) {
        $mensaje ="Categoría actualizada con éxito.";
        header("Location: ../categorias.php?mensaje=" . urlencode($mensaje));
    } else {
        echo "Error al actualizar la categoría: " . $conn->error;
    }
}

// Borrar
if (isset($_GET["delete"])) {
    $id_categoria = $_GET["delete"];
    $conn->query("DELETE FROM categorias WHERE id_categoria=$id_categoria");
    $mensaje ="Categoría eliminada con éxito.";
    header("Location: ../categorias.php?mensaje=" . urlencode($mensaje));
}

// Cerrar conexión
$conn->close();
?>

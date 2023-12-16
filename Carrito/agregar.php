<?php
include '../DAL/conexion.php';
// Llamada a la función
$conn = Conecta();

session_start();

// Verificar si se ha proporcionado un ID de producto válido
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $producto_id = $_POST['id'];

    // Obtener el producto por su ID (asumiendo que tienes una función obtenerProductoPorId)
    $producto = obtenerProductoPorId($producto_id);

    if ($producto) {
        // Añadir el producto al carrito
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Verificar si el producto ya está en el carrito
        $producto_en_carrito = false;
        foreach ($_SESSION['carrito'] as &$item) {
            if ($item['id'] == $producto_id) {
                 // Se le suma otro mas al carrito del mismo producto
                $item['cantidad']++;
                $producto_en_carrito = true;
                break;
            }
        }

        if (!$producto_en_carrito) {
            // Agregar el producto al carrito en 1 si aun no se ha agregado
            $producto['cantidad'] = 1;
            $_SESSION['carrito'][] = $producto;
        }

        // Mostrar el carrito actualizado
        include 'mostrar_carrito.php';
    }
}

function obtenerProductoPorId($id)
{
    return ['id' => $id];
}
?>




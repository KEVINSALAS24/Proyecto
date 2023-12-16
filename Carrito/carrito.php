<?php

include '../DAL/conexion.php';
include '../DAL/session.php';

// Llamada a la función
$conn = Conecta();



function obtenerContenidoDelCarrito()
{


    // Verificar si el carrito está vacío
    if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
        return [];
    }

    // Obtener el contenido del carrito
    $contenidoCarrito = [];
    foreach ($_SESSION['carrito'] as $item) {
        $producto = obtenerProductoPorId($item['id'],$item['producto_id'] );
        if ($producto) {
            $producto['cantidad'] = $item['cantidad'];
            $contenidoCarrito[] = $producto;
        }

        
    }

    return $contenidoCarrito;
}


function obtenerUltimaTransaccion()
{
    // Aquí puedes realizar una consulta a la base de datos
    // para obtener la última transacción almacenada.

    // Por ahora, devolvemos un array de ejemplo.
    $transaccion = [
        'id' => 1,
        'total' => 50.00,
        'fecha' => '2023-01-01 12:00:00', // Puedes ajustar el formato según tus necesidades
        // Otros campos de la transacción si es necesario
    ];

    return $transaccion;
}



function calcularTotalDelCarrito()
{
    // Obtener el contenido del carrito
    $contenidoCarrito = obtenerContenidoDelCarrito();

    // Calcular el total del carrito
    $total = 0;
    foreach ($contenidoCarrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }

    return $total;
}

function pagar()
{  
    
  
    header("Location: ../Proyecto/factura.php");
    
    
}

// Cerrar conexión
$conn->close();
?>

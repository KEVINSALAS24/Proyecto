<?php
include 'DAL/conexion.php';
include 'DAL/session.php';

// Llamada a la función
$conn = Conecta();

// Obtener el nombre de usuario de la sesión
$nombreUsuario = $_SESSION['usuario'];

// Recuperar el mensaje de la URL

unset($_SESSION['carrito']);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Categorías</title>
</head>

<body>



    <?php include 'plantillas/plantilla.html'; ?>

    <br>
    <br>

    <div class='container'>
        <div class="card text-center">
            <div class="card-header">
                Factura
            </div>
            <div class="card-body">
                <h5 class="card-title">Compra existosa</h5>
                <p class="card-text">Gracias por comprar en AtomicTech, disfrute su producto.</p>
                <a href="../Proyecto/tienda.php" class="btn btn-danger">Volver a la tienda</a>
            </div>

        </div>
    </div>




</body>
<br>
<br>
<br>
<br>

<?php include 'plantillas/footer.html'; ?>
</html>
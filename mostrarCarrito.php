<?php

include 'DAL/conexion.php';
include 'DAL/session.php';


// Llamada a la función
$conn = Conecta();
$total = 0;

// Obtener el nombre de usuario de la sesión
$nombreUsuario = $_SESSION['usuario'];


if (isset($_GET['accion']) && $_GET['accion'] == 'llamarFuncion') {
    include 'Carrito/carrito.php';
    pagar();
    exit;
}
?>





<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
</head>

<body>
    <!-- Barra de navegacion -->
    <?php include 'plantillas/plantilla.html'; ?>



    <div class="container px-3 my-5 clearfix">
        <!-- TABLE  -->
        <div class="card bg-dark text-white">
            <div class="card-header ">
                <h2>Carrito</h2>
            </div>
            <div class="card-body ">
                <div class="table-responsive ">
                    <table class=" table-dark table table-bordered m-0">
                        <thead>
                            <tr>
                                <!-- Columns -->
                                <th class="text-center py-3 px-4" style="min-width: 300px;">Detalle del producto</th>
                                <th class="text-right " style="width: 120px;">Precio</th>
                                <th class="text-center py-3 px-4" style="width: 110px;">Cantidad</th>
                                <th class="text-right py-3 px-4" style="width: 150px;">Total</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Mostrar el contenido del carrito en sesion
                            if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {

                                //Se recorren los id de productos en carrito 
                                foreach ($_SESSION['carrito'] as $item) {
                                    //  buscamos el producto como tal para imprimirlo
                                    $sql = 'SELECT * FROM productos where id =' . $item['id'];
                                    $result = $conn->query($sql);

                                    ?>

                                    <?php

                                    while ($row = $result->fetch_assoc()) {
                                        //Se cagar los productos en el carrito
                                        echo '<tr>
                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <img  src="' . $row['img'] . '" style="width:10rem; height:8rem;" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                                                <div class="media-body">
                                                        <p href=" " class="d-block text-white">' . $row['nombre'] . '</p> 
                                                        <p href=" " class="d-block text-white">' . $row['descripcion'] . '</p> 
                                                </div>
                                            
                                            </div>
                                        </td>
                                        <td class="text-right font-weight-semibold align-middle ">₡ ' . $row['precio'] . '</td>
                                        <td class="align-middle p-4"><input type="text" class="form-control text-center"
                                        value=' . $item['cantidad'] . '></td>
                                        <td class="text-right font-weight-semibold align-middle p-4">₡ ' . $row['precio'] * $item['cantidad'] . '</td>
                                       
                                        </tr>';
                                        $total = $total + $row['precio'] * $item['cantidad'];
                                    }
                                } ?>

                            </tbody>

                        <?php } else {
                                echo "
                                <tr>
                                    <td colspan='4'> No hay productos en el carrito</td>
                                </tr>
                          
                        ";
                            }
                            ?>
                       
                        </tbody>
                    </table>
                </div>
                <!-- / fin de la tabla -->

                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">

                    <div class="d-flex">

                        <div class="text-right mt-4">
                            <h3 class=" font-weight-normal text-white m-0">Total a pagar <strong>₡
                                    <?php echo ($total) ?>
                                </strong></h3>

                        </div>
                    </div>
                </div>

                <div class="float-right">

                    <a class="btn btn-lg btn-light md-btn-flat  text-dark mt-2 mr-3" aria-current="page"
                        href="tienda.php">Seguir comprando</a>
                 
                    <a class='btn btn-lg btn-danger mt-2' href="mostrarCarrito.php?accion=llamarFuncion">Pagar</a>
                </div>

            </div>
        </div>
    </div>


    <?php include 'plantillas/footer.html'; ?>
</body>

</html>
<?php
include 'DAL/conexion.php';
include 'DAL/session.php';

// Llamada a la función
$conn = Conecta();


// Obtener el nombre de usuario de la sesión
$nombreUsuario = $_SESSION['usuario'];

// Recuperar el mensaje de la URL
$mensaje = isset($_GET['mensaje']) ? urldecode($_GET['mensaje']) : '';
?>


<!DOCTYPE html>
<html lang="es">

<head>


    <meta charset="UTF-8">
    <title>Productos</title>
</head>

<body>



    <?php include 'plantillas/plantilla.html'; ?>
    <div class='container'>
        <?php

        if (!empty($mensaje)) {

            echo '<br><div  class=" alert alert-success" role="alert">'
                . $mensaje .
                ' </div>';
        }
        ?>
        <br>
        <h2> Productos</h2>

        <!-- Formulario para Crear -->

        <div style="display: flex; justify-content: end;">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Agregar Producto
            </button>
        </div>

        <?php include 'Productos/agregar.php'; ?>

        <!-- Lista de Categorías -->
        <hr>

        <br>
        <br>
        <h3>Listado de Productos</h3>
    </div>
    <?php
    $sql = "SELECT * FROM productos";
    $result = $conn->query($sql);

    echo " 
    <div class='container '>
        <table class='table table-dark table-striped table-hover table-bordered table-responsive'>
            <thead>
                <tr>
                    <th >Id</th>
                    <th >Nombre</th>
                    <th >Descripción</th>
                    <th style='width:10rem' >Imagen</th>
                    <th >Precio</th>
                    <th >Categoria</th>
                    <th style='width:15rem'>Acciones</th>
                </tr>
            </thead>
            <tbody>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            echo "
                <tr>
                    <td style='width:6rem'>SKU-" . $row["id"] . "</td>
                    <td>" . $row["nombre"] . "</td>
                    <td>" . $row["descripcion"] . "</td>
                    <td>" . $row["img"] . "</td>
                    <td>" . $row["precio"] . "</td>
                    <td>" . $row["id_categoria"] . "</td>
                    <td>
                    <a class='btn btn-warning' href='javascript:void(0);' onclick='cargarModalEditar(" . $row["id"] . ")'>Editar</a>
                    <a class='btn btn-danger'href='Productos/crud.php?delete=" . $row["id"] . "'>Eliminar</a>
                    </td>
                </tr>                
            ";
        }
        echo
            "</tbody>
        </table>
    </div>";
    } else {
        echo "
                <tr>
                    <td colspan='7'> No hay productos</td>
                </tr>
             </tbody>
        </table>
    </div>";
    }

    ?>




</body>

</html>





<!-- Modal para agregar -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  ">
        <div style="background-color: black;" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="Productos/crud.php" method="post">

                    <div class="form-group">
                        <label class="control-label">Nombre del Producto</label>
                        <div>
                            <input placeholder="Nombre" required type="text" name="nombre"
                                class="form-control input-lg">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Descripción</label>
                        <div>
                            <input placeholder="Descripción" type="text" name="descripcion" required
                                class="form-control input-lg">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">URL de la Imagen</label>
                        <div>
                            <input placeholder="Imangen" type="text" name="img" required class="form-control input-lg">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Precio</label>
                        <div>
                            <input placeholder="Precio" type="number" name="precio" required
                                class="form-control input-lg">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">ID de la Categoría</label>
                        <div>
                            <input placeholder="Categoría" type="number" name="id_categoria" required
                                class="form-control input-lg">
                        </div>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button class="btn btn-success" type="submit" name="submit_create">Crear Producto</button>
            </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal para editar -->
<div class="modal fade" id="editarProductoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  ">
        <div style="background-color: black;" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <?php include 'Productos/editar.php'; ?>
            </div>


        </div>
    </div>
</div>

<script>
    // Función para cargar el contenido del modal con la información del producto
    function cargarModalEditar(idProducto) {

        // Utiliza AJAX para cargar el contenido del formulario de edición en el modal
        $.ajax({
            type: 'GET',
            url: 'Productos/editar.php?edit=' + idProducto,
            success: function (data) {
                $('#editarProductoModal .modal-content').html(data);
                $('#editarProductoModal').modal('show');
            }

        });

    }
</script>
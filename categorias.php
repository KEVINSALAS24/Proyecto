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
    <title>Categorías</title>
</head>

<body>

 

    <?php include 'plantillas/plantilla.html'; ?>
    <div class='container'>
    <?php
     
    if (!empty($mensaje)) {
       
        echo  '<br><div  class=" alert alert-success" role="alert">'
            . $mensaje .
            ' </div>';
    }
    ?>
        <br>
        <h2> Nueva Categoría</h2>

        <!-- Formulario para Crear -->
        <form action="Categorias/crud.php" method="post">
            <label for="nombre_categoria">Nombre :</label>
            <input type="text" name="nombre_categoria" required>
            <button type="submit" name="submit_create" class="btn btn-sm btn-success">Nueva Categoría</button>
        </form>

        <!-- Lista de Categorías -->
        <hr>
       
        <br>
        <br>
        <h3>Listado de Categorías</h3>
    </div>
    <?php
    $sql = "SELECT * FROM categorias";
    $result = $conn->query($sql);

    echo " 
    <div class='container'>
        <table class='table table-dark table-striped table-hover table-bordered'>
            <thead>
                <tr>
                    <th scope='col '>Id</th>
                    <th scope='col'>Nombre</th>
                    <th scope='col'>Acciones</th>
                </tr>
            </thead>
            <tbody>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {


            echo "
                <tr>
                    <td style='width:6rem'>CAT-" . $row["id_categoria"] . "</td>
                    <td>" . $row["nombre_categoria"] . "</td>
                    <td style='width:15rem'>
                    <a class='btn btn-warning' href='categorias.php?edit=" . $row["id_categoria"] . "'>Editar</a>
                    <a class='btn btn-danger'href='Categorias/crud.php?delete=" . $row["id_categoria"] . "'>Eliminar</a>
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
                    <td colspan='3'> No hay categorias</td>
                </tr>
             </tbody>
        </table>
    </div>";
    }

    ?>




</body>

</html>
<?php
$server = "localhost";
$user = "root";
$password = "";
$dataBase = "tienda";

//1. Establecer la conexión
$conn = mysqli_connect($server, $user, $password, $dataBase);

if (isset($_GET["edit"])) {
    $id = $_GET["edit"];
    $result = $conn->query("SELECT * FROM productos WHERE id=$id");

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        ?>

        <?php
        if (isset($_GET["edit"])) {
            $id = $_GET["edit"];
            $result = $conn->query("SELECT * FROM productos WHERE id=$id");

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                ?>

                <div class="container">
                    <form action="Productos/crud.php" method="post">

                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                        <div class="form-group">
                            <label class="control-label">Nombre del Producto</label>
                            <div>
                                <input placeholder="Nombre" required type="text" name="nombre" value="<?php echo $row['nombre']; ?>"
                                    class="form-control input-lg">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Descripción</label>
                            <div>
                                <input placeholder="Descripción" type="text" name="descripcion" required
                                    value="<?php echo $row['descripcion']; ?>" class="form-control input-lg">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">URL de la Imagen</label>
                            <div>
                                <input placeholder="Imangen" type="text" name="img" required value="<?php echo $row['img']; ?>"
                                    class="form-control input-lg">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Precio</label>
                            <div>
                                <input placeholder="Precio" type="number" name="precio" required value="<?php echo $row['precio']; ?>"
                                    class="form-control input-lg">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">ID de la Categoría</label>
                            <div>
                                <input placeholder="Categoría" type="number" name="id_categoria" required
                                    value="<?php echo $row['id_categoria']; ?>" class="form-control input-lg">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-warning" type="submit" name="submit_update">Actualizar Producto</button>
                        </div>

                    </form>
                </div>

                <?php
            }
        }
    ?>
    <?php
    }
}
?>
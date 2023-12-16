
<?php


if (isset($_GET["edit"])) {
    $id_categoria = $_GET["edit"];
    $result = $conn->query("SELECT * FROM categorias WHERE id_categoria=$id_categoria");

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        ?>

        <h3>Editar Categoría</h3>
        <!-- formulario edicion -->
        
        <form action="Categorias/crud.php" method="post">
            <input type="hidden" name="id_categoria" value="<?php echo $row['id_categoria']; ?>">
            <label for="nombre_categoria">Nuevo nombre:</label>
            <input type="text" name="nombre_categoria" value="<?php echo $row['nombre_categoria']; ?>" required>
           
            <button type="submit" class="btn btn-sm btn-warning" name="submit_update">Actualizar Categoría</button>
        </form>
   
        <?php
    }
}
?>
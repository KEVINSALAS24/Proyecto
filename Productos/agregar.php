
<?php

if (isset($_GET["agregar"])) {
    $id = $_GET["agregar"];
    

?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="acciones.php" method="post">
    <label for="nombre">Nombre del Producto:</label>
    <input type="text" name="nombre" required>
    <label for="descripcion">Descripción:</label>
    <input type="text" name="descripcion" required>
    <label for="img">URL de la Imagen:</label>
    <input type="text" name="img" required>
    <label for="precio">Precio:</label>
    <input type="text" name="precio" required>
    <label for="id_categoria">ID de la Categoría:</label>
    <input type="text" name="id_categoria" required>
    <button type="submit" name="submit_create">Crear Producto</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    

    


<?php
    
}
?>
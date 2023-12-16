<?php
include 'DAL/conexion.php';
include 'DAL/session.php';
// Llamada a la función
$conn = Conecta();


// Obtener el nombre de usuario de la sesión
$nombreUsuario = $_SESSION['usuario'];


?>

<!DOCTYPE html>
<html lang="es">

<head>



  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página de Inicio</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.all.min.js"></script>
</head>

<body>
  <!-- Barra de navegacion -->
  <?php include 'plantillas/plantilla.html'; ?>

  <!-- Carrusel -->
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://storage-asset.msi.com/global/picture/news/2019/nb/gs75-20190107-1.jpg"
          class="d-block  imgCorrusel" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://pbs.twimg.com/media/FluHCNdWQAAcTB3.jpg:large" class="d-block imgCorrusel" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://www.goitmart.com/wp-content/uploads/2022/11/Logitech-banner.png" class="d-block imgCorrusel"
          alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <?php

  $sql = "SELECT productos.id, productos.nombre, productos.descripcion, productos.img, productos.precio, categorias.nombre_categoria
   FROM productos
    JOIN categorias ON productos.id_categoria = categorias.id_categoria";
  $result = $conn->query($sql);

  ?>

  <div class="container">
    <!-- PRODUCTOS -->
    <br>
    <div class="row">
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { ?>
          <div style="display: flex; justify-content: center; " class="col pb-3">
            <div class="card" style="width: 18rem;">
              <img src="<?php echo $row["img"] ?>" class="card-img-top imgCard">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row["nombre"] ?> <label class="rounded bg-danger p-1 fs-6 text" for=""><?php echo $row["nombre_categoria"] ?></label></h5>
                <p class="card-text"><?php echo $row["descripcion"] ?></p>
                <p class="card-text">₡ <?php echo $row["precio"] ?></p>
                <a class="btn btn-danger" href="#" onclick="agregarAlCarrito(<?php echo $row['id']; ?>); return false;">Agregar al carrito</a>
           
          
              </div>
            </div>
            <br>
          </div>
         
          <?php
        }
      } ?>

    </div>
   
  </div>




  <?php include 'plantillas/footer.html'; ?>
</body>

</html>



<script>
        function agregarAlCarrito(productoId) {
          console.log(productoId);
          
          Swal.fire({
  icon: "success",
  title: "Agregado al carrito con exito",


});
            $.ajax({
                type: 'POST',
                url: 'Carrito/agregar.php',
                data: { id: productoId },
                success: function(response) {
                    // Actualizar el contenido del carrito después de agregar el producto
                    $('#carrito').html(response);
                }
            });
        }
    </script>
<h1 class="nombrePagina">Nuevo Cliente</h1>
<p class="descripcionPagina">Ingrese todos los campos requeridos para ingresar un nuevo Cliente</p>

<div class="barra">
    <p>Hola <?php echo $nombre ?? ''; ?></p>
    <a class="boton" href="/logout">Cerrar Sesión</a>
</div>

<?php if (isset($_SESSION['admin'])){?>
<div class="barraServicios">
    <a class="boton" href="/admin">Ver Citas</a>
    <a class="boton" href="/clientes">Ver Clientes</a>
    <a class="boton" href="/clientes/crear">Nuevo Cliente</a>
    <a class="boton" href="/roles">Ver Rol</a>
</div>

<?php } ?>

<?php
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form action="/clientes/crear" method="POST" class="formulario">
    <?php include_once __DIR__ . '/formulario.php'; ?>
    <input type="submit" class="boton" value="Guardar Cliente">
</form>
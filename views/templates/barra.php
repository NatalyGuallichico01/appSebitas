<div class="barra">
    <p>Hola <?php echo $nombre ?? ''; ?></p>
    <i class="fa-thin fa-user"></i>
    <a class="boton" href="/logout">Cerrar Sesión</a>
</div>

<?php if (isset($_SESSION['admin'])){?>
<div class="barraServicios">
    <a class="boton" href="/admin">Ver Citas</a>
    <a class="boton" href="/servicios">Ver Servicios</a>
    <a class="boton" href="servicios/crear">Nuevo Servicio</a>
    <a class="boton" href="/clientes">Ver Clientes</a>

</div>

<?php } ?>
<h1 class="nombrePagina">Clientes</h1>
<p class="descripcionPagina">Administración de Clientes</p>

<div class="barra">
    <p>Hola <?php echo $nombre ?? ''; ?></p>
    <a class="boton" href="/logout">Cerrar Sesión</a>
</div>

<?php if (isset($_SESSION['admin'])){?>
<div class="barraServicios">
    <a class="boton" href="/admin">Ver Citas</a>
    <!--<a class="boton" href="/clientes">Ver Clientes</a>-->
    <a class="boton" href="/clientes/crear">Nuevo Cliente</a>
</div>

<?php } ?>

<ul class="servicios">
    <?php foreach($usuarios as $usuario) {?>
        <li>
            <p>Nombre: <span><?php echo $usuario -> nombre; ?></span></p>
            <p>Apellido: <span><?php echo $usuario -> apellido; ?></span></p>
            <p>Teléfono: <span><?php echo $usuario -> telefono; ?></span></p>
            <p>E-mail: <span><?php echo $usuario -> email; ?></span></p>
            
            <div class="acciones">
                <a class="boton" href="/clientes/actualizar?id=<?php echo $usuario->id; ?>">Actualizar</a>
                <form action="/clientes/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $usuario->id; ?>"/>
                    <input type="submit" value="Eliminar" class="botonDelete">
                </form>
            </div>
        </li>
    <?php } ?>
</ul>
<h1 class="nombrePagina">Crear Nueva Cita</h1>
<p class="horariosPagina">Horarios de Atención</p>
<p class="descripcionPagina ">Lunes a Viernes de 9:00-18:00</p>
<br/>
<p class="descripcionPagina">Elige el/los servicios que deseas e ingresa tus datos</p>

<?php
include_once __DIR__ . '/../templates/barra.php';
?>

<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Información Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso1" class="seccion">
        <h2>Servicios</h2>
        <p class="textCenter">Elige el/los servicios que deseas</p>
        <div id="servicios" class="listadoServicios"></div>
    </div>

    <div id="paso2" class="seccion">
        <h2>Tus Datos y Cita</h2>
        <p class="textCenter">Ingresa tus datos y fecha de tu cita</p>

        <form class="formulario" >
            <div class="campo">
                <label for="nombre">Nombre: </label>
                <input id="nombre" type="text" placeholder="Ingresa tu Nombre" value="<?php echo $nombre; ?>" disabled/>
            </div>
            <div class="campo">
                <label for="fecha">Fecha: </label>
                <input id="fecha" type="date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"/>
            </div>

            <div class="campo">
                <label for="hora">Hora: </label>
                <input id="hora" type="time" /> 
                <!-- <ul class="tabla_horas">
                    <li id="9" value="9">9-10</li>
                    <li id="10:00" value="10">10-11</li>
                    <li id="11:00" value="11">11-12</li>
                    <li id="12:00" value="12">12-13</li>
                    <li id="13:00" value="13">14-15</li>
                    <li id="14:00" value="14">15-16</li>
                    <li id="15:00" value="15">16-17</li>
                    <li id="16:00" value="16">17-18</li>
                </ul> -->
            </div>

            <input type="hidden" id="id" value="<?php echo $id; ?>"/>
            
        </form>

    </div>

    <div id="paso3" class="seccion contenido-resumen">
        
        
    </div>

    <div class="paginacion1">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>


</div>

<?php
    $script="
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
    ";
?>
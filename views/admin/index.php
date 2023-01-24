<h1 class="nombrePagina">Panel de Administrador</h1>
<?php
include_once __DIR__ . '/../templates/barra.php';
?>

<h2>Buscar Citas</h2>


    <a class="botonReporte" href="/admin/reportes">Reporte pdf</a>


<!-- <input type="submit" name="estado" id="estado" class="botonReporte" value="Reporte" />  -->
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha Inicio: </label>
            <input type="date" id="fechaInicio" name="fecha" value="<?php echo $fecha ?>"/>
        </div>
        <div class="campo">
            <label for="fecha">Fecha Fin: </label>
            <input type="date" id="fechaFin" name="fecha" value="<?php echo $fecha ?>"/>
        </div>
    </form>
</div>

<?php
    if(count($citas)===0){
        echo "<h2>No hay Citas en esta Fecha</h2>";
    }
?>

<div id="citasAdmin">

    <ul class="citas">
        
        <?php
        $idCita = 0;
        
        foreach ($citas as $key => $cita) {
           //debuguear($key);
            if ($idCita !== $cita->id) {
                $total=0;
        ?>
        
                <li>
                <h3>Información Cliente</h3>
                    <p>Id: <span><?php echo $cita->id; ?></span></p>
                    <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                    <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                    <p>E-mail: <span><?php echo $cita->email; ?></span></p>
                    <p>Teléfono: <span><?php echo $cita->telefono; ?></span></p>
                    <!-- <p>Estado: <span><?php //echo $cita->estado; ?></span></p> -->
                    <hr>

                    <h3>Servicios</h3>
                <?php
                $idCita = $cita->id;
                 
            } //Fin de if 
                $total+= $cita->precio;
                ?>
                <p class="servicio"><?php echo $cita->servicio . " " . $cita->precio; ?></p>
                <?php 
                $actual=$cita->id;
                //debuguear($cita);
                //$cita->estado="1";
                $proximo=$citas[$key+1]->id ?? 0;

                if (isLast($actual, $proximo)) {

                    ?> 
                    <p class="total">Total: <span>$ <?php echo $total ?></span></p>
                    <form action="/api/delete" method="POST">
                        <input type="hidden" name="id" value="<?php echo $cita->id; ?>"/>
                        <?php 
                        if($cita->estado==="0"){
                            ?>
                        <input type="submit" name="estado" id="estado" class="botonDelete" value="Atendido" />
                        <?php
                        }
                         ?>
                        
                    </form>
                    <?php
                }
                ?>
            <?php } // fin foreach 
            ?>

    </ul>

</div>




<?php 
    
    $script="<script src='build/js/buscador.js'></script>";
    
?>

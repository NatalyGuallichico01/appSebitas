<div class="campo">
        <label for="nombre">Nombre: </label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre"  value="<?php echo s($usuario->nombre);?>"/>
    </div>

    <div class="campo">
        <label for="apellido">Apellido: </label>
        <input type="text" id="apellido" name="apellido" placeholder="Ingresa tu apellido"  value="<?php echo s($usuario->apellido);?>"/>
    </div>

    <div class="campo">
        <label for="telefono">Teléfono: </label>
        <input type="telefono" id="telefono" name="telefono" placeholder="Ingresa tu teléfono"  value="<?php echo s($usuario->telefono);?>"/>
    </div>

    <div class="campo">
        <label for="email">E-mail: </label>
        <input type="email" id="email" name="email" placeholder="Ingresa tu e-mail"  value="<?php echo s($usuario->email);?>"/>
    </div>

    
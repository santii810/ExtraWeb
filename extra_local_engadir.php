<?php 
require './vista/menu.php';
?>
<div id="corpo_extra_engadir">
    <form action="index.php" method="post">
        <b>Añadir sitio:</b>
        <p>
        <div id="datos">
            <div id="separacion">
                <label for="nombre_local">Nombre del local: </label>
                <input type="text" name="nombre_local" id="nombre_local" maxlength="50" size="50" required="required">
            </div>
            <br> 
            <div id="separacion">
                <label for="direccion">Direccion </label>
                <input type="text" name="direccion" id="direccion" maxlength="50" size="50">
            </div>
            <br> 
            <div id="separacion">
                <label for="descripcion">Descripcion:</label>
                <TEXTAREA NAME="descripcion" id="descripcion" ROWS=5 COLS=30></TEXTAREA>
            </div>
            <br>
            <div id="separacion">
                <label for="engadir">
                    <input type="submit" name="engadir_local" id="engadir" value="Registrar">
                </label>
            </div>
        </div>
    </form>
</div>
<?php require'./vista/pie.php'; ?><?php

<?php 
require './vista/menu.php';
include  'calendario/calendario.php';
?>
<script language="JavaScript" src="calendario/javascripts.js"></script>
<div id="corpo_fresa_engadir">
    <form action="index.php" method="post">
        <div id="datos">
            <div id="separacion">
                <form name="fcalen">
                    <label for="fecha">Fecha (AAAA-MM-DD): </label>
                    <?php
                        escribe_formulario_fecha_vacio("fecha1","fcalen");
                    ?>
                </form>
            </div>
            <br>
            <div id="separacion">
                <label for="caixas">Caixas: </label>
                <input type="text" name="caixas" id="caixas" maxlength="3" size="30" required="required"> &euro;
            </div>
            <br>
            <div id="separacion">
                <label for="engadir">
                    <input type="submit" name="engadir_fresa" id="engadir" value="Registrar">
                </label>
            </div>
        </div>
    </form>
</div>
<?php require'./vista/pie.php'; ?>
<?php 
require './vista/menu.php';
include  'calendario/calendario.php';
?>
<script language="JavaScript" src="calendario/javascripts.js"></script>
<div id="corpo_extra_engadir">
    <form action="index.php" method="post">
        <?php
        // ejecuto las funciones que me devuelven los usuarios y los locales
            $sitios = buscar_sitios();
            if (!$sitios)  {
                echo ' <br> <div id="error"> '
                    . "No se ha logrado acceder a la Base de datos"
                    . "</div>";
                    exit;
            }
        ?>
        <b>Añadir extra:</b>
        <p>
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
                <label for="sitio">Sitio:</label>
                <select name="sitio" size="1" id="sitio" required="required">
                <option disabled="disabled" selected="selected">Sitio</option>
                    <?php foreach ($sitios as $sitio) :?>
                        <option value="<?php echo $sitio[Nomlocal]; ?>"><?php echo $sitio[Nomlocal]; ?></option>
                        <br>
                    <?php endforeach ?>
                </select>
            </div>
            <br> 
            <div id="separacion">
                <label for="cobro">Cobro: </label>
                <input type="int" name="cobro" id="cobro" maxlength="6" size="30" required="required"> &euro;
            </div>
            <br>
            <div id="separacion">
                <label for="propina">Propina: </label>
                <input type="int" name="propina" id="propina" maxlength="6" size="30"> &euro;
            </div>
            <br>
            <div id="separacion">
                <label for="tempo">Tempo: </label>
                <input type="int" name="tempo" id="tempo" maxlength="2" size="30">h
            </div>
            <br>
            <div id="separacion">
                <label for="pago_asoc">Pago asociado:</label>
                <select name="pago_asoc" size="1" id="pago_asoc">
                <option value="s">SI</option>
                <option value="n">NO</option>
                </select>
            </div>
            <br> 
            <div id="separacion">
                <label for="notas">Notas:</label>
                <TEXTAREA NAME="notas" id="notas" ROWS=5 COLS=30></TEXTAREA>
            </div>
            <br>
            <div id="separacion">
                <label for="engadir">
                    <input type="submit" name="engadir_extra" id="engadir" value="Registrar">
                </label>
            </div>
        </div>
    </form>
</div>
<?php require'./vista/pie.php'; ?>
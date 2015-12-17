<?php
require './vista/menu.php';
$extra = buscar_extra($_GET["extraID"]);
?>
<div id="extra_borrar">
    <form action="index.php" method="post">
        <h2><b>¿Estas seguro de que deseas borrar la siguiente extra de la base de datos?</b></h2>
        <label id="linea_borrado">Codigo de extra:</label>
            <input type="text" name="extraID" id="extraID" size="4" readonly="readonly" value="<?php echo $_GET['extraID']?>"></center>
        <dl id="linea_borrado">
            <dd>Fecha: <?php echo $extra["fecha"];?></dd>
            <dd>Usuario: <?php echo $extra["usuario"];?></dd>
            <dd>Local: <?php echo $extra["local"];?></dd>
            <dd>Cobro: <?php echo $extra["precio"];?></dd>
            <dd>Propina: <?php echo $extra["propina"];?></dd>
            <dd>Pago Asociado: <?php if ( $extra["pago_asoc"] == s){echo "SI";}
                elseif ($extra["pago_asoc"] == n){echo "NO";} ?></dd>
            <dd>
                <input type="submit" name="borrar" id="borrar" value="Borrar Extra">
                <input type="submit" name="cancelar" id="cancelar" value="Cancelar">
            </dd>
        </dl> 
    </form>
</div>
        


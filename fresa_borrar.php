<?php
require './vista/menu.php';
$fresa = buscar_fresa($_GET["fresaID"]);
?>
<div id="extra_borrar">
    <form action="index.php" method="post">
        <h2><b>¿Estas seguro de que deseas borrar el siguiente dia de la base de datos?</b></h2>
        <label id="linea_borrado">Codigo:</label>
            <center><input type="text" name="fresaID" id="fresaID" size="4" readonly="readonly" value="<?php echo $_GET['fresaID']?>"></center>
        <dl id="linea_borrado">    
        <dd>Fecha: <?php echo $fresa["fecha"];?></dd>
            <dd>Usuario: <?php echo $fresa["usuario"];?></dd>
            <dd>Caixas: <?php echo $fresa["caixas"];?></dd>
            <dd>
                <input type="submit" name="borrar" id="borrar" value="BORRAR">
                <input type="submit" name="cancelar" id="cancelar" value="CANCELAR">
            </dd>
        </dl> 
    </form>
</div>
        


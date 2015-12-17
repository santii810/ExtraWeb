<?php
require './vista/menu.php';
$extra = buscar_extra($_GET["extraID"]);
?>
<form action="extra_modificar.php?extraID=<?php echo $extra["extraID"];?>" method="post">
<table id="extra_detalles" border="0">
    <tr>
        <td>
            <table id="extra_detalles">
                <tr>
                    <td>USUARIO:</td>
                    <td><?php echo $extra[usuario]?></td>
                </tr>
                <tr>
                    <td>FECHA:</td>
                    <td><?php echo $extra[fecha]?></td>
                    <td><input type="submit" name="mod_fecha" id="engadir" value="Modificar"></td>
                </tr>
                <tr>
                    <td>LOCAL:</td>
                    <td><?php echo $extra[local]?></td>
                    <td><input type="submit" name="mod_local" id="engadir" value="Modificar"></td>
                </tr>
                <tr>
                    <td>TEMPO:</td>
                    <td><?php echo $extra[tempo]?></td>
                    <td><input type="submit" name="mod_tempo" id="engadir" value="Modificar"></td>
                </tr>
                <tr>
                    <td>COBRO:</td>
                    <td><?php echo $extra[precio]?></td>
                    <td><input type="submit" name="mod_precio" id="engadir" value="Modificar"></td>
                </tr>
                <tr>
                    <td>PROPINA:</td>
                    <td><?php echo $extra[propina]?></td>
                    <td><input type="submit" name="mod_propina" id="engadir" value="Modificar"></td>
                </tr>
                <tr>
                    <td>PAGO ASOCIADO:</td>
                    <td><?php if ( $extra["pago_asoc"] == s){echo "SI";}
                            elseif ($extra["pago_asoc"] == n){echo "NO";} ?></td>
                    <td><input type="submit" name="mod_pago_asoc" id="engadir" value="Modificar"></td>
                </tr>
            </table>    
        </td>
        <td>
            <table id="extra_detalles">
                <tr>
                    <td>NOTAS:</td>
                    <td><input type="submit" name="mod_notas" id="engadir" value="Modificar"></td>

                </tr>
                <tr>
                    <td><?php echo $extra[notas]?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>    
</form>
<?php require'./vista/pie.php'; ?>
    
    



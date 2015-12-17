<?php
require './vista/menu.php';
$conexion = abrir_conexion();
session_start();
$usuID = usuario_a_usuID($_SESSION["user"]);;
?>

<?php for ($ano = 2014; $ano > 2000; $ano--) :; ?>
    <?php if ( num_extras($ano, $usuID, $conexion) > 0) : ; ?>
        <table border="1" id="tabla_historico">
            <tr>
                <th id="tabla_historico_ano"><?php echo $ano ?></th>
            </tr>
            <tr>
                <td>Numero de Extras:</td>
                <td><?php
                    echo num_extras($ano, $usuID, $conexion); 
                ?></td>
            </tr>
            <tr>
                <td>Cobro total:</td>
                <td><?php
                    $sql = "SELECT SUM(precio) as dato FROM extras WHERE usuario = '$usuID' and YEAR(fecha)='$ano'";
                    echo devolver_consulta($ano, $usuID, $conexion, $sql) .' €'; 
                ?></td>
            </tr>
            <tr>
                <td>Propinas ganadas</td>
                <td><?php
                    $sql = "SELECT SUM(propina) as dato FROM extras WHERE usuario = '$usuID' and YEAR(fecha)='$ano'";
                    echo devolver_consulta($ano, $usuID, $conexion, $sql) .' €'; 
                ?></td>
            </tr>
            <tr>
                <td>Total ganado (prop. inc.):</td>
                <td><?php
                    $sql = "SELECT SUM(propina)+SUM(precio) as dato FROM extras WHERE usuario = '$usuID' and YEAR(fecha)='$ano'";
                    echo devolver_consulta($ano, $usuID, $conexion, $sql) .' €'; 
                ?></td>
            </tr>
            <tr>
                <td>Pago asociado:</td>
                <td><?php
                    $sql = "select count(*)*5 AS dato from extras where usuario = '$usuID' and YEAR(fecha)='$ano' and pago_asoc='s'";
                    echo devolver_consulta($ano, $usuID, $conexion, $sql) . ' €'; 
                ?></td>
            </tr>
            <tr>
                <td>Pago realizado</td>
                <td><?php
                    $sql = "SELECT SUM(cantidad) as dato FROM pagos WHERE usuario = '$usuID' and YEAR(fecha)='$ano'";
                    if (devolver_consulta($ano, $usuID, $conexion, $sql)){ 
                    echo devolver_consulta($ano, $usuID, $conexion, $sql) . ' €';
                    } else {
                        echo "0 €";
                    }
                    ; 
                ?></td>
            </tr>
        </table>
    <?php endif; ?>
<?php endfor;?>
<?php require'./vista/pie.php'; ?>

<?php
require './vista/menu.php';
$conexion = abrir_conexion();
session_start();
$usuID = usuario_a_usuID($_SESSION["user"]);;
?>

<?php for ($ano = 2014; $ano > 2000; $ano--) :; 
$sql = "select count(*) AS dato from fresa where usuario = '$usuID' and YEAR(fecha)='$ano'";    
if (devolver_consulta($ano, $usuID, $conexion, $sql) > 0) : ; ?>
        <table border="1" id="tabla_historico">
            <tr>
                <th id="tabla_historico_ano"><?php echo $ano ?></th>
            </tr>
            <tr>
                <td>Total de caixas:</td>
                <td><?php
                    $sql = "SELECT SUM(caixas) as dato FROM fresa WHERE usuario = '$usuID' and YEAR(fecha)='$ano'";
                    echo devolver_consulta($ano, $usuID, $conexion, $sql); 
                ?></td>
            </tr>
            <tr>
                <td>Media diaria:</td>
                <td><?php
                    $sql = "SELECT SUM(caixas)/count(*) as dato FROM fresa WHERE usuario = '$usuID' and YEAR(fecha)='$ano'";
                    echo round(devolver_consulta($ano, $usuID, $conexion, $sql),2); 
                ?></td>
            </tr>
        </table>
    <?php endif; ?>
<?php endfor;?>
<?php require'./vista/pie.php'; ?>

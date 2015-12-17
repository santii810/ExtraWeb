<?php
require './vista/menu.php';
$conexion = abrir_conexion();
session_start();
$usuID = usuario_a_usuID($_SESSION["user"]);;
echo "<br>";
for ($ano = 2014; $ano > 2000; $ano--) :;
$total = devolver_consulta($ano, $usuID, $conexion, "SELECT SUM(propina) as dato FROM extras WHERE usuario = '$usuID' and YEAR(fecha)='$ano'"); 
if ( $total > 0) : ;
$ingresos_local = propina_local($ano, $usuID, $conexion);
echo "<br>";
?>
<table border="0" id="grafica1">
    <tr><th id="tabla_historico_ano"><?php echo "$ano"; ?></th>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        <td>Propina</td>
    </tr>
<?php foreach ($ingresos_local as $value) :
$porcentaje = 100 * $value["ingresos"] / $total;
if ($value["ingresos"] > 0) :
?>
    <tr>
	<td><b><?php echo $value["local"] ?></b></td>
	<td width="10" <?php if ($porcentaje >= 10) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 20) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 30) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 40) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 50) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 60) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 70) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 80) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 90) echo 'bgcolor="#00FF00"' ?></td>
        <td><?php echo round($porcentaje) . " %"; ?>&nbsp;(<i><?php echo $value["ingresos"] . ' €'; ?></i>)</td>
  </tr>
<?php 
endif;
endforeach; 
echo "</table>";
endif;
endfor;
$ingresos_local = total_propina_local($usuID, $conexion);
$total = devolver_consulta($ano, $usuID, $conexion, "SELECT SUM(propina) as dato FROM extras WHERE usuario = '$usuID'"); 
?>
  <br>
<table border="0" id="grafica1">
    <tr><th id="tabla_historico_ano">TOTAL</th>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        <td>Ingresos</td>
    </tr>
<?php foreach ($ingresos_local as $value) :
if ($value["ingresos"] > 0) :
$porcentaje = 100 * $value["ingresos"] / $total;?>
  <tr>
	<td><b><?php echo $value["local"] ?></b></td>
	<td width="10" <?php if ($porcentaje >= 10) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 20) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 30) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 40) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 50) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 60) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 70) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 80) echo 'bgcolor="#00FF00"' ?></td>
	<td width="10" <?php if ($porcentaje >= 90) echo 'bgcolor="#00FF00"' ?></td>
        <td><?php echo round($porcentaje) . " %"; ?>&nbsp;(<i><?php echo $value["ingresos"] . ' €'; ?></i>)</td>
  </tr>
<?php 
endif;
endforeach; 
echo "</table>";
require './vista/pie.php';
?>
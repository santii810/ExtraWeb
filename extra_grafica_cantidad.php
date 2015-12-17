<?php
require './vista/menu.php';
$conexion = abrir_conexion();
session_start();
$usuID = usuario_a_usuID($_SESSION["user"]);;
echo "<br>";
for ($ano = 2014; $ano > 2000; $ano--) :;
if ( num_extras($ano, $usuID, $conexion) > 0) : ;
$num_extras = numero_extras_local($ano, $usuID, $conexion);
$total = num_extras($ano, $usuID, $conexion); 
echo "<br>";
?>
<table border="0" id="grafica1">
    <tr><th id="tabla_historico_ano"><?php echo "$ano"; ?></th>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        <td>Extras realizadas</td>
    </tr>
<?php foreach ($num_extras as $value) :
$porcentaje = 100 * $value["numero"] / $total;?>
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
        <td><?php echo round($porcentaje) . " %"; ?>&nbsp;(<i><?php echo $value["numero"]; ?></i>)</td>
  </tr>
<?php 
endforeach; 
echo "</table>";
endif;
endfor;
$num_extras = total_extras_local($usuID, $conexion);
$total = num_extras_total($usuID, $conexion); 
?>
<table border="0" id="grafica1">
    <tr><th id="tabla_historico_ano">TOTAL</th>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        <td>Extras realizadas</td>
    </tr>
<?php foreach ($num_extras as $value) :
$porcentaje = 100 * $value["numero"] / $total;?>
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
        <td><?php echo round($porcentaje) . " %"; ?>&nbsp;(<i><?php echo $value["numero"]; ?></i>)</td>
  </tr>
<?php 
endforeach; 
echo "</table>";
require './vista/pie.php';
?>
<!--catalogo.php (vista)
Muestra el catálogo de extras -->
<?php
require './vista/menu.php';
$conexion = abrir_conexion();
if (isset($_POST[ordenar_extra])){
    $extras = obtener_extras_ordenadas($conexion, $_POST[parametro1], $_POST[modo1], $_POST[parametro2], $_POST[modo2]);
}elseif (isset ($_POST[filtrar_extra])) {
    $sql = devolver_sql_filtrar($_POST[ano], $_POST["sitio"], $_POST["pago_asoc"]);
    $extras = devolver_extras_filtradas($conexion, $sql);
    if (!$extras){
        require './vista/error_filtrar.php';
        exit;
    }
}else{
$extras = obtener_extras($conexion);
}
if (!$_POST[filtrar_extra]) :;
?>
<form action="extra_consultar.php" method="post">
<table id="orden">
    <tr>
        <td>
            <label for="parametro1">Parametro 1:</label>
            <select name="parametro1" size="1" id="parametro1">
                <option value="extraID">ID</option>
                <option value="fecha">Fecha</option>
                <option value="local">Sitio</option>
                <option value="tempo">Tempo</option>
                <option value="precio">Precio</option>
                <option value="propina">Propina</option>
                <option value="pago_asoc">Pago asociado</option>
            </select>            
        </td>
        <td>
            <label for="modo1">Tendencia:</label>
            <select name="modo1" size="1" id="modo1">
                <option value="ASC">Ascendente</option>
                <option value="DESC">Descendente</option>
            </select>            
        </td>
    </tr>
    <tr>
        <td>
            <label for="parametro2">Parametro 2:</label>
            <select name="parametro2" size="1" id="parametro2">
                <option value="extraID">ID</option>
                <option value="fecha">Fecha</option>
                <option value="local">Sitio</option>
                <option value="tempo">Tempo</option>
                <option value="precio">Precio</option>
                <option value="propina">Propina</option>
                <option value="pago_asoc">Pago asociado</option>
            </select>            
        </td>
        <td>
            <label for="modo2">Tendencia:</label>
            <select name="modo2" size="1" id="modo2">
                <option value="ASC">Ascendente</option>
                <option value="DESC">Descendente</option>
            </select>            
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="submit" name="ordenar_extra" id="ordenar" value="Registrar">
        </td>
    </tr>
</table>
    <?php endif ?>
</form>
<div id="contenido">
    <h3>Catálogo de extras</h3>
    <table border="1" id="tabla_mostrar_extras">
        <tr>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Sitio</th>
            <th>Cobro</th>
            <th>Propina</th>
            <th>P_A</th>
            <th>Detalles</th>
            <th>Borrar</th>
        </tr>
        <?php foreach ($extras as $extra) :?>
        <tr>
            <td id="fila_tabla"><?php echo $extra["fecha"];?></td>
            <td id="fila_tabla"><?php echo $extra["usuario"];?></td>
            <td id="fila_tabla"><?php echo $extra["local"];?></td>
            <td id="fila_tabla"><?php echo $extra["precio"];?></td>
            <td id="fila_tabla"><?php echo $extra["propina"];?></td>
            <td id="fila_tabla"><?php if ( $extra["pago_asoc"] == s){echo "SI";}
                elseif ($extra["pago_asoc"] == n){echo "NO";} ?></td>
            <td id="fila_tabla"><a href='extra_detalles.php?extraID=<?php
                echo $extra["extraID"]; ?>'>Detalles</td>
            <td id="fila_tabla"><a href='extra_borrar.php?extraID=<?php
                echo $extra["extraID"]; ?>'>Borrar</td>
        </tr>
        <?php endforeach ;?>
    </table>
</div>
<?php require'./vista/pie.php'; ?>
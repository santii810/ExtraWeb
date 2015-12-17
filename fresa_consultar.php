<!--catalogo.php (vista)
Muestra el catálogo de extras -->
<?php
require './vista/menu.php';
$conexion = abrir_conexion();
$fresa = obtener_fresa($conexion);
?>
<div id="mostrar_fresas">
        <table border="1" id="tabla_mostrar_fresa">
        <tr>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Caixas</th>
            <th>Borrar</th>
        </tr>
        <?php foreach ($fresa as $value) :?>
        <tr>
            <td id="fila_tabla"><?php echo $value["fecha"];?></td>
            <td id="fila_tabla"><?php echo $value["usuario"];?></td>
            <td id="fila_tabla"><?php echo $value["caixas"];?></td>
            <td id="fila_tabla"><a href='fresa_borrar.php?fresaID=<?php
                echo $value["fresaID"]; ?>'>Borrar</td>
        </tr>
        <?php endforeach ;?>
    </table>
</div>
<?php require'./vista/pie.php'; ?>
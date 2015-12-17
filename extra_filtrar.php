<?php 
require './vista/menu.php';
?>
    <form action="extra_consultar.php" method="post">
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
        <div id="datos_filtrar">
        <b>Parametros a filtrar:</b>
        <p>
            <div id="separacion">
                <label for"ano">Año:</label>
                <select name="ano" size="1" id="ano">
                    <option disabled="disabled" selected="selected">Todos</option>
                    <?php for ($ano = 2014; $ano > 2000; $ano--) : ?>
                        <option value="<?php echo $ano; ?>"><?php echo $ano; ?></option>
                    <?php endfor ;?>
                </select>
            </div>
            <br>
            <div id="separacion">
                <label for="sitio">Sitio:</label>
                <select name="sitio" size="1" id="sitio">
                <option disabled="disabled" selected="selected">Todos</option>
                    <?php foreach ($sitios as $sitio) :?>
                        <option value="<?php echo $sitio[Nomlocal]; ?>"><?php echo $sitio[Nomlocal]; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <br> 
            <div id="separacion">
                <label for="pago_asoc">Pago asociado:</label>
                <select name="pago_asoc" size="1" id="pago_asoc">
                    <option disabled="disabled" selected="selected">Ambos</option>
                    <option value="s">SI</option>
                    <option value="n">NO</option>
                </select>
            </div>
            <br>
            <div id="separacion">
                <label for="engadir">
                    <input type="submit" name="filtrar_extra" id="filtrar" value="Filtrar">
                </label>
            </div>
        </div>
    </form>
</div>
<?php require'./vista/pie.php'; ?>







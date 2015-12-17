<?php 
require './vista/menu.php';
?>
<form action="extra_buscar.php" method="post">
    <?php
    // ejecuto las funciones que me devuelven los usuarios y los locales
        $sitios = buscar_sitios();
        $usuarios = buscar_usuarios();
        if (!$sitios || !$usuarios)  {
        Echo ' <br> <div id="error"> '
            . "No se ha logrado acceder a la Base de datos"
            . "</div>";
            exit;
        }
    ?>
    <table id="buscar_extra">
        <tr>
            <td>
                <label for="usuario">Usuario:</label>
                <select name="usuario" size="1" id="usuario" required="required">
                    <option value="*">Todos</option>
                    <?php foreach ($usuarios as $usuario) :?>
                        <option value="<?php echo $usuario[usuID]; ?>">
                                <?php echo $usuario[nombre]; ?></option>
                    <?php endforeach ?>
                </select>
            </td>
            <td>
                <label for="sitio">Sitio:</label>
                <select name="sitio" size="1" id="sitio" required="required">
                    <option value="*">Todos</option>
                    <?php foreach ($sitios as $sitio) :?>
                        <option value="<?php echo $sitio[Nomlocal]; ?>">
                            <?php echo $sitio[Nomlocal]; ?></option>
                    <?php endforeach ?>
                </select>
            </td>
            <td>
                <label for="ano">Ano:</label>
                <select name="ano" size="1" id="ano">
                    <option value="*">Cualquiera</option>
                    <?php
                    for ($cont = 2014 ; $cont >= 2010 ; $cont--){
                        echo "<option value=" . $cont . ">" . $cont . "";
                    } ?>
                </select>
            </td>
            <td>
                <label for="filtrar">
                    <input type="submit" name="filtrar" id="filtrar" value="Filtrar">
                </label>
            </td>
    </table>
</form>
<?php
if (isset($_POST["filtrar"])){
    $usuario = $_POST["usuario"];
    $ano = $_POST["ano"];
    $sitio = $_POST["sitio"];
    $filtrar = filtrar_extras($usuario, $ano, $sitio);
    if (!$filtrar) {
        echo "<div id='error'> No hay extras con estos filtros </div>";
    }
    else {
        
        
        
        
        
        
        
    }
}



?>

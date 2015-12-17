<?php
require './vista/menu.php';

if (isset($_POST["mod_fecha"])) {
    $accion = "fecha";
}elseif (isset($_POST["mod_local"])) {
    $accion = "local";
}elseif (isset($_POST["mod_tempo"])) {
    $accion = "tempo";
}elseif (isset($_POST["mod_propina"])) {
    $accion = "propina";
}elseif (isset($_POST["mod_precio"])) {
    $accion = "cobro";
}elseif (isset($_POST["mod_pago_asoc"])) {
    $accion = "pago_asoc";
}elseif (isset($_POST["mod_notas"])) {
    $accion = "notas";
}
echo "<div id='modificar_extra'>";
echo '<form action="index.php?extraID=' .  $_GET[extraID] . '" method="post">';
switch ($accion) {
    case "fecha":
        echo '<label for="fecha">Fecha (AAAA-MM-DD): </label>';
        echo '<INPUT name="fecha" id="fecha" size="10">';
        break;
    case "local":
        $sitios = buscar_sitios();
        if (!$sitios)  {
            echo ' <br> <div id="error"> '
                . "No se ha logrado acceder a la Base de datos"
                . "</div>";
            exit;
        }
        echo '<label for="sitio">Local:</label>';
        echo '<select name="sitio" size="1" id="sitio" required="required">';
        echo '<option disabled="disabled" selected="selected">Sitio</option>';
            foreach ($sitios as $sitio) {
                echo '<option value="' . $sitio[Nomlocal] . '">' . $sitio[Nomlocal] . '</option>';
                echo "<br>";
            }
            echo "</select>";
        break;
    case "tempo":
        echo '<label for="tempo">Tempo: </label>
            <input type="int" name="tempo" id="tempo" maxlength="2" size="30">h';
        break;
    case "cobro":
        echo '<label for="cobro">Cobro: </label>
            <input type="int" name="cobro" id="cobro" maxlength="6" size="30" required="required"> &euro;';
        break;
    case "propina":
        echo '<label for="propina">Propina: </label>
            <input type="int" name="propina" id="propina" maxlength="6" size="30" required="required"> &euro;';
        break;
    case "pago_asoc":
        echo '<label for="pago_asoc">Pago asociado:</label>
            <select name="pago_asoc" size="1" id="pago_asoc">
            <option value="s">SI</option>
            <option value="n">NO</option>
            </select>';
        break;
    case "notas":
        echo '<label for="notas">Notas:</label>
            <TEXTAREA NAME="notas" id="notas" ROWS=5 COLS=30></TEXTAREA>';
        break;
}
echo '<input type="submit" name="modificar" id="modificar" value="Modificar">';
echo "</div>";
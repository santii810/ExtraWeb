<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
/* index.php (controlador) */
require './vista/menu.php';
$conexion = abrir_conexion();
if (!$conexion) {
    require '.\vista\error.php';
    exit;
}

if (isset($_POST["engadir_extra"])) {
    $accion = "engadir_extra";
}elseif (isset($_POST["borrar"])) {
    if (($_POST["borrar"]) == "Borrar Extra") {
        $accion = "borrar_extra";
    } elseif (($_POST["borrar"]) == "BORRAR") {
        $accion = "borrar_fresa";
    } elseif (($_POST["borrar"]) == "Cancelar") {
        header("Location: ./extra_consultar.php");
    } elseif (($_POST["borrar"]) == "CANCELAR") {
        header("Location: ./fresa_consultar.php");
    }   
}elseif (isset($_POST["engadir_fresa"])) {
    $accion = "engadir_fresa";
}elseif (isset ($_POST["modificar"])){
    $accion = "modificar";
    if (isset($_POST["fecha"])){
    $sql = "UPDATE `ServidorWeb`.`extras` SET `fecha` = '" . $_POST['fecha'] .
            "' WHERE `extras`.`extraID` =" . $_GET[extraID];    
    } elseif (isset ($_POST["sitio"])) {
         $sql = "UPDATE `ServidorWeb`.`extras` SET `local` = '" . $_POST['sitio'] .
            "' WHERE `extras`.`extraID` =" . $_GET[extraID]; 
    } elseif (isset ($_POST["tempo"])) {
        $sql = "UPDATE `ServidorWeb`.`extras` SET `tempo` = '" . $_POST['tempo'] .
            "' WHERE `extras`.`extraID` =" . $_GET[extraID];
    } elseif (isset ($_POST["propina"])) {
          $sql = "UPDATE `ServidorWeb`.`extras` SET `propina` = '" . $_POST['propina'] .
            "' WHERE `extras`.`extraID` =" . $_GET[extraID];
    } elseif (isset ($_POST["cobro"])) {
          $sql = "UPDATE `ServidorWeb`.`extras` SET `precio` = '" . $_POST['cobro'] .
            "' WHERE `extras`.`extraID` =" . $_GET[extraID];
    } elseif (isset ($_POST["pago_asoc"])) {
          $sql = "UPDATE `ServidorWeb`.`extras` SET `pago_asoc` = '" . $_POST['pago_asoc'] .
            "' WHERE `extras`.`extraID` =" . $_GET[extraID];
    } elseif (isset ($_POST["notas"])) {
          $sql = "UPDATE `ServidorWeb`.`extras` SET `notas` = '" . $_POST['notas'] .
            "' WHERE `extras`.`extraID` =" . $_GET[extraID];
    }
}elseif (isset($_POST["engadir_local"])) {
        $accion = "engadir_local";
}

switch ($accion) {
    case "engadir_extra":
        session_start();
        $fecha = $_POST["fecha1"];
        $usuario = usuario_a_usuID($_SESSION["user"]);
        $sitio = $_POST["sitio"];
        $cobro = $_POST["cobro"];
        $notas = $_POST["notas"];
        $propina = $_POST["propina"];
        $tempo = $_POST["tempo"];
        $pago_asoc = $_POST["pago_asoc"];
        $engadir = engadir_extra($fecha, $usuario, $sitio, $propina, $cobro, 
                $notas, $tempo, $pago_asoc);
        if ($engadir) header("Location: ./extra_consultar.php");
 	break;
    case "borrar_extra":
        $borrar = borrar_extra($_POST["extraID"]);
        if ($borrar) header("Location: ./extra_consultar.php");
        break;
    case "borrar_fresa":
        $borrar = borrar_fresa($_POST["fresaID"]);
        if ($borrar) header("Location: ./fresa_consultar.php");
        break;
    case "engadir_fresa":
        session_start();
        $fecha = $_POST["fecha1"];
        $usuario = usuario_a_usuID($_SESSION["user"]);
        $caixas = $_POST["caixas"];
        $engadir = engadir_fresa($fecha, $usuario, $caixas);
        if ($engadir) header("Location: ./fresa_consultar.php");
 	break;
    case "modificar":
        $extraID = modificar_dato($sql, $conexion);
        if (!$extraID){
            require './vista/error_modificar.php';
        } else {
            header("Location: ./extra_detalles.php?extraID=$_GET[extraID]");
            exit;
        }
    break;
    case "engadir_local":
        $nombre = $_POST[nombre_local];
        $direccion = $_POST[direccion];
        $descripcion = $_POST[descripcion];
        engadir_local($nombre, $direccion, $descripcion);
        break;
}
require './vista/pie.php';
?>
<?php 
require './conexion.php';
require './funciones.php';
require './autentificado.php';
session_start();
$datosacceso = ver_acceso($_SESSION[user]);
foreach ($datosacceso as $acceso) :; 
?>
<html>
    <head>
        <link rel="icon" type="image/png" href="./images/icono.jpg" />
        <meta charset="utf-8">
        <link rel="stylesheet" href="./index.css">
        <!DOCTYPE html>
        <html lang="es">
        <title>SantiWeb</title>
    </head>
    <body background="./images/fondo_negro.jpg" link="#ffff00" vlink="#FFFFFF" alink="#FFFFFF">
        <div id="contenedor">        
            <div id="menu">
                <ul>
                    <?php if ($acceso[accesoextras]) :; ?>
                    <li class="nivel1"><a href="#" class="nivel1">Extras</a>
                        <ul class="nivel2">
                            <li><a href="./extra_engadir.php">Añadir Extra</a></li>
                            <li><a href="./extra_consultar.php">Consultar Extras</a></li>
                            <li><a href="./extra_filtrar.php">Filtrar Extras</a></li>
                            <li><a href="./extra_historial.php">Historico de Extras</a></li>
                            <li class="nivel2"><a href="#">Graficas</a>
                                <ul class="nivel3">
                                    <li><a href="./extra_grafica_cantidad.php">Extras por local</a>
                                    <li><a href="./extra_grafica_ingresos.php">Ingresos por local</a></li>
                                    <li><a href="./extra_grafica_propina.php">Propina por local</a></li>
                                </ul>
                            </li>
                            <li><a href="./extra_local_engadir.php">Añadir local</a></li>
                        </ul>
                    </li>
                    <?php endif; 
                    if ($acceso[accesofresa]) :; ?>
                    <li class="nivel1"><a href="#" class="nivel1">Fresa</a>
                        <ul class="nivel2">
                            <li><a href="./fresa_engadir.php">Añadir Fresa</a></li>
                            <li><a href="./fresa_consultar.php">Consultar Fresa</a></li>
                            <li><a href="./fresa_historial.php">Historico</a></li>
                        </ul>
                    </li>
                    <?php endif; 
                    if ($acceso[accesocultivos]) :; ?>
                    <li class="nivel1"><a href="#" class="nivel1">Opción 3</a>
                        <ul class="nivel2">
                                <li><a href="#">Opción 3.1</a></li>
                                <li><a href="#">Opción 3.2</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <!--
                    <li class="nivel1"><a href="#" class="nivel1">Opción 4</a>
                        <ul>
                                <li><a href="#">Opción 4.1</a></li>
                                <li><a href="#">Opción 4.2</a></li>
                                <li><a href="#">Opción 4.3</a></li>
                        </ul>
                    </li>
                    <li class="nivel1">opcion5</a>
                    </li>
                    <li class="nivel1"><a href="#" class="nivel1">Opción 2</a>
	<ul class="nivel1">
		<li><a href="#">Opción 2.1</a></li>
		<li><a href="#">Opción 2.2</a></li>
		<li class="nivel2"><a class="nivel2" href="#">Opción 2.3 »</a>
			<ul class="nivel3">
				<li><a class="primera" href="#">Opción 2.3.1</a></li>
				<li><a href="#">Opción 2.3.2</a></li>
				<li><a href="http://www.idplus.org">idplus.org</a></li>
			</ul>
			</li>
		<li><a href="#">Opción 2.4</a></li>
		<li><a href="http://www.idplus.org">idplus.org</a></li>
	</ul>
        </li>-->
                </ul>
            </div>
        <br>
            
<?php
endforeach;
?>

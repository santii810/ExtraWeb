<!-- logout.php -->
<?php
// Comprobamos si tenemos alguna sesión iniciada
require 'funciones.php';
require 'conexion.php';
if (autentificado()) {
  if ( !isset($_SESSION) ){
    session_start();
  }
 
  unset($_SESSION['user']);
  session_destroy();
 
  echo 'Hasta la proxima <img src="http://netflie.es/wp-includes/images/smilies/icon_biggrin.gif" alt=":D" class="wp-smiley"> ';
 
} else {
    require './vista/menu.php';  
  echo 'No tienes ninguna sesión de usuario activa';
}
?>
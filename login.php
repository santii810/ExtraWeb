<link rel="icon" type="image/png" href="./images/icono.jpg" />
<meta charset="utf-8">
<link rel="stylesheet" href="./index.css">
<body background="./images/fondo_negro.jpg" link="#ffff00" vlink="#FFFFFF" alink="#FFFFFF">
<?php
require './conexion.php';
require './funciones.php';
// Comprobamos si hemos iniciado sesión con anterioridad
if (autentificado()) {
    echo '<a href="logout.php" class="salir">Cerrar Sesion</a>';
    exit;
// Comprobamos si hemos recibido algo del formulario de login y que estos datos no sean vacios
} else if ($_POST) {
  if (!empty($_POST['username']) && !empty($_POST['passwd']) ) {
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    if ( login($username, $passwd) ) {
        header('Location: index.php');
      exit;
    } else {
      echo '<div id="error_autenticado">Datos incorrectos</div>';
    }
  } else {
    echo 'No has rellenado todos los campos';
  }
}
/* Si no habíamos iniciado sesión o lo hemos intentado pero ha fallado el proceso entonces mostrará el formulario de login. */
formulario_login();
?>
</body>
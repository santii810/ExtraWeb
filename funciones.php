<?php
/* Funcion de autentificado
 */
function autentificado(){
  // Si no hay una sesión iniciada, lo hacemos
  if ( !isset($_SESSION) ){
    session_start();
  }
 
  // If existe la variable de sesión "user" entonces es que un usuario ha iniciado sesión
  if ( isset($_SESSION['user']) ){
    return true;
  } else {
    return false;
  }
}
//formurio de autentificacion
function formulario_login() {
    echo '<form action="login.php" method="post">';
    echo '<table align="center" width="225" cellspacing="2" cellpadding="2" border="0" id="autentificado"> ';
    echo "<tr>";
    echo '<td colspan="2" align="center">Introduce tu clave de acceso</td>'; 
    echo '</tr> ';
    echo '<tr> ';
    echo '<td align="right">USUARIO:</td> ';
    echo '<td><input type="Text" name="username" size="8" maxlength="50"></td> ';
    echo '</tr>'; 
    echo '<tr> ';
    echo '<td align="right">CONTRASEÑA:</td>' ;
    echo '<td><input type="password" name="passwd" size="8" maxlength="50"></td>';
    echo '</tr>'; 
    echo '<tr>'; 
    echo '<td colspan="2" align="center"><input type="Submit" value="ENTRAR"></td>'; 
    echo '</tr>'; 
    echo '</table>'; 
    echo '</form>';
}
function login($username, $passwd){
  if ( !isset($_SESSION) ){
    session_start();
  }

  // Nos conectamos a la base de datos
  $conn = abrir_conexion();
 
  // Evitemos un poco de SQL-injection
 // $username = mysql_real_escape_string($username);
//  $passwd = mysql_real_escape_string($passwd);
 
  // comprobamos si el nombre de usuario es exclusivo
  $result = $conn->query("select * from usuarios
                          where nombre='$username'
                          and pass='$passwd'");
 
  // Miramos si hemos podido hacer la consulta a la base de datos
  if ( !$result ){
    return false;
  }
 
  // Si hemos autenticado al usuario entonces lo registramos en la sesión
  if ( $result->num_rows > 0 ){
    $_SESSION['user'] = $username;
    return true;
  } else {
    return false;
  }
}
/* Mete en $sitios os nombres dos locales 
 * para mostralos no formulario de ingreso*/
function buscar_sitios(){
    $conexion = abrir_conexion();
    $sentencia = "SELECT Nomlocal FROM local";
    $resultado = mysqli_query($conexion, $sentencia);
    if (!$resultado) {
        return FALSE;
    } else {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $sitios[] = $fila;
        }
        return $sitios;
    }
}
/* Funcion igual a anterior pero saca 2 resultados, ID de usuario e nombre */
function buscar_usuarios(){
    $conexion = abrir_conexion();
    $sentencia = "SELECT nombre, usuID FROM usuarios";
    $resultado = mysqli_query($conexion, $sentencia);
    if (!$resultado) {
        return FALSE;
    } else {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $usuarios[] = $fila;
        }
        return $usuarios;
    }
}
// añade os datos de 1 extra, devolve true si se añadiron correctamente
function engadir_extra($fecha, $usuario, $sitio, $propina, $cobro, $notas, $tempo, $pago_asoc){
    $conexion = mysqli_connect(SERVIDOR, USUARIO, PASS, BD);
        $sql = "INSERT INTO `ServidorWeb`.`extras` (`usuario`, `extraID`, `fecha`,"
                . " `local`, `tempo`, `precio`, `notas`, `pago_asoc`, `propina`)"
                . " VALUES ('$usuario', NULL, '$fecha', '$sitio', '$tempo', '$cobro', '$notas', '$pago_asoc', '$propina');";
        $resultado = mysqli_query($conexion, $sql);
	if ($resultado){
            return TRUE;
        }
}
/* Obten as ultimas n extras
 * n e un parametro que se configura na sentencia sql
 * proximamente intentarei que o usuario poida dar n como variable */
function obtener_extras($conexion){
    $conexion = mysqli_connect(SERVIDOR, USUARIO, PASS, BD);
    session_start();
    $usuID = usuario_a_usuID($_SESSION["user"]);
    $sql = "select * from extras where usuario='$usuID' order by `extraID` DESC";
    // $sql = "select * from extras order by `extraID` DESC limit 20";
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $fila["precio"] = strtr($fila["precio"], ".", ",") . "€";
        $fila["propina"] = strtr($fila["propina"], ".", ",") . "€";
        $fila["usuario"] = nombre_usuario($fila["usuario"]);
        $extras[] = $fila;
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    return $extras;
}
/* recive extraS.nombre (que e o mismo que usuario.usuID)
 * e devolve o relativo usuario.nombre como string 
 */
function nombre_usuario($usuID){
    $conexion = mysqli_connect(SERVIDOR, USUARIO, PASS, BD);
    $sql = "select nombre from usuarios where usuID = '$usuID'";
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)){
        $nombre = $fila[nombre];
    }
    return $nombre;
}
/* Busca unha extra por un ID
 * retorna as extras selecionadas por ID*/
function buscar_extra($extraID){
    $conexion = abrir_conexion();
    $sql = "select * from extras WHERE extraID = '$extraID'";
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $fila["precio"] = strtr($fila["precio"], ".", ",") . "€";
        $fila["propina"] = strtr($fila["propina"], ".", ",") . "€";
        $fila["usuario"] = nombre_usuario($fila["usuario"]);
        $extras = $fila;
    }
    return $extras;
}
/* Borra a extra dada por "extraID" */
function borrar_extra($extraID){
    $conexion = abrir_conexion();
    $sql = "DELETE FROM extras WHERE extraID = '$extraID'";
    $resultado = mysqli_query($conexion, $sql);
    return $resultado;
}
/* Filtra extras segun os parametros seleccionados polo usuario
 * Devolve false si non se encontrou ningun valor
 * Si a sentencia devolve algun resultado devolve o array directamente  */
function filtrar_extras($usuario, $ano, $sitio) {
    $conexion = abrir_conexion();
    //$sql = "select * from extras WHERE YEAR(fecha) = '$ano' AND local = '$sitio' AND usuario = '$usuario' ";
    $sql = crear_sql_filtrar($usuario, $ano, $sitio);
    $resultado = mysqli_query($conexion, $sql);
    if (!resultado) {
        return FALSE;
    }
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $fila["precio"] = strtr($fila["precio"], ".", ",") . "€";
        $fila["propina"] = strtr($fila["propina"], ".", ",") . "€";
        $fila["usuario"] = nombre_usuario($fila["usuario"]);
        $extras[] = $fila;
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    return $extras;
}/*
function crear_sql_filtrar($usuario, $ano, $sitio){

}*/
// añade os datos de 1 extra, devolve true si se añadiron correctamente
function engadir_fresa($fecha, $usuario, $caixas){
    $conexion = mysqli_connect(SERVIDOR, USUARIO, PASS, BD);
        $sql = "INSERT INTO `ServidorWeb`.`fresa` (`usuario`, `fecha`, `caixas`)"
                . " VALUES ('$usuario', '$fecha', '$caixas');";
        $resultado = mysqli_query($conexion, $sql);
	if ($resultado){
            return TRUE;
        }
}
/* Obten as ultimas n extras
 * n e un parametro que se configura na sentencia sql
 * proximamente intentarei que o usuario poida dar n como variable */
function obtener_fresa($conexion){
    $conexion = mysqli_connect(SERVIDOR, USUARIO, PASS, BD);
    session_start();
    $usuID = usuario_a_usuID($_SESSION["user"]);
    $sql = "select * from fresa where usuario='$usuID' order by `fecha` DESC";
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $fila["usuario"] = nombre_usuario($fila["usuario"]);
        $fresa[] = $fila;
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    return $fresa;
}
/* Busca unha extra por un ID
 * retorna as extras selecionadas por ID*/
function buscar_fresa($fresaID){
    $conexion = abrir_conexion();
    $sql = "select * from fresa WHERE fresaID = '$fresaID'";
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $fila["usuario"] = nombre_usuario($fila["usuario"]);
        $fresa = $fila;
    }
    return $fresa;
}
/* Borra a extra dada por "extraID" */
function borrar_fresa($fresaID){
    $conexion = abrir_conexion();
    $sql = "DELETE FROM fresa WHERE fresaID = '$fresaID'";
    $resultado = mysqli_query($conexion, $sql);
    return $resultado;
}
function usuario_a_usuID($nombre) {
    $conexion = abrir_conexion();
    $sql = "select usuID from usuarios where nombre = '$nombre'";
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)){
        $usuID = $fila[usuID];
    }
    return $usuID;
}
/* Devuelve 1 unico dato dependiendo de la sentencia que se le pase como variable
la sentencia deve devolver en una de la columnas de la taba el nombre "dato"*/
function devolver_consulta($ano, $usuID, $conexion, $sql) {
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)){
        $dato = $fila[dato];
    }
    return $dato;
}
/* Devuelve el numero de extras que realizo dicho usuario dicho año*/
function num_extras($ano, $usuID, $conexion){
    $sql = "select count(*) AS dato from extras where usuario = '$usuID' and YEAR(fecha)='$ano'";
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)){
        $dato = $fila[dato];
    }
    return $dato;
}
function num_extras_total($usuID, $conexion){
    $sql = "select count(*) AS dato from extras where usuario = '$usuID'";
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)){
        $dato = $fila[dato];
    }
    return $dato;
}
/* Devuelve los datos "local" y "media de ganado" como array*/
function numero_extras_local($ano, $usuID, $conexion){
    $sql = "select local, count(precio) as numero from extras where usuario = '$usuID' and YEAR(fecha)='$ano' group by local order by numero desc";
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $datos[] = $fila;
    }
    return $datos;
}
function total_extras_local($usuID, $conexion){
    $sql = "select local, count(precio) as numero from extras where usuario = '$usuID' group by local order by numero desc";
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $datos[] = $fila;
    }
    return $datos;
}
function ingresos_local($ano, $usuID, $conexion){
        $sql = "select local, sum(precio) as ingresos from extras where usuario = '$usuID' and YEAR(fecha)='$ano' group by local order by ingresos desc";
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $datos[] = $fila;
    }
    return $datos;
}
function total_ingresos_local($usuID, $conexion){
        $sql = "select local, sum(precio) as ingresos from extras where usuario = '$usuID' group by local order by ingresos desc";
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $datos[] = $fila;
    }
    return $datos;
}
function propina_local($ano, $usuID, $conexion){
        $sql = "select local, sum(propina) as ingresos from extras where usuario = '$usuID' and YEAR(fecha)='$ano' group by local order by ingresos desc";
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $datos[] = $fila;
    }
    return $datos;
}
function total_propina_local($usuID, $conexion){
        $sql = "select local, sum(propina) as ingresos from extras where usuario = '$usuID' group by local order by ingresos desc";
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $datos[] = $fila;
    }
    return $datos;
}
/* Fucion que modifica 1 dato de la base de datos
 * Trae asociado una sentencia sql para cada tipo de modificacion
 * devuelve false si falla la operacion
 * devuelce el ExtraID si es correcta 
 * este ExtraID se usa para mostrar los datos ya modificados */
function modificar_dato($sql, $conexion){
    $resultado = mysqli_query($conexion, $sql);
    return $resultado;
}
function engadir_local($nombre, $direccion, $descripcion) {
    $conexion = mysqli_connect(SERVIDOR, USUARIO, PASS, BD);
    $sql = "INSERT INTO `ServidorWeb`.`local` (`Nomlocal` ,`Direccion` ,`descripcion`) VALUES ('$nombre', '$direccion', '$descripcion');";
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado){
        return TRUE;  
    }
}
function obtener_extras_ordenadas($conexion, $parametro1, $modo1, $parametro2, $modo2){
    session_start();
    $usuID = usuario_a_usuID($_SESSION["user"]);
    $sql = "select * from extras where usuario='$usuID' order by '$parametro1' '$modo1', '$parametro2' '$modo2'";
    $sql = str_replace("'", "", $sql);
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $fila["precio"] = strtr($fila["precio"], ".", ",") . "€";
        $fila["propina"] = strtr($fila["propina"], ".", ",") . "€";
        $fila["usuario"] = nombre_usuario($fila["usuario"]);
        $extras[] = $fila;
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    return $extras;    
}

function devolver_sql_filtrar($ano, $local, $pago){
    session_start();
    $usuID = usuario_a_usuID($_SESSION[user]);
    if ($ano) {
        if ($pago){
            if ($local){
                $sql = "select * from extras WHERE usuario='$usuID' && YEAR(fecha) = '$ano' && local = '$local' && pago_asoc = '$pago' ORDER BY fecha ASC;";
            }else{
                $sql = "select * from extras WHERE usuario='$usuID' && YEAR(fecha) = '$ano' && pago_asoc = '$pago' ORDER BY fecha ASC;";
            }
        }else{
            if ($local){
                $sql = "select * from extras WHERE usuario='$usuID' && YEAR(fecha) = '$ano' && local = '$local' ORDER BY fecha ASC;";
            }else{
                $sql = "select * from extras WHERE usuario='$usuID' && YEAR(fecha) = '$ano' ORDER BY fecha ASC;";  
            }
        }
    }else{
        if ($pago){
            if ($local){
                $sql = "select * from extras WHERE usuario='$usuID' && local = '$local' && pago_asoc = '$pago' ORDER BY fecha ASC;";
            }else{
                $sql = "select * from extras WHERE usuario='$usuID' && pago_asoc = '$pago' ORDER BY fecha ASC;";
            }
        }else{
            if ($local){
                $sql = "select * from extras WHERE usuario='$usuID' && local = '$local' ORDER BY fecha ASC;";
            }else{
                $sql = "select * from extras WHERE usuario='$usuID' ORDER BY fecha ASC;";              
        }
    }
    }
    //$sql = str_replace("'", "", $sql);
    return $sql;
}
function devolver_extras_filtradas($conexion, $sql){
    session_start();
    $usuID = usuario_a_usuID($_SESSION["user"]);
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $fila["precio"] = strtr($fila["precio"], ".", ",") . "€";
        $fila["propina"] = strtr($fila["propina"], ".", ",") . "€";
        $fila["usuario"] = nombre_usuario($fila["usuario"]);
        $extras[] = $fila;
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    return $extras;
}
function ver_acceso($usuario){
    $conexion = abrir_conexion();
    $usuID = usuario_a_usuID($usuario);
    $sql = "select * from usuarios where usuID='$usuID'";
    $sql = str_replace("'", "", $sql);
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $acceso[] = $fila;
    }
    return $acceso;
}
?>
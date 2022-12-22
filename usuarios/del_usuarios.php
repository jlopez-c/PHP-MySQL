<a href="../index.html">INICIO</a>
<span> - - - </span>
<a href="../usuarios.html">ATRAS</a>

<?php

function listar_usuarios() {

    $conexion = mysqli_connect("localhost", "root", "rootroot")
    or die ("No se puede conectar a la base de datos");

    mysqli_select_db($conexion, "inmobiliaria")
    or die ("No se puede seleccionar la base de datos");

    $query = "
        SELECT * FROM usuario
        ";
    
    $consulta = mysqli_query ($conexion,$query)
        or die ("Fallo en la consulta");

 
    while ($resultado = mysqli_fetch_array($consulta)) {
        $id = $resultado['usuario_id'];
        $nombres = $resultado['nombres'];
        
        echo "<option value='$id'>$nombres</option>";

    }

    mysqli_close($conexion);

    return $nombres;

}

function pedir_pass($id, $clave) {
   
    $conexion = mysqli_connect("localhost", "root", "rootroot")
    or die ("No se puede conectar a la base de datos");

    mysqli_select_db($conexion, "inmobiliaria")
    or die ("No se puede seleccionar la base de datos");

    $query = "
        SELECT * FROM usuario
        WHERE usuario_id = $id
        ";
    
    $consulta = mysqli_query ($conexion,$query)
        or die ("Fallo en la consulta");

    $resultado = mysqli_fetch_array($consulta);

    $clave_db = $resultado['clave'];

    $clave_ok = 0;

    if ($clave_db == $clave){
        $clave_ok = 1;
    }

    mysqli_close($conexion);

    return $clave_ok;
}

function del_usuario($id) {
    $conexion = mysqli_connect("localhost", "root", "rootroot")
        or die ("No se puede conectar a la base de datos");

        mysqli_select_db($conexion, "inmobiliaria")
            or die ("No se puede seleccionar la base de datos");

        $query = "
            DELETE FROM usuario
            WHERE usuario_id = $id
        ";

        if (mysqli_query($conexion, $query)) {
            echo "Usuario borrado correctamente";
        } else {
            echo "No se ha podido borrar";
        }

        mysqli_close($conexion);
}

?>

<h3>¿Que usuario quieres eliminar?</h3>

<form action="del_usuarios.php" method="POST">
    <select name="usuarios">
        <option value=0 selected> - - - - - </option>
        <?php listar_usuarios() ?>
    </select>
    <input type="submit" value="Aceptar" name="aceptar">
</form>

<?php
// Para que la variable id este disponible el resto del documento ya que si no no podemos hacer la comprobacion de cotnraseña del usuario;
session_start();
// $_SESSION['id'] = 0;

if (isset($_REQUEST['aceptar'])) {

    $id = $_REQUEST['usuarios'];
    $_SESSION['id'] = $id;

    echo "<form action='#' method='POST'>";
    echo    "<p>Introduce la contraseña de este usuario: <input type='password' name='clave2'></p>\n";
    echo    "<p><input type='submit' value='Comprobar' name='comprobar'></p>";
    echo "</form>";

}

if (isset($_REQUEST['comprobar'])) {

    $id =  $_SESSION['id'];
    $clave = $_REQUEST['clave2'];

    $clave_ok = pedir_pass($id, $clave);

   if ($clave_ok == 1) {
        del_usuario($id);
   } else {
        echo "Contraseña incorrecta";
   }
} 

?>
<a href="../index.html">INICIO</a>
<span> - - - </span>
<a href="../usuarios.html">ATRAS</a>

<form action="add_usuarios.php" method="POST">
    <h1>Agregar nuevo usuario:</h1>
    <p>Nombre y apellido:  <input type="text" name="nombres"></p>
    <p>Correo: <input type="email" name="correo"></p>
    <p>Clave: <input type="password" name="clave"></p>
    <p><input type="submit" value="Agregar" name="agregar"></p>
</form>

<?php

if(isset($_REQUEST['agregar'])){

    $nombre = trim(strip_tags($_REQUEST['nombres']));
    $correo = trim(strip_tags($_REQUEST['correo']));
    $clave = trim(strip_tags($_REQUEST['clave']));

$conexion = mysqli_connect("localhost", "root", "rootroot")
    or die ("No se puede conectar a la base de datos");
 
 mysqli_select_db($conexion, "inmobiliaria")
    or die ("No se puede seleccionar la base de datos");
 
 $query = "
     INSERT INTO usuario VALUES (NULL, '$nombre', '$correo', '$clave')
 ";
 
//echo $query; //Para comprobar errores mysql
 
if (mysqli_query($conexion, $query)) {
    echo "Usuario dado de alta correctamente.";
} else {
    echo "No se ha podido dar de alta al usuario.";
}

//Cerrar conexión
mysqli_close($conexion);

}

?>
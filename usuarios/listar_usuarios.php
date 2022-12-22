<a href="../index.html">INICIO</a>
<span> - - - </span>
<a href="../usuarios.html">ATRAS</a>

<?php

$conexion = mysqli_connect("localhost", "root", "rootroot")
   or die ("No se puede conectar a la base de datos");

mysqli_select_db($conexion, "inmobiliaria")
   or die ("No se puede seleccionar la base de datos");

$query = "
    SELECT * FROM usuario
";

//echo $query; //Para comprobar errores mysql

$consulta = mysqli_query ($conexion,$query)
or die ("Fallo en la consulta");

while ($resultado = mysqli_fetch_array($consulta)){
    echo "<p>".$resultado['usuario_id']." - ".$resultado['nombres']." - ".$resultado['correo']." - ".$resultado['clave']."</p>";
}

//Cerrar conexión
mysqli_close($conexion);

?>
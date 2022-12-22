<a href="../index.html">INICIO</a>
<span> - - - </span>
<a href="../usuarios.html">ATRAS</a>

<h3>Buscar Usuarios</h3>

<form action="" method="post">
    <p>Nombre: <input name="nombre" type="text"> <input type="submit" name="buscar-nom" value="Buscar"></p>
    <p>Email: <input name="mail" type="mail"> <input type="submit" name="buscar-mail" value="Buscar"></p>
</form>

<?php

if (isset($_REQUEST['buscar-nom'])){
    $nombre = $_REQUEST['nombre'];
    //echo $nombre;
    
    if ($nombre == "") {
        echo "Introduce al menos 1 caracter para realizar la busqueda";
    } else {
        $conexion = mysqli_connect("localhost", "root", "rootroot")
        or die ("No se puede conectar a la base de datos");
        
        mysqli_select_db($conexion, "inmobiliaria")
            or die ("No se puede seleccionar la base de datos");
        
        $query = "
            SELECT * FROM usuario
            WHERE nombres LIKE '%$nombre%'
        ";

        //echo $query; //Para comprobar errores mysql
        $consulta = mysqli_query ($conexion,$query)
        or die ("Fallo en la consulta");

        $rows = mysqli_num_rows($consulta);

        if ($rows == 0) {
            echo "No hay resultados para tu busqueda.\n";
        } else {
            while ($resultado = mysqli_fetch_array($consulta)){
                echo "<p>".$resultado['usuario_id']." - ".$resultado['nombres']." - ".$resultado['correo']." - ".$resultado['clave']."</p>";
            }
        }
        
        mysqli_close($conexion);
    }


} else if (isset($_REQUEST['buscar-mail'])) {
    $correo = $_REQUEST['mail'];
    //echo $nombre;
    
    if ($correo=="") {
        echo "Introduce una direccion de correo valida para realizar la busqueda";
    } else {
        $conexion = mysqli_connect("localhost", "root", "rootroot")
        or die ("No se puede conectar a la base de datos");
     
        mysqli_select_db($conexion, "inmobiliaria")
            or die ("No se puede seleccionar la base de datos");
        
        $query = "
            SELECT * FROM usuario
            WHERE correo LIKE '$correo'
        ";
        
        //echo $query; //Para comprobar errores mysql
        $consulta = mysqli_query ($conexion,$query)
        or die ("Fallo en la consulta");

        $rows = mysqli_num_rows($consulta);

        if ($rows == 0) {
            echo "No hay resultados para tu busqueda.\n";
        } else {
            while ($resultado = mysqli_fetch_array($consulta)){
                echo "<p>".$resultado['usuario_id']." - ".$resultado['nombres']." - ".$resultado['correo']." - ".$resultado['clave']."</p>";
            }
        }
        
        mysqli_close($conexion);
    }
   
}


?>

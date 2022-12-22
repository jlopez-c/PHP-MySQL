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

    function datos_usuario($id) {

        $conexion = mysqli_connect("localhost", "root", "rootroot")
        or die ("No se puede conectar a la base de datos");

        mysqli_select_db($conexion, "inmobiliaria")
        or die ("No se puede seleccionar la base de datos");

        $query = "
            SELECT * FROM usuario
            WHERE usuario_id = $id
        ";

        //echo $query; //Para comprobar errores mysql

        $consulta = mysqli_query ($conexion,$query)
        or die ("Fallo en la consulta");

       $resultado = mysqli_fetch_array($consulta);

       $nombre = $resultado['nombres'];
       $correo = $resultado['correo'];
       $clave = $resultado['clave'];

        //echo "<p>".$resultado['usuario_id']." - ".$resultado['nombres']." - ".$resultado['correo']." - ".$resultado['clave']."</p>";

        echo "<form action='#' method='POST'>";
        echo     "<p>$nombre:  <input type='text' name='nombre-mod'></p>";
        echo     "<p>$correo: <input type='email' name='correo-mod'></p>";
        echo     "<p>$clave: <input type='password' name='clave-mod'></p>";
        echo     "<p><input type='submit' value='Modificar' name='modificar'></p>";
        echo "</form>";
        
        //Cerrar conexión
        mysqli_close($conexion);
    }

    function modificar_usuario($id){
        
        $nombre_mod = $_REQUEST['nombre-mod'];
        $correo_mod = $_REQUEST['correo-mod'];
        $clave_mod = $_REQUEST['clave-mod'];

        // echo "Estos son los datos que vas a modificar";
        // echo $nombre_mod."-".$correo_mod."-".$clave_mod;

        $conexion = mysqli_connect("localhost", "root", "rootroot")
        or die ("No se puede conectar a la base de datos");

        mysqli_select_db($conexion, "inmobiliaria")
        or die ("No se puede seleccionar la base de datos");

        switch(true) {
            case ($nombre_mod != "" && $correo_mod != "" && $clave_mod != "" ):
                $query = "  UPDATE usuario 
                            SET nombres = '$nombre_mod',
                            correo = '$correo_mod',
                            clave = '$clave_mod'
                            WHERE usuario_id = $id ";
                break;
            case ($nombre_mod == "" && $correo_mod != "" && $clave_mod != "" ):
                $query = "  UPDATE usuario 
                            SET correo = '$correo_mod',
                            clave = '$clave_mod'
                            WHERE usuario_id = $id ";
                break;
            case ($nombre_mod != "" && $correo_mod == "" && $clave_mod != "" ):
                $query = "  UPDATE usuario
                            SET nombres = '$nombre_mod',
                            clave = '$clave_mod'
                            WHERE usuario_id = $id ";
                break;
            case ($nombre_mod != "" && $correo_mod != "" && $clave_mod == "" ):
                $query = "  UPDATE usuario
                            SET nombres = '$nombre_mod',
                            correo = '$correo_mod'
                            WHERE usuario_id = $id ";
                break;
            case ($nombre_mod == "" && $correo_mod == "" && $clave_mod != "" ):
                $query = "  UPDATE usuario
                            SET clave = '$clave_mod'
                            WHERE usuario_id = $id ";
                break;
            case ($nombre_mod != "" && $correo_mod == "" && $clave_mod == "" ):
                $query = "  UPDATE usuario
                            SET nombres = '$nombre_mod'
                            WHERE usuario_id = $id ";
                break;
            case ($nombre_mod == "" && $correo_mod != "" && $clave_mod == "" ):
                $query = "  UPDATE usuario
                            SET correo = '$correo_mod'
                            WHERE usuario_id = $id ";
                break;
            }

        //echo $query; //Para comprobar errores mysql
        
        if (mysqli_query($conexion, $query)) {
            echo "Usuario actualizado correctamente";
        } else {
            echo "No se ha podido actualizar";
        }

        mysqli_close($conexion);

    }

?>


<h3>¿Que usuario quieres modificar?</h3>

<form action="mod_usuarios.php">
    <select name="usuarios">
        <option value=0 selected> - - - - - </option>
        <?php listar_usuarios() ?>
    </select>
    <input type="submit" value="Aceptar" name="aceptar">
</form>



<?php

if (isset($_REQUEST['aceptar'])) {
    $id = $_REQUEST['usuarios'];
    //print ("<pre>"); print_r ($_REQUEST); print ("</pre>");
    if ($id != 0) {
        datos_usuario($id);
        if (isset($_REQUEST['modificar'])) {
            modificar_usuario($id);
        }
    }
}

?>
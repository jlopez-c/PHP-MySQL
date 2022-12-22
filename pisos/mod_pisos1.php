<a href="../index.html">INICIO</a>
<span> - - - </span>
<a href="mod_pisos.php">ATRAS</a>



<?php

function propietario_usuario($usuario_id) {
    if ($usuario_id == 0) {
            $nombre = "EN VENTA";
            return $nombre;
    } else {
        $conexion = mysqli_connect("localhost", "root", "rootroot")
        or die ("No se puede conectar a la base de datos");
        mysqli_select_db($conexion, "inmobiliaria")
        or die ("No se puede seleccionar la base de datos");
        $query = "
            SELECT * FROM usuario
            WHERE usuario_id = $usuario_id
            ";
        
        $consulta = mysqli_query ($conexion,$query)
        or die ("Fallo en la consulta");
        $resultado = mysqli_fetch_array($consulta);
            $id = $resultado['usuario_id'];
            $nombre = $resultado['nombres'];
        mysqli_close($conexion);
        return $nombre;
    }
}

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
}

function datos_piso($id_select) {

    $conexion = mysqli_connect("localhost", "root", "rootroot")
    or die ("No se puede conectar a la base de datos");

    mysqli_select_db($conexion, "inmobiliaria")
    or die ("No se puede seleccionar la base de datos");

    $query = "
        SELECT * FROM piso
        WHERE codigo_piso = $id_select
    ";

    //echo $query;

    $consulta = mysqli_query ($conexion,$query)
    or die ("Fallo en la consulta");

    $resultado = mysqli_fetch_array($consulta);

    $codigo_piso = $resultado['codigo_piso'];
    $calle = $resultado['calle'];
    $numero = $resultado['numero'];
    $piso = $resultado['piso'];
    $puerta = $resultado['puerta'];
    $cp = $resultado['cp'];
    $metros = $resultado['metros'];
    $zona = $resultado['zona'];
    $precio = $resultado['precio'];
    $imagen = $resultado['imagen'];
    $usuario_id = $resultado['usuario_id'];

    $propietario = propietario_usuario($usuario_id);

    //echo "<p>".$resultado['usuario_id']." - ".$resultado['nombres']." - ".$resultado['correo']." - ".$resultado['clave']."</p>";

    echo "<form action='mod_pisos2.php' method='POST'>";

    echo     "<input type='hidden' name='cod-mod' value='$codigo_piso'>";

    echo     "<p>Calle:  <input type='text' name='calle-mod' value='$calle'></p>";

    echo     "<p>Número: <input type='number' name='numero-mod' value='$numero'></p>";

    echo     "<p>Piso: <input type='number' name='piso-mod' value='$piso'></p>";

    echo     "<p>Puerta:  <input type='text' name='puerta-mod' value='$puerta'></p>";

    echo     "<p>CP: <input type='number' name='cp-mod' value='$cp'></p>";

    echo     "<p>Metros: <input type='number' name='metros-mod' value='$metros'></p>";

    echo     "<p>Zona:  <input type='text' name='zona-mod' value='$zona'></p>";

    echo     "<p>Precio: <input type='floatval' name='precio-mod' value='$precio'></p>";


    echo     "<p>Propietario: $propietario: ";
    echo        "<select name='propietario-mod'>";
    echo            "<option value=0 selected> - - - - - </option>";
    echo            listar_usuarios();
    echo        "</select>";
    echo     "</p>";
    echo     "<p><input type='submit' value='Modificar' name='modificar'></p>";          
    echo "</form>";

    mysqli_close($conexion);
}

?>

<?php

if(isset($_REQUEST['aceptar'])) {
    $id_select = $_REQUEST['pisos'];
    datos_piso($id_select);
}

?>
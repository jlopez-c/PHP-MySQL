<a href="../index.html">INICIO</a>
<span> - - - </span>
<a href="mod_pisos.php">ATRAS</a>

<?php

if (isset($_REQUEST['modificar'])) {
    
    $cod_piso = $_REQUEST['cod-mod'];
    $calle = $_REQUEST['calle-mod'];
    $numero = $_REQUEST['numero-mod'];
    $piso = $_REQUEST['piso-mod'];
    $puerta = $_REQUEST['puerta-mod'];
    $cp = $_REQUEST['cp-mod'];
    $metros = $_REQUEST['metros-mod'];
    $zona = $_REQUEST['zona-mod'];
    $precio = $_REQUEST['precio-mod'];
    $propietario = $_REQUEST['propietario-mod'];

    $conexion = mysqli_connect("localhost", "root", "rootroot")
    or die ("No se puede conectar a la base de datos");

    mysqli_select_db($conexion, "inmobiliaria")
    or die ("No se puede seleccionar la base de datos");

    $query = "  UPDATE piso 
                SET calle = '$calle',
                numero = $numero,
                piso = $piso,
                puerta = '$puerta',
                cp = $cp,
                metros = $metros,
                zona = '$zona',
                precio = $precio,
                usuario_id = $propietario
                WHERE codigo_piso = $cod_piso ";

    //echo "<p>$query</p>";
    
    if (mysqli_query($conexion, $query)) {
        echo "Piso actualizado correctamente";
    } else {
        echo "No se ha podido actualizar";
    }
    mysqli_close($conexion);
}

?>
<a href="../index.html">INICIO</a>
<span> - - - </span>
<a href="../pisos.html">ATRAS</a>

<?php

function listar_pisos() {

    $conexion = mysqli_connect("localhost", "root", "rootroot")
    or die ("No se puede conectar a la base de datos");

    mysqli_select_db($conexion, "inmobiliaria")
    or die ("No se puede seleccionar la base de datos");

    $query = "
        SELECT * FROM piso
        ";
    
    $consulta = mysqli_query ($conexion,$query)
        or die ("Fallo en la consulta");

    while ($resultado = mysqli_fetch_array($consulta)) {
        $codigo_piso = $resultado['codigo_piso'];
        $calle = $resultado['calle'];
        $numero = $resultado['numero'];
        $piso = $resultado['piso'];
        $puerta = $resultado['puerta'];
        $cp = $resultado['cp'];
        $zona = $resultado['zona'];

        echo "<option value='$codigo_piso'>$codigo_piso - C/$calle, nº$numero, $piso$puerta, cp: $cp - $zona</option>";

    }

    mysqli_close($conexion);

    //return $nombres;

}

function del_piso($codigo_piso) {
    $conexion = mysqli_connect("localhost", "root", "rootroot")
        or die ("No se puede conectar a la base de datos");

        mysqli_select_db($conexion, "inmobiliaria")
            or die ("No se puede seleccionar la base de datos");

        $query = "
            DELETE FROM piso
            WHERE codigo_piso = $codigo_piso
        ";

        if (mysqli_query($conexion, $query)) {
            echo "Piso borrado correctamente";
        } else {
            echo "No se ha podido borrar";
        }

        mysqli_close($conexion);
}

?>

<h3>¿Que piso quieres eliminar?</h3>

<form action="#" method="POST">
    <select name="pisos">
        <option value=0 selected> - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </option>
        <?php listar_pisos() ?>
    </select>
    <input type="submit" value="Borrar" name="borrar">
</form>

<?php

if(isset($_REQUEST['borrar'])) {
    $codigo_piso = $_REQUEST['pisos'];
    del_piso($codigo_piso);
}


?>
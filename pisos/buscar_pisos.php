<a href="../index.html">INICIO</a>
<span> - - - </span>
<a href="../pisos.html">ATRAS</a>


<?php

function desplegable_nombres() {
    $conexion = mysqli_connect("localhost", "root", "rootroot")
    or die ("No se puede conectar a la base de datos");

    mysqli_select_db($conexion, "inmobiliaria")
    or die ("No se puede seleccionar la base de datos");

    $query = "
        SELECT * FROM usuario
    ";

    $consulta = mysqli_query ($conexion,$query)
    or die ("Fallo en la consulta");

    echo "<select name='propietario'>";
        echo "<option></option>";
    while ($resultado = mysqli_fetch_array($consulta)){
        echo "<option value=".$resultado['usuario_id'].">".$resultado['nombres']."</option>";
        
    }
    echo "</select>";

    mysqli_close($conexion);

}

function nom_usuario($id_usuario) {
    $conexion = mysqli_connect("localhost", "root", "rootroot")
    or die ("No se puede conectar a la base de datos");

    mysqli_select_db($conexion, "inmobiliaria")
    or die ("No se puede seleccionar la base de datos");

    $query = "
        SELECT nombres FROM usuario
        WHERE usuario_id = $id_usuario
        ";
    
    $consulta = mysqli_query ($conexion,$query)
        or die ("Fallo en la consulta");

    $resultado = mysqli_fetch_array($consulta);

    $nombres = $resultado['nombres'];
    
    mysqli_close($conexion);

    return $nombres;
}

function buscar_piso($col, $dato) {
    $conexion = mysqli_connect("localhost", "root", "rootroot")
    or die ("No se puede conectar a la base de datos");

    mysqli_select_db($conexion, "inmobiliaria")
    or die ("No se puede seleccionar la base de datos");

    if ($col == "usuario_id" && $dato == 0) {
        $query = "
        SELECT * FROM piso
        WHERE $col IS NULL
    ";
    } else {
        $query = "
        SELECT * FROM piso
        WHERE $col = '$dato'
    ";
    }

    //echo $query;

    $consulta = mysqli_query ($conexion,$query)
    or die ("Fallo en la consulta");

    $rows = mysqli_num_rows($consulta);
    //echo "Este es tu numero de filas".$rows;

    echo "<table>";
    for ($i = 0; $i < $rows; $i++){
        $resultado = mysqli_fetch_array($consulta);
        echo "<tr>";
            echo "<td>".$resultado['codigo_piso']."</td>";
            echo "<td>Calle: ".$resultado['calle']."</td>";
            echo "<td>Nº: ".$resultado['numero']."</td>";
            echo "<td>Piso: ".$resultado['piso']."</td>";
            echo "<td>Puerta: ".$resultado['puerta']."</td>";
            echo "<td>CP: ".$resultado['cp']."</td>";
            echo "<td>Metros: ".$resultado['metros']."m2</td>";
            echo "<td>Zona: ".$resultado['zona']."</td>";
            echo "<td>Precio: ".$resultado['precio']."</td>";
            echo "<td><img src='".$resultado['imagen']."' /></td>";
            //Si algun campo es NULL se deja de mostrar el resultado, asique comprobamos errores
            if ($resultado['usuario_id']) {
                echo "<td>Propietario: ".nom_usuario($resultado['usuario_id'])."</td>";
            } else {
                echo "<td>NO TIENE PROPIETARIO</td>";
            }
        echo "</tr>";
    }
echo "</table>";
}

?>

<h1>¿Qué piso quieres buscar?</h1>

<form action="buscar_pisos.php" method="GET">
    <p>Calle:  <input type="text" name="calle"> <input type="submit" value="Buscar" name="bs-calle"></p>
    <p>Nº: <input type="number" name="numero"> <input type="submit" value="Buscar" name="bs-numero"></p>
    <p>Piso: <input type="number" name="piso"> <input type="submit" value="Buscar" name="bs-piso"></p>
    <p>Puerta:  <input type="text" name="puerta"> <input type="submit" value="Buscar" name="bs-puerta"></p>
    <p>CP: <input type="number" name="cp"> <input type="submit" value="Buscar" name="bs-cp"></p>
    <p>Metros: <input type="number" name="metros"> <input type="submit" value="Buscar" name="bs-metros"></p>
    <p>Zona:  <input type="text" name="zona"> <input type="submit" value="Buscar" name="bs-zona"></p>
    <p>Precio: <input type="floatval" name="precio"> <input type="submit" value="Buscar" name="bs-precio"></p>
    <p>Propietario: <?php desplegable_nombres() ?> <input type="submit" value="Buscar" name="bs-prop"></p>
</form>


<?php

if(isset($_REQUEST['bs-calle'])) {
    $dato = $_REQUEST['calle'];
    buscar_piso('calle', $dato);
}

if(isset($_REQUEST['bs-numero'])) {
    $dato = $_REQUEST['numero'];
    buscar_piso('numero', $dato);
}

if(isset($_REQUEST['bs-piso'])) {
    $dato = $_REQUEST['piso'];
    buscar_piso('piso', $dato);
}

if(isset($_REQUEST['bs-puerta'])) {
    $dato = $_REQUEST['puerta'];
    buscar_piso('puerta', $dato);
}

if(isset($_REQUEST['bs-cp'])) {
    $dato = $_REQUEST['cp'];
    buscar_piso('cp', $dato);
}

if(isset($_REQUEST['bs-metros'])) {
    $dato = $_REQUEST['metros'];
    buscar_piso('metros', $dato);
}

if(isset($_REQUEST['bs-zona'])) {
    $dato = $_REQUEST['zona'];
    buscar_piso('zona', $dato);
}

if(isset($_REQUEST['bs-precio'])) {
    $dato = $_REQUEST['precio'];
    buscar_piso('precio', $dato);
}

if(isset($_REQUEST['bs-prop'])) {
    $dato = $_REQUEST['propietario'];
    buscar_piso('usuario_id', $dato);    
}

?>
<a href="../index.html">INICIO</a>
<span> - - - </span>
<a href="../pisos.html">ATRAS</a>

<style>
    table{
        border: solid black 1px;
    }

    td {
        border: solid red 1px;
        width: 100px;
        height: 100px;
    }

    img {
        width: 100%;
    }
</style>

<?php

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

?>

<?php

$conexion = mysqli_connect("localhost", "root", "rootroot")
   or die ("No se puede conectar a la base de datos");

mysqli_select_db($conexion, "inmobiliaria")
   or die ("No se puede seleccionar la base de datos");

$query = "
    SELECT * FROM piso
";

//echo $query; //Para comprobar errores mysql

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

//Cerrar conexión
mysqli_close($conexion);

?>
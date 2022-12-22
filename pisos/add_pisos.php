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

function subir_img() {

    $errores = "";
    $copiarFichero = false;

    if (is_uploaded_file ($_FILES['imagen']['tmp_name'])) {
       $nombreDirectorio = "C:/AppServ/www/inmobiliaria/pisos/img/";
       $nombreFichero = $_FILES['imagen']['name'];
       $copiarFichero = true;

       $nombreCompleto = $nombreDirectorio . $nombreFichero;

        // Si ya existe un fichero con el mismo nombre, renombrarlo
       if (is_file($nombreCompleto))
       {
          $idUnico = time();
          $nombreFichero = $idUnico . "-" . $nombreFichero;
          echo  "---".$nombreFichero."---";
       }
    } 
//El fichero supera el limite maximo establecido.
    else if ($_FILES['imagen']['error'] == UPLOAD_ERR_FORM_SIZE) {
        $maxsize = $_REQUEST['MAX_FILE_SIZE'];
        $errores = $errores . "<LI>El tamaño del fichero supera el límite permitido ($maxsize bytes)\n";
        $nombreFichero = '';
    }
 // No se ha introducido ningún fichero
    else if ($_FILES['imagen']['name'] == "")
       $nombreFichero = '';
 // El fichero introducido no se ha podido subir
    else
    {
       $errores = $errores . "<LI>No se ha podido subir el fichero\n";
       $nombreFichero = '';
    }

 // Mostrar errores encontrados
    if ($errores != "")
    {
       print ("<P>No se ha podido realizar la inserción debido a los siguientes errores:</P>\n");
       print ("<UL>\n");
       print ($errores);
       print ("</UL>\n");
       print ("<P>[ <A HREF='javascript:history.back()'>Volver</A> ]</P>\n");
       exit();
    }

    // Aquí vendría la inserción de la noticia en la Base de Datos
	//echo  "***".$_FILES['imagen']['tmp_name']."***".$nombreDirectorio . $nombreFichero."***";

    // Mover fichero de imagen a su ubicación definitiva
       if ($copiarFichero)
          move_uploaded_file ($_FILES['imagen']['tmp_name'], $nombreDirectorio . $nombreFichero);
    
    // Nosotros en este caso vamos a hacer un return de la ruta de la img para que pueda ser introducida en la base de datos
    $rutaRelativa = "./img/" . $nombreFichero;
    return $rutaRelativa;
}

?>
<!-- Importante poner esto ya que si no no esta habilitada la opcion de subir ficheros -->
<form action="add_pisos.php" method="POST" ENCTYPE="multipart/form-data">
    <h1>Agregar nuevo piso:</h1>
    <p>Calle:  <input type="text" name="calle"></p>
    <p>Nº: <input type="number" name="numero"></p>
    <p>Piso: <input type="number" name="piso"></p>
    <p>Puerta:  <input type="text" name="puerta"></p>
    <p>CP: <input type="number" name="cp"></p>
    <p>Metros: <input type="number" name="metros"></p>
    <p>Zona:  <input type="text" name="zona"></p>
    <p>Precio: <input type="floatval" name="precio"></p>
    <p>Imagen:  <input type="file" name="imagen"></p>
    <p>Propietario: <?php desplegable_nombres() ?></p>
    <p><input type="submit" value="Agregar" name="agregar"></p>
</form>

<?php

if(isset($_REQUEST['agregar'])){

    //Falta comprobacion de errores

     $calle = $_REQUEST['calle'];
     $numero = $_REQUEST['numero'];
     $piso = $_REQUEST['piso'];
     $puerta = $_REQUEST['puerta'];
     $cp = $_REQUEST['cp'];
     $metros = $_REQUEST['metros'];
     $zona = $_REQUEST['zona'];
     $precio = $_REQUEST['precio'];
     $imagen = subir_img();
     $id_propietario = $_REQUEST['propietario'];

    echo "$calle, $numero, $piso, $puerta, $cp, $metros, $zona, $precio, $imagen, $id_propietario";

     $conexion = mysqli_connect("localhost", "root", "rootroot")
         or die ("No se puede conectar a la base de datos");

     mysqli_select_db($conexion, "inmobiliaria")
         or die ("No se puede seleccionar la base de datos");

     $query = "
         INSERT INTO piso VALUES (NULL, '$calle', $numero, $piso, '$puerta', $cp, $metros, '$zona', $precio, '$imagen', $id_propietario)
     ";

    //Para comprobar errores mysql
    //echo $query;
    
    if (mysqli_query($conexion, $query)) {
        echo "Piso dado de alta correctamente.";
    } else {
        echo "No se ha podido dar de alta al piso.";
    }

    //Cerrar conexión
    mysqli_close($conexion);
}

?>
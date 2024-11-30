<?php

include('clsConexion.php');

$miconexion = new ConexionMysql();
$miconexion->CrearConexion();

// Validar los valores de entrada
$Titulo = isset($_POST['Titulo']) ? $miconexion->EscaparCadena($_POST['Titulo']) : '';
$Descripcion = isset($_POST['Descripcion']) ? $miconexion->EscaparCadena($_POST['Descripcion']) : '';
$Fecha = isset($_POST['Fecha']) ? $miconexion->EscaparCadena($_POST['Fecha']) : '';
$FechaF = isset($_POST['FechaF']) ? $miconexion->EscaparCadena($_POST['FechaF']) : '';
$Id = isset($_POST['Id']) ? $miconexion->EscaparCadena($_POST['Id']) : '';


// INSERT
if (isset($_POST['btnRegistrar'])) {
    $sql = "INSERT INTO notas (Titulo, Descripcion,Fecha,FechaF) VALUES ('$Titulo', '$Descripcion', '$Fecha', '$FechaF')";
    $result = $miconexion->EjecutarSQL($sql);
    if ($result) {
        $numfila = $miconexion->ObtenerColumnasAfectadas();
        header("Location: ../muro.php");
    }
}

// DELETE
if (isset($_POST['btnEliminar'])) {
    $sql = "DELETE FROM notas WHERE Id = '$Id'";
    $result = $miconexion->EjecutarSQL($sql);
    if ($result) {
        $numfila = $miconexion->ObtenerColumnasAfectadas();
        echo $numfila > 0 ? header("Location: ../muro.php") : "<h2>Error eliminando la nota.</h2>";
    }
}

// SELECT
if (isset($_POST['btnBuscar'])) {
    $sql = "SELECT * FROM notas WHERE Titulo = '$Titulo'";
    $result = $miconexion->EjecutarSQL($sql);
    if ($result) {
        $row = $miconexion->ObtenerFilas($result);
        if ($row) {
            header("Location: ../index.php?Titulo=".$row['Titulo']."&Descripcion=".$row['Descripcion']);
        } else {
            echo "<h2>Nota no encontrada.</h2>";
        }
    } else {
        echo "<h2>Error ejecutando la búsqueda.</h2>";
    }
}

// UPDATE
if (isset($_POST['btnActualizar'])) {
    $sql = "UPDATE notas SET Descripcion = '$Descripcion' WHERE Titulo = '$Titulo'";
    $result = $miconexion->EjecutarSQL($sql);
    echo $result > 0 ? "<h2>Se ha actualizado exitosamente</h2>" : "<h2>Error actualizando la nota.</h2>";
}

?>

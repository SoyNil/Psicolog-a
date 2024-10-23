<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "base_psico";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la tabla seleccionada
$tabla = isset($_POST['tabla']) ? $_POST['tabla'] : 'hoja1';

// Consulta para obtener los datos de la tabla seleccionada
$sql = "SELECT DNI, expediente FROM $tabla";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>DNI</th><th>EXPEDIENTE</th></tr>"; // Modificación de los encabezados

    // Mostrar los datos en la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['DNI'] . "</td><td>" . $row['expediente'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron datos en la tabla seleccionada.";
}

// Cerrar la conexión
$conn->close();
?>

<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia este valor si tienes un usuario distinto
$password = ""; // Si tienes contraseña en tu MySQL, colócala aquí
$dbname = "base_psico";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la tabla seleccionada
$tabla_seleccionada = isset($_POST['tabla']) ? $_POST['tabla'] : 'hoja1';

// Consulta a la tabla seleccionada
$sql = "SELECT * FROM $tabla_seleccionada";
$result = $conn->query($sql);

// Mostrar datos en una tabla
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>";

    // Mostrar encabezados de las columnas
    while ($fieldinfo = $result->fetch_field()) {
        echo "<th>" . $fieldinfo->name . "</th>";
    }
    echo "</tr>";

    // Mostrar los datos
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $data) {
            echo "<td>" . $data . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados encontrados";
}

// Cerrar la conexión
$conn->close();
?>
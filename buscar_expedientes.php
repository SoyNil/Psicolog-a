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

// Obtener los expedientes ingresados por el usuario
if (isset($_POST['expedientes'])) {
    $expedientes_input = $_POST['expedientes'];
    
    // Convertir saltos de línea en comas, para aceptar números en filas
    $expedientes_input = str_replace(array("\r\n", "\r", "\n"), ',', $expedientes_input);

    // Convertir el string de expedientes en un array
    $expedientes = explode(',', $expedientes_input);

    // Limpiar los expedientes, quitando espacios en blanco
    $expedientes = array_map('trim', $expedientes);

    // Eliminar cualquier valor vacío (en caso de que haya líneas o espacios adicionales)
    $expedientes = array_filter($expedientes);

    // Formatear los expedientes para usarlos en la consulta SQL (colocar comillas simples)
    if (!empty($expedientes)) {
        $expedientes_formateados = "'" . implode("','", $expedientes) . "'";

        // Consulta SQL para obtener los DNI y expedientes de los registros seleccionados
        $sql = "SELECT DNI, expediente FROM hoja1 WHERE expediente IN ($expedientes_formateados)
                UNION 
                SELECT DNI, expediente FROM hoja2 WHERE expediente IN ($expedientes_formateados)";

        $result = $conn->query($sql);

        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>DNI</th><th>Expediente</th></tr>";

            // Mostrar los datos encontrados
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['DNI'] . "</td><td>" . $row['expediente'] . "</td></tr>";
            }

            echo "</table>";
        } else {
            echo "No se encontraron registros para los expedientes proporcionados.";
        }
    } else {
        echo "No se ingresaron expedientes válidos.";
    }
} else {
    echo "No se ha ingresado ningún expediente.";
}

// Cerrar la conexión
$conn->close();
?>

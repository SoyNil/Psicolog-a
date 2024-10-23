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

// Obtener los DNIs ingresados por el usuario
if (isset($_POST['dni'])) {
    $dni_input = $_POST['dni'];

    // Convertir saltos de línea en comas, para aceptar números en filas
    $dni_input = str_replace(array("\r\n", "\r", "\n"), ',', $dni_input);

    // Convertir el string de DNIs en un array
    $dni_array = explode(',', $dni_input);

    // Limpiar los DNIs, quitando espacios en blanco
    $dni_array = array_map('trim', $dni_array);

    // Eliminar cualquier valor vacío (en caso de que haya líneas o espacios adicionales)
    $dni_array = array_filter($dni_array);

    // Formatear los DNIs para usarlos en la consulta SQL (colocar comillas simples)
    if (!empty($dni_array)) {
        $dni_formateados = "'" . implode("','", $dni_array) . "'";

        // Consulta SQL para obtener los expedientes y DNIs de los registros seleccionados
        $sql = "SELECT DNI, expediente FROM hoja1 WHERE DNI IN ($dni_formateados)
                UNION 
                SELECT DNI, expediente FROM hoja2 WHERE DNI IN ($dni_formateados)";

        $result = $conn->query($sql);

        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>DNI</th><th>Expediente</th></tr>";

            // Mostrar los datos encontrados
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . htmlspecialchars($row['DNI']) . "</td><td>" . htmlspecialchars($row['expediente']) . "</td></tr>";
            }

            echo "</table>";
        } else {
            echo "<script>alert('No se encontraron registros para los DNIs proporcionados.'); setTimeout(function(){ window.location.href = 'index.php'; }, 2000);</script>";
        }
    } else {
        echo "<script>alert('No se ingresaron DNIs válidos.'); setTimeout(function(){ window.location.href = 'index.php'; }, 2000);</script>";
    }
} else {
    echo "<script>alert('No se ha ingresado ningún DNI.'); setTimeout(function(){ window.location.href = 'index.php'; }, 2000);</script>";
}

// Cerrar la conexión
$conn->close();
?>

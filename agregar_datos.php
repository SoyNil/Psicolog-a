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

// Obtener los datos ingresados por el usuario
if (isset($_POST['datos'])) {
    $datos_input = $_POST['datos'];
    
    // Separar los registros en líneas
    $lineas = explode("\n", $datos_input);

    // Variable para contar registros insertados
    $registros_insertados = 0;

    // Recorrer cada línea para procesar los datos
    foreach ($lineas as $linea) {
        // Eliminar espacios en blanco al principio y al final de la línea
        $linea = trim($linea);
        
        // Verificar que la línea no esté vacía
        if (!empty($linea)) {
            // Separar el DNI y el expediente usando tabulación (\t) o espacio como delimitador
            $valores = preg_split('/[\s]+/', $linea);

            // Verificar que tengamos exactamente dos valores (DNI y expediente)
            if (count($valores) == 2) {
                $dni = trim($valores[1]);
                $expediente = trim($valores[0]);

                // Verificar que tanto el DNI como el expediente sean válidos
                if (!empty($dni) && !empty($expediente)) {
                    // Insertar en la tabla hoja1 (puedes modificar para hoja2 si es necesario)
                    $sql = "INSERT INTO hoja1 (expediente, DNI) VALUES ('$expediente', '$dni')";
                    
                    if ($conn->query($sql) === TRUE) {
                        $registros_insertados++;
                    } else {
                        echo "Error al insertar: " . $conn->error . "<br>";
                    }
                }
            }
        }
    }

    echo "Se insertaron $registros_insertados registros correctamente.";
} else {
    echo "No se ha proporcionado ningún dato.";
}

// Cerrar la conexión
$conn->close();
?>

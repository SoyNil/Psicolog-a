<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Datos de las tablas</h1>

    <!-- Formulario para alternar entre tablas -->
    <form method="POST" action="index.php">
        <label for="tabla">Seleccionar tabla:</label>
        <select name="tabla" id="tabla">
            <option value="hoja1">Tabla Hoja 1</option>
            <option value="hoja2">Tabla Hoja 2</option>
        </select>
        <button type="submit">Mostrar</button>
    </form>

    <!-- Formulario para buscar por expediente -->
    <h2>Buscar Expedientes</h2>
    <form method="POST" action="buscar_expedientes.php">
        <label for="expedientes">Ingresa los números de expediente (separados por comas):</label><br>
        <textarea name="expedientes" id="expedientes" rows="4" cols="50"></textarea><br>
        <button type="submit">Buscar</button>
    </form>

    <!-- Sección donde se mostrarán los resultados de la tabla -->
    <div id="tabla-datos">
        <?php include 'mostrar_tabla.php'; ?>
    </div>
</body>
</html>
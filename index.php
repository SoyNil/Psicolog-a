<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Datos de las tablas</h1>

<!-- Botón para alternar entre el modo claro y oscuro -->
<button id="toggle-mode">Modo Oscuro</button>

<!-- Formulario para alternar entre tablas -->
<form method="POST" action="index.php">
    <label for="tabla">Seleccionar tabla:</label>
    <select name="tabla" id="tabla">
        <option value="hoja1">Tabla Hoja 1</option>
        <option value="hoja2">Tabla Hoja 2</option>
    </select>
    <button type="submit">Mostrar</button>
</form>

<!-- Formulario para buscar por DNI -->
<h2>Buscar por DNI</h2>
<form method="POST" action="buscar_dni.php">
    <label for="dni">Ingresa los números de DNI (separados por comas o en líneas separadas):</label><br>
    <textarea name="dni" id="dni" rows="4" cols="50"></textarea><br>
    <button type="submit">Buscar</button>
</form>

<!-- Formulario para agregar datos masivamente -->
<h2>Agregar Datos Masivamente</h2>
<form method="POST" action="agregar_datos.php">
    <label for="datos">Ingresa los datos (DNI y expediente en líneas separadas, formato: DNI, expediente):</label><br>
    <textarea name="datos" id="datos" rows="8" cols="50" placeholder="Ejemplo:\n12345678, 546793\n87654321, 548133"></textarea><br>
    <button type="submit">Agregar Datos</button>
</form>
<!-- Sección donde se mostrará el nombre de la tabla seleccionada -->
<?php
    // Obtener el nombre de la tabla seleccionada
    $nombreTabla = isset($_POST['tabla']) ? htmlspecialchars($_POST['tabla']) : 'hoja1';
?>

<h2>Datos de la <?php echo ucfirst(str_replace('hoja', 'hoja ', $nombreTabla)); ?></h2> <!-- Mostrar nombre de la tabla -->

<!-- Sección donde se mostrarán los resultados de la tabla -->
<div id="tabla-datos">
    <?php include 'mostrar_tabla.php'; ?>
</div>

<script>
    // Función para alternar entre modo oscuro y claro
    const toggleButton = document.getElementById('toggle-mode');
    const body = document.body;

    // Verificar el estado del modo al cargar la página
    if (localStorage.getItem('dark-mode') === 'enabled') {
        body.classList.add('dark-mode');
        toggleButton.textContent = 'Modo Claro';
    }

    toggleButton.addEventListener('click', function() {
        body.classList.toggle('dark-mode');

        if (body.classList.contains('dark-mode')) {
            toggleButton.textContent = 'Modo Claro';
            localStorage.setItem('dark-mode', 'enabled'); // Guardar estado
        } else {
            toggleButton.textContent = 'Modo Oscuro';
            localStorage.removeItem('dark-mode'); // Eliminar estado
        }
    });
</script>

</body>
</html>

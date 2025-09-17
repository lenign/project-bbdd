<?php
include '../database.php';
include '../consultas.php';

// Obtener ciudades únicas para el select
$ciudades_query = "SELECT DISTINCT ciudad FROM Proveedores ORDER BY ciudad";
$ciudades_result = $conn->query($ciudades_query);

// Procesar consulta
$resultado = null;
$ciudad_seleccionada = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ciudad'])) {
    $ciudad_seleccionada = $_POST['ciudad'];
    $resultado = obtenerProductosPorCiudad($conn, $ciudad_seleccionada);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta 6 - Productos por Ciudad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Manjares de Honduras</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Productos por Ciudad de Proveedor</h2>
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="ciudad" class="form-label">Seleccione una Ciudad:</label>
                        <select class="form-select" id="ciudad" name="ciudad" required>
                            <option value="">-- Seleccione una ciudad --</option>
                            <?php while ($ciudad = $ciudades_result->fetch_assoc()): ?>
                            <option value="<?php echo $ciudad['ciudad']; ?>" 
                                <?php echo ($ciudad_seleccionada == $ciudad['ciudad']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($ciudad['ciudad']); ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Buscar Productos</button>
                </form>
            </div>
        </div>

        <?php if (isset($resultado)): ?>
            <?php if ($resultado->num_rows > 0): ?>
                <div class="mt-4">
                    <h4>Productos de proveedores en: <?php echo htmlspecialchars($ciudad_seleccionada); ?></h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Proveedor</th>
                                    <th>Ciudad</th>
                                    <th>Producto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($fila = $resultado->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($fila['nombre_proveedor']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['ciudad']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['nombre_producto']); ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-info mt-4">
                    No se encontraron productos para proveedores en la ciudad: <?php echo htmlspecialchars($ciudad_seleccionada); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        
        <div class="mt-3 text-center">
            <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include '../database.php';
include '../consultas.php';

// Procesar consulta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fecha'])) {
    $fecha = $_POST['fecha'];
    $resultado = obtenerPlatosPorFecha($conn, $fecha);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta 2 - Manjares de Honduras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Manjares de Honduras</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Platos por Fecha de Menú</h2>
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Seleccione una Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Consultar</button>
                </form>
            </div>
        </div>
        
        <?php if (isset($resultado) && $resultado->num_rows > 0): ?>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <h4>Platos para la fecha seleccionada:</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre del Plato</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['codigo_plato']; ?></td>
                            <td><?php echo $row['nombre_plato']; ?></td>
                            <td>L. <?php echo number_format($row['precio_plato'], 2); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php elseif (isset($resultado)): ?>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="alert alert-info">No se encontraron platos para la fecha seleccionada.</div>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="mt-3 text-center">
            <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
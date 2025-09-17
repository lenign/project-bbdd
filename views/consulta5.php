<?php
include '../database.php';
include '../consultas.php';

$resultado = obtenerProveedoresYCantidad($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta 5 - Proveedores y Productos</title>
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
        <h2 class="text-center mb-4">Proveedores y Cantidad de Productos</h2>
        
        <?php if ($resultado && $resultado->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>RTN</th>
                            <th>Teléfono</th>
                            <th>Ciudad</th>
                            <th>Cantidad de Productos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($proveedor = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $proveedor['codigo_proveedor']; ?></td>
                            <td><?php echo htmlspecialchars($proveedor['nombre_proveedor']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['direccion']); ?></td>
                            <td><?php echo $proveedor['rtn']; ?></td>
                            <td><?php echo $proveedor['telefono']; ?></td>
                            <td><?php echo htmlspecialchars($proveedor['ciudad']); ?></td>
                            <td class="text-center">
                                <span class="badge bg-<?php echo ($proveedor['cantidad_productos'] > 0) ? 'success' : 'secondary'; ?>">
                                    <?php echo $proveedor['cantidad_productos']; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                No se encontraron proveedores en la base de datos.
            </div>
        <?php endif; ?>
        
        <div class="mt-3 text-center">
            <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
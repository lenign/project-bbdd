<?php
include '../database.php';

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_plato = $_POST['codigo_plato'];
    $nombre_plato = $_POST['nombre_plato'];
    $precio_plato = $_POST['precio_plato'];
    
    $sql = "INSERT INTO Platos (codigo_plato, nombre_plato, precio_plato, fecha_creacion, fecha_modificacion)
            VALUES ($codigo_plato, '$nombre_plato', $precio_plato, NOW(), NOW())";
    
    if ($conn->query($sql)) {
        $success_msg = "Plato agregado exitosamente!";
    } else {
        $error_msg = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Plato - Manjares de Honduras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Manjares de Honduras</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Agregar Nuevo Plato</h2>
                
                <?php if (isset($success_msg)): ?>
                    <div class="alert alert-success"><?php echo $success_msg; ?></div>
                <?php endif; ?>
                
                <?php if (isset($error_msg)): ?>
                    <div class="alert alert-danger"><?php echo $error_msg; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="codigo_plato" class="form-label">Código del Plato</label>
                        <input type="number" class="form-control" id="codigo_plato" name="codigo_plato" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre_plato" class="form-label">Nombre del Plato</label>
                        <input type="text" class="form-control" id="nombre_plato" name="nombre_plato" required>
                    </div>
                    <div class="mb-3">
                        <label for="precio_plato" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="precio_plato" name="precio_plato" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Agregar Plato</button>
                </form>
                
                <div class="mt-3 text-center">
                    <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
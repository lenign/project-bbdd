<?php
include '../database.php';

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_menu = $_POST['codigo_menu'];
    $fecha_elaboracion = $_POST['fecha_elaboracion'];
    $descripcion = $_POST['descripcion'];
    
    $sql = "INSERT INTO Menus (codigo_menu, fecha_elaboracion, descripcion, fecha_creacion, fecha_modificacion)
            VALUES ($codigo_menu, '$fecha_elaboracion', '$descripcion', NOW(), NOW())";
    
    if ($conn->query($sql)) {
        $success_msg = "Menú agregado exitosamente!";
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
    <title>Agregar Menú - Manjares de Honduras</title>
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
                <h2 class="text-center mb-4">Agregar Nuevo Menú</h2>
                
                <?php if (isset($success_msg)): ?>
                    <div class="alert alert-success"><?php echo $success_msg; ?></div>
                <?php endif; ?>
                
                <?php if (isset($error_msg)): ?>
                    <div class="alert alert-danger"><?php echo $error_msg; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="codigo_menu" class="form-label">Código del Menú</label>
                        <input type="number" class="form-control" id="codigo_menu" name="codigo_menu" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_elaboracion" class="form-label">Fecha de Elaboración</label>
                        <input type="date" class="form-control" id="fecha_elaboracion" name="fecha_elaboracion" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Agregar Menú</button>
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
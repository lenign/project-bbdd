<?php
include '../database.php';

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_proveedor = $_POST['codigo_proveedor'];
    $nombre_proveedor = $_POST['nombre_proveedor'];
    $direccion = $_POST['direccion'];
    $rtn = $_POST['rtn'];
    $telefono = $_POST['telefono'];
    $ciudad = $_POST['ciudad'];
    
    $sql = "INSERT INTO Proveedores (codigo_proveedor, nombre_proveedor, direccion, rtn, telefono, ciudad)
            VALUES ($codigo_proveedor, '$nombre_proveedor', '$direccion', '$rtn', '$telefono', '$ciudad')";
    
    if ($conn->query($sql)) {
        $success_msg = "Proveedor agregado exitosamente!";
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
    <title>Agregar Proveedor - Manjares de Honduras</title>
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
                <h2 class="text-center mb-4">Agregar Nuevo Proveedor</h2>
                
                <?php if (isset($success_msg)): ?>
                    <div class="alert alert-success"><?php echo $success_msg; ?></div>
                <?php endif; ?>
                
                <?php if (isset($error_msg)): ?>
                    <div class="alert alert-danger"><?php echo $error_msg; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="codigo_proveedor" class="form-label">Código del Proveedor</label>
                        <input type="number" class="form-control" id="codigo_proveedor" name="codigo_proveedor" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre_proveedor" class="form-label">Nombre del Proveedor</label>
                        <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>
                    <div class="mb-3">
                        <label for="rtn" class="form-label">RTN</label>
                        <input type="text" class="form-control" id="rtn" name="rtn" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <div class="mb-3">
                        <label for="ciudad" class="form-label">Ciudad</label>
                        <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Agregar Proveedor</button>
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
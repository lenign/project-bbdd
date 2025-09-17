<?php
include '../database.php';
include '../consultas.php';

// Obtener acompañantes para el select
$acompanantes_query = "SELECT * FROM Acompanantes";
$acompanantes_result = $conn->query($acompanantes_query);

// Procesar consulta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acompanante_id'])) {
    $acompanante_id = $_POST['acompanante_id'];
    $resultado = obtenerPlatosPorAcompanante($conn, $acompanante_id);
    
    // Obtener nombre del acompañante
    $acompanante_nombre_query = "SELECT nombre_acompanante FROM Acompanantes WHERE codigo_acompanante = $acompanante_id";
    $acompanante_nombre_result = $conn->query($acompanante_nombre_query);
    $acompanante_nombre = $acompanante_nombre_result->fetch_assoc()['nombre_acompanante'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta 1 - Manjares de Honduras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Manjares de Honduras</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Platos por Acompañante</h2>
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="acompanante_id" class="form-label">Seleccione un Acompañante</label>
                        <select class="form-select" id="acompanante_id" name="acompanante_id" required>
                            <option value="">-- Seleccione --</option>
                            <?php while ($row = $acompanantes_result->fetch_assoc()): ?>
                                <option value="<?php echo $row['codigo_acompanante']; ?>">
                                    <?php echo $row['nombre_acompanante']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Consultar</button>
                </form>
            </div>
        </div>
        
        <?php if (isset($resultado)): ?>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Resultado</h5>
                    </div>
                    <div class="card-body">
                        <p>El acompañante <strong><?php echo $acompanante_nombre; ?></strong> está presente en <strong><?php echo $resultado['total_platos']; ?></strong> plato(s).</p>
                    </div>
                </div>
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
<?php
include '../database.php';
include '../consultas.php';

$resultado = obtenerPlatosYAcompanantes($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta 3 - Manjares de Honduras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Manjares de Honduras</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Platos y Acompañantes por Menú</h2>
        
        <?php if ($resultado->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Menú</th>
                        <th>Fecha de creación</th>
                        <th>Plato</th>
                        <th>Acompañantes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $current_menu = "";
                    $current_plato = "";
                    $current_fecha = "";
                    $acompanantes = array();
                    
                    while ($row = $resultado->fetch_assoc()):
                        if ($current_menu != $row['descripcion'] || $current_fecha != $row['fecha_creacion']) {
                            if ($current_menu != "") {
                                echo "<tr>";
                                echo "<td>$current_menu</td>";
                                echo "<td>$current_fecha</td>";
                                echo "<td>$current_plato</td>";
                                echo "<td>" . implode(", ", $acompanantes) . "</td>";
                                echo "</tr>";
                            }
                            $current_menu = $row['descripcion'];
                            $current_fecha = $row['fecha_creacion'];
                            $current_plato = $row['nombre_plato'];
                            $acompanantes = array();
                            if ($row['nombre_acompanante']) {
                                $acompanantes[] = $row['nombre_acompanante'];
                            }
                        } elseif ($current_plato != $row['nombre_plato']) {
                            echo "<tr>";
                            echo "<td>$current_menu</td>";
                            echo "<td>$current_fecha</td>";
                            echo "<td>$current_plato</td>";
                            echo "<td>" . implode(", ", $acompanantes) . "</td>";
                            echo "</tr>";
                            $current_plato = $row['nombre_plato'];
                            $acompanantes = array();
                            if ($row['nombre_acompanante']) {
                                $acompanantes[] = $row['nombre_acompanante'];
                            }
                        } else {
                            if ($row['nombre_acompanante']) {
                                $acompanantes[] = $row['nombre_acompanante'];
                            }
                        }
                    endwhile;
                    if ($current_menu != "") {
                        echo "<tr>";
                        echo "<td>$current_menu</td>";
                        echo "<td>$current_fecha</td>";
                        echo "<td>$current_plato</td>";
                        echo "<td>" . implode(", ", $acompanantes) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="alert alert-info">No se encontraron datos.</div>
        <?php endif; ?>
        
        <div class="mt-3 text-center">
            <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// Consulta 1: Obtener cuántos platos tienen un acompañante específico
function obtenerPlatosPorAcompanante($conn, $acompanante_id) {
    $sql = "SELECT COUNT(*) as total_platos 
            FROM AcompanantePlatos 
            WHERE codigo_acompanante = $acompanante_id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// Consulta 2: Listar todos los platos que pertenecen al menú de una fecha específica
function obtenerPlatosPorFecha($conn, $fecha) {
    $sql = "SELECT p.* 
            FROM Platos p
            JOIN MenuPlatos mp ON p.codigo_plato = mp.codigo_plato
            JOIN Menus m ON mp.codigo_menu = m.codigo_menu
            WHERE m.fecha_elaboracion = '$fecha'";
    $result = $conn->query($sql);
    return $result;
}

// Consulta 3: Listar todos los platos de cada menú con sus acompañantes y fecha de creación del menú
function obtenerPlatosYAcompanantes($conn) {
    $sql = "SELECT m.codigo_menu, m.descripcion, m.fecha_creacion, p.codigo_plato, p.nombre_plato, 
                   a.codigo_acompanante, a.nombre_acompanante
            FROM Menus m
            JOIN MenuPlatos mp ON m.codigo_menu = mp.codigo_menu
            JOIN Platos p ON mp.codigo_plato = p.codigo_plato
            LEFT JOIN AcompanantePlatos ap ON p.codigo_plato = ap.codigo_plato
            LEFT JOIN Acompanantes a ON ap.codigo_acompanante = a.codigo_acompanante
            ORDER BY m.codigo_menu, p.codigo_plato";
    $result = $conn->query($sql);
    return $result;
}

// Consulta 4: Obtener cuántos platos tiene cada menú
function obtenerCantidadPlatosPorMenu($conn) {
    $sql = "SELECT m.codigo_menu, m.descripcion, COUNT(mp.codigo_plato) as cantidad_platos
            FROM Menus m
            LEFT JOIN MenuPlatos mp ON m.codigo_menu = mp.codigo_menu
            GROUP BY m.codigo_menu, m.descripcion";
    $result = $conn->query($sql);
    return $result;
}

// Consulta 5: Mostrar información de proveedores y cantidad de productos
function obtenerProveedoresYCantidad($conn) {
    $sql = "SELECT p.codigo_proveedor, p.nombre_proveedor, p.direccion, p.rtn, p.telefono, p.ciudad,
                   COUNT(pp.codigo_inventario) as cantidad_productos
            FROM Proveedores p
            LEFT JOIN ProductoProveedor pp ON p.codigo_proveedor = pp.codigo_proveedor
            GROUP BY p.codigo_proveedor, p.nombre_proveedor, p.direccion, p.rtn, p.telefono, p.ciudad";
    $result = $conn->query($sql);
    return $result;
}

// Consulta 6: Obtener productos por proveedor de una ciudad específica
function obtenerProductosPorCiudad($conn, $ciudad) {
    $sql = "SELECT pr.nombre_proveedor, pr.ciudad, p.nombre_producto
            FROM Proveedores pr
            JOIN ProductoProveedor pp ON pr.codigo_proveedor = pp.codigo_proveedor
            JOIN Productos p ON pp.codigo_inventario = p.codigo_inventario
            WHERE pr.ciudad = '$ciudad'
            ORDER BY pr.nombre_proveedor";
    $result = $conn->query($sql);
    return $result;
}
?>
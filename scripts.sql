-- 1. Creación de la base de datos
CREATE DATABASE ManjaresDeHonduras;

USE ManjaresDeHonduras;

-- Tabla de proveedores
CREATE TABLE Proveedores (
    codigo_proveedor INT PRIMARY KEY,
    nombre_proveedor VARCHAR(100),
    direccion VARCHAR(200),
    rtn VARCHAR(20),
    telefono VARCHAR(15),
    ciudad VARCHAR(50)
);

-- Tabla de productos
CREATE TABLE Productos (
    codigo_inventario INT PRIMARY KEY,
    nombre_producto VARCHAR(100),
    ubicacion_bodega VARCHAR(100),
    cantidad_existencia INT,
    precio_costo DECIMAL(10,2),
    precio_venta DECIMAL(10,2)
);

-- Tabla intermedia: Producto-Proveedor
CREATE TABLE ProductoProveedor (
    codigo_inventario INT,
    codigo_proveedor INT,
    PRIMARY KEY (codigo_inventario, codigo_proveedor),
    FOREIGN KEY (codigo_inventario) REFERENCES Productos(codigo_inventario),
    FOREIGN KEY (codigo_proveedor) REFERENCES Proveedores(codigo_proveedor)
);

-- Tabla de acompañantes
CREATE TABLE Acompanantes (
    codigo_acompanante INT PRIMARY KEY,
    nombre_acompanante VARCHAR(100),
    precio_acompanante DECIMAL(10,2)
);

-- Tabla intermedia: Producto-Acompañante
CREATE TABLE ProductoAcompanante (
    codigo_inventario INT,
    codigo_acompanante INT,
    cantidad DECIMAL(10,2),
    PRIMARY KEY (codigo_inventario, codigo_acompanante),
    FOREIGN KEY (codigo_inventario) REFERENCES Productos(codigo_inventario),
    FOREIGN KEY (codigo_acompanante) REFERENCES Acompanantes(codigo_acompanante)
);

-- Tabla de platos
CREATE TABLE Platos (
    codigo_plato INT PRIMARY KEY,
    nombre_plato VARCHAR(100),
    precio_plato DECIMAL(10,2),
    fecha_creacion DATETIME,
    fecha_modificacion DATETIME
);

-- Tabla intermedia: Acompañante-Platos
CREATE TABLE AcompanantePlatos (
    codigo_acompanante INT,
    codigo_plato INT,
    PRIMARY KEY (codigo_acompanante, codigo_plato),
    FOREIGN KEY (codigo_acompanante) REFERENCES Acompanantes(codigo_acompanante),
    FOREIGN KEY (codigo_plato) REFERENCES Platos(codigo_plato)
);

-- Tabla de menús
CREATE TABLE Menus (
    codigo_menu INT PRIMARY KEY,
    fecha_elaboracion DATE,
    descripcion VARCHAR(200),
    fecha_creacion DATETIME,
    fecha_modificacion DATETIME
);

-- Tabla intermedia: Menu-Platos
CREATE TABLE MenuPlatos (
    codigo_menu INT,
    codigo_plato INT,
    cantidad_producir INT,
    existencia_actual INT,
    PRIMARY KEY (codigo_menu, codigo_plato),
    FOREIGN KEY (codigo_menu) REFERENCES Menus(codigo_menu),
    FOREIGN KEY (codigo_plato) REFERENCES Platos(codigo_plato)
);

-- Tabla de bitácoras
CREATE TABLE BitacoraMenus (
    id_bitacora INT PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(50),
    descripcion_operacion VARCHAR(200),
    fecha_hora_operacion DATETIME
);

-- 2. Insertar 10 productos
INSERT INTO Productos VALUES 
(1, 'Arroz', 'Estante A1', 100, 15.50, 25.00),
(2, 'Pollo', 'Refrigerador B2', 50, 40.00, 65.00),
(3, 'Tomate', 'Estante C3', 80, 8.00, 15.00),
(4, 'Cebolla', 'Estante C4', 70, 7.50, 14.00),
(5, 'Aceite', 'Estante D1', 30, 25.00, 40.00),
(6, 'Sal', 'Estante D2', 200, 5.00, 10.00),
(7, 'Pimienta', 'Estante D3', 150, 8.00, 16.00),
(8, 'Zanahoria', 'Estante C5', 60, 6.00, 12.00),
(9, 'Papa', 'Estante C6', 90, 10.00, 18.00),
(10, 'Ajo', 'Estante D4', 120, 12.00, 22.00);

-- 3. Insertar 10 proveedores
INSERT INTO Proveedores VALUES 
(1, 'Distribuidora Central', 'Colonia Palmira', '08011990001234', '2233-4455', 'Tegucigalpa'),
(2, 'Alimentos Sula', 'Barrio Abajo', '08011990005678', '2244-5566', 'San Pedro Sula'),
(3, 'Productos del Valle', 'Colonia Las Colinas', '08011990009876', '2255-6677', 'Comayagua'),
(4, 'AgroHonduras', 'Barrio El Centro', '08011990004321', '2266-7788', 'La Ceiba'),
(5, 'Distribuidora Oriental', 'Colonia Los Robles', '08011990008765', '2277-8899', 'Danlí'),
(6, 'Alimentos del Sur', 'Barrio Morazán', '08011990003214', '2288-9900', 'Choluteca'),
(7, 'Productos Litoral', 'Colonia Florencia', '08011990007654', '2299-0011', 'Puerto Cortés'),
(8, 'AgroExport', 'Barrio Guamilito', '08011990002143', '2300-1122', 'San Pedro Sula'),
(9, 'Distribuidora Norte', 'Colonia Satélite', '08011990006543', '2311-2233', 'El Progreso'),
(10, 'Alimentos del Pacífico', 'Barrio Concepción', '08011990001023', '2322-3344', 'Nacaome');

-- 4. Insertar 5 acompañantes
INSERT INTO Acompanantes VALUES 
(1, 'Arroz a la jardinera', 25.00),
(2, 'Pollo en salsa teriyaki', 65.00),
(3, 'Ensalada fresca', 20.00),
(4, 'Pure de papa', 18.00),
(5, 'Verduras salteadas', 22.00);

-- 5. Insertar 5 platos
INSERT INTO Platos VALUES 
(1, 'Pollo Teriyaki con Arroz', 120.00, NOW(), NOW()),
(2, 'Plato Vegetariano', 95.00, NOW(), NOW()),
(3, 'Combo Familiar', 180.00, NOW(), NOW()),
(4, 'Especial del Chef', 150.00, NOW(), NOW()),
(5, 'Menú Ejecutivo', 100.00, NOW(), NOW());

-- 6. Insertar 5 menús
INSERT INTO Menus VALUES 
(1, '2024-05-01', 'Menú del Lunes', NOW(), NOW()),
(2, '2024-05-02', 'Menú del Martes', NOW(), NOW()),
(3, '2024-05-03', 'Menú del Miércoles', NOW(), NOW()),
(4, '2024-05-04', 'Menú del Jueves', NOW(), NOW()),
(5, '2024-05-05', 'Menú del Viernes', NOW(), NOW());

-- 7. Insertar 5 filas en ProductoProveedor
INSERT INTO ProductoProveedor VALUES 
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5);

-- 8. Insertar 5 filas en AcompanantePlatos
INSERT INTO AcompanantePlatos VALUES 
(1, 1), (2, 1), (3, 2), (4, 3), (5, 4);

-- 9. Insertar 5 filas en ProductoAcompanante
INSERT INTO ProductoAcompanante VALUES 
(1, 1, 2.0), (2, 2, 1.5), (3, 3, 1.0), (4, 4, 2.5), (5, 5, 1.8);

-- 10. Insertar 5 filas en MenuPlatos
INSERT INTO MenuPlatos VALUES 
(1, 1, 20, 15), (2, 2, 15, 12), (3, 3, 10, 8), (4, 4, 18, 14), (5, 5, 25, 20);


-- Trigger para Platos: asigna fecha_creacion automáticamente
DELIMITER $$
CREATE TRIGGER before_insert_platos
BEFORE INSERT ON Platos
FOR EACH ROW
BEGIN
    SET NEW.fecha_creacion = NOW();
END $$
DELIMITER ;

-- Trigger para Menus: asigna fecha_creacion automáticamente
DELIMITER $$
CREATE TRIGGER before_insert_menus
BEFORE INSERT ON Menus
FOR EACH ROW
BEGIN
    SET NEW.fecha_creacion = NOW();
END $$
DELIMITER ;


-- Consultas
-- 1
SELECT COUNT(*) AS total_platos
FROM AcompanantePlatos
WHERE codigo_acompanante = 1;

-- 2
SELECT p.*
FROM Platos p
JOIN MenuPlatos mp ON p.codigo_plato = mp.codigo_plato
JOIN Menus m ON mp.codigo_menu = m.codigo_menu
WHERE m.fecha_elaboracion = '2024-05-01';

-- 3
SELECT m.codigo_menu, m.descripcion, m.fecha_creacion, p.codigo_plato, p.nombre_plato,
       a.codigo_acompanante, a.nombre_acompanante
FROM Menus m
JOIN MenuPlatos mp ON m.codigo_menu = mp.codigo_menu
JOIN Platos p ON mp.codigo_plato = p.codigo_plato
LEFT JOIN AcompanantePlatos ap ON p.codigo_plato = ap.codigo_plato
LEFT JOIN Acompanantes a ON ap.codigo_acompanante = a.codigo_acompanante
ORDER BY m.codigo_menu, p.codigo_plato;

-- 4
SELECT m.codigo_menu, m.descripcion, COUNT(mp.codigo_plato) AS cantidad_platos
FROM Menus m
LEFT JOIN MenuPlatos mp ON m.codigo_menu = mp.codigo_menu
GROUP BY m.codigo_menu, m.descripcion;

-- 5
SELECT p.codigo_proveedor, p.nombre_proveedor, p.direccion, p.rtn, p.telefono, p.ciudad,
       COUNT(pp.codigo_inventario) AS cantidad_productos
FROM Proveedores p
LEFT JOIN ProductoProveedor pp ON p.codigo_proveedor = pp.codigo_proveedor
GROUP BY p.codigo_proveedor, p.nombre_proveedor, p.direccion, p.rtn, p.telefono, p.ciudad;

-- 6
SELECT pr.nombre_proveedor, pr.ciudad, p.nombre_producto
FROM Proveedores pr
JOIN ProductoProveedor pp ON pr.codigo_proveedor = pp.codigo_proveedor
JOIN Productos p ON pp.codigo_inventario = p.codigo_inventario
WHERE pr.ciudad = 'Tegucigalpa'
ORDER BY pr.nombre_proveedor;
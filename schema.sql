CREATE DATABASE IF NOT EXISTS emprendimiento CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE emprendimiento;

CREATE TABLE IF NOT EXISTS systems (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(140) NOT NULL,
    summary TEXT NOT NULL,
    stack VARCHAR(140) NOT NULL,
    project_url VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS leads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(160) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO systems (title, summary, stack, project_url) VALUES
('Sistema de Reservas', 'Control de citas para negocios de servicios con recordatorios automáticos.', 'PHP 8.2, MySQL, Bootstrap', 'https://tusistema-ejemplo.com/reservas'),
('Panel de Inventario', 'Gestión de productos, compras, ventas y reportes mensuales.', 'PHP 8.2, MySQL, Chart.js', 'https://tusistema-ejemplo.com/inventario');

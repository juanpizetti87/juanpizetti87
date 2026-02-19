# Landing + Portafolio en PHP y MySQL

Este proyecto es una base para tu emprendimiento personal: una web de servicios con estilo profesional (similar en estructura a una landing moderna) y conexión a MySQL.

## Requisitos

- PHP 8.1+
- MySQL 8+

## Configuración rápida

1. Crea la base de datos y tablas:

```bash
mysql -u root -p < schema.sql
```

2. Configura credenciales por variables de entorno (opcional):

```bash
export DB_HOST=127.0.0.1
export DB_PORT=3306
export DB_NAME=emprendimiento
export DB_USER=root
export DB_PASS='tu_password'
```

3. Ejecuta el servidor local:

```bash
php -S 0.0.0.0:8000
```

4. Abre `http://localhost:8000`.

## Qué incluye

- Hero + secciones de servicios y sistemas.
- Listado dinámico de proyectos desde tabla `systems`.
- Formulario de contacto que guarda leads en tabla `leads`.
- Estilos modernos y fáciles de personalizar.

## Personalización recomendada

- Cambia textos de marca en `index.php`.
- Reemplaza colores en `assets/css/style.css`.
- Agrega más campos y lógica para cotizaciones.

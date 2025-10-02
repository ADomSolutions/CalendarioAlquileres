# Sistema de Gestión de Reservas DOMENICO ALEJANDRO

Este proyecto es una aplicación web simple para **gestionar reservas de propiedades**.  
Permite visualizar las reservas en un calendario mensual, agregar nuevas propiedades y ver las referencias de cada una con colores únicos.

## Estructura del proyecto

### 1. `reservas.sql`
Script SQL que:
- Crea la base de datos `reservas`.
- Define la tabla `reservas` con campos para almacenar:
  - `id` (clave primaria, autoincremental).
  - `nombre_propiedad` (texto).
  - `link` (URL de referencia).
  - `fecha_inicio` y `fecha_fin` (rango de fechas).
  - `color` (código hexadecimal para mostrar en el calendario).

### 2. `server.php`
Archivo PHP que actúa como **API**:
- Se conecta a la base de datos MySQL.
- Soporta dos acciones principales:
  - `action=get` → devuelve todas las reservas en formato JSON.
  - `action=add` → recibe una reserva nueva en JSON y la guarda en la base.
- Funciona como puente entre el frontend (`index.html`) y la base de datos (`reservas.sql`).

### 3. `index.html`
Interfaz de usuario que:
- Muestra un **calendario dinámico** por mes.
- Permite navegar entre meses.
- Incluye un **formulario** para agregar reservas (nombre, link, fechas).
- Cada reserva se marca con un **color único** en los días ocupados.
- Genera una sección de **referencias con enlaces clicables** a las propiedades reservadas:contentReference[oaicite:1]{index=1}.

## Requisitos
- Servidor web con PHP (ej. Apache o Nginx).
- Base de datos MySQL/MariaDB.
- Navegador moderno (Chrome, Firefox, Edge).

## Instalación
1. Importar `reservas.sql` en tu servidor MySQL:
   ```bash
   mysql -u usuario -p < reservas.sql
   
2. Configurar la conexión a la base de datos en server.php.

3. Abrir index.html en el navegador (o desplegarlo en un servidor local).

## Uso

Navegar entre meses con los botones Mes Anterior / Mes Siguiente.

Usar el formulario para agregar reservas.

Consultar las referencias en la parte inferior para acceder a cada propiedad.

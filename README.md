# TravelMap - Aplicación de Diario de Viajes Interactivo

Aplicación web para crear mapas interactivos con información de viajes utilizando tecnologías nativas.

## 🚀 Tecnologías Utilizadas

- **Backend**: PHP 8.x (Vanilla, sin frameworks)
- **Base de Datos**: MySQL/MariaDB
- **Frontend**: Bootstrap 5 + jQuery 3.x (locales)
- **Mapas**: Leaflet.js con plugins (draw, markercluster, polylineDecorator)

## 📁 Estructura del Proyecto

Ver [ESTRUCTURA.md](ESTRUCTURA.md) para detalles completos de la organización de carpetas.

## 🔧 Instalación

### Requisitos Previos
- XAMPP, WAMP o servidor similar con PHP 8.x
- MySQL o MariaDB
- Navegador web moderno

### Pasos de Instalación

1. **Clonar o copiar el proyecto** en tu carpeta `htdocs` (o equivalente):
   ```
   c:\xampp\htdocs\TravelMap
   ```

2. **Crear la base de datos**:
   - Abre phpMyAdmin o tu cliente MySQL
   - Importa el archivo `database.sql`
   - Esto creará la base de datos `travelmap` y todas las tablas necesarias

3. **Configurar la conexión**:
   - Edita `config/db.php` si tu usuario/contraseña de MySQL son diferentes
   - Por defecto usa: user=`root`, password=`` (vacía)

4. **Ajustar la URL base**:
   - Edita `config/config.php` 
   - Modifica la variable `$folder` si tu carpeta no se llama "TravelMap"

5. **Descargar librerías locales**:
   - Descarga Bootstrap 5 y colócalo en `assets/vendor/bootstrap/`
   - Descarga jQuery 3.x y colócalo en `assets/vendor/jquery/`
   - Descarga Leaflet.js y plugins en `assets/vendor/leaflet/`

6. **Crear usuario administrador** (será implementado en Fase 2):
   - Accede a: `http://localhost/TravelMap/install/seed_admin.php`
   - Esto creará el usuario: **admin** / **admin123**
   - **IMPORTANTE**: Elimina o protege la carpeta `install/` después

7. **Acceder a la aplicación**:
   - Panel Admin: `http://localhost/TravelMap/admin/`
   - Vista Pública: `http://localhost/TravelMap/`

## 🔐 Seguridad

- Las contraseñas se almacenan con `password_hash()` de PHP
- Sesiones configuradas con tiempo de expiración
- Validación de tipos de archivo en uploads
- Foreign Keys con CASCADE para integridad referencial

## 📝 Uso

1. Inicia sesión en el panel de administración
2. Crea un nuevo viaje con título, descripción, fechas y color
3. Agrega rutas dibujándolas en el mapa (especificando tipo de transporte)
4. Agrega puntos de interés con fotos, descripciones y coordenadas
5. Publica el viaje para visualizarlo en el mapa público

## 📦 Estado del Proyecto

**Fase 1 Completada**: Base de datos y estructura del proyecto
- ✅ Script SQL con todas las tablas
- ✅ Estructura de carpetas organizada
- ✅ Conexión PDO con manejo de excepciones
- ✅ Configuración global del sistema

**Próxima fase**: Sistema de autenticación y layout base

## 🤝 Contribuciones

Este proyecto es personal, pero siéntete libre de hacer fork y adaptarlo.

## 📄 Licencia

Ver archivo [LICENSE](LICENSE)

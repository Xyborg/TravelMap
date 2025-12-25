# Estructura del Proyecto TravelMap

## Descripción de Carpetas

```
TravelMap/
│
├── config/              # Configuración del sistema
│   ├── config.php       # Constantes globales (BASE_URL, ROOT_PATH)
│   └── db.php           # Conexión a base de datos (PDO)
│
├── public/              # Archivos accesibles públicamente (opcional, puede usarse como punto de entrada)
│
├── src/                 # Código fuente organizado (Modelos, Controladores, Helpers)
│   ├── models/          # Clases de modelos (User, Trip, Route, Point)
│   ├── controllers/     # Lógica de control
│   └── helpers/         # Funciones auxiliares
│
├── uploads/             # Archivos subidos por usuarios
│   └── points/          # Imágenes de puntos de interés
│
├── assets/              # Recursos estáticos
│   ├── vendor/          # Librerías de terceros (descargadas localmente)
│   │   ├── bootstrap/   # Bootstrap 5 (CSS y JS)
│   │   ├── jquery/      # jQuery 3.x
│   │   └── leaflet/     # Leaflet.js y plugins
│   ├── css/             # CSS personalizado
│   └── js/              # JavaScript personalizado
│
├── admin/               # Panel de administración
│   ├── index.php        # Dashboard
│   ├── trips.php        # Gestión de viajes
│   ├── points.php       # Gestión de puntos de interés
│   └── users.php        # Gestión de usuarios
│
├── includes/            # Archivos reutilizables
│   ├── header.php       # Cabecera común
│   ├── footer.php       # Pie de página común
│   └── auth.php         # Funciones de autenticación
│
├── install/             # Scripts de instalación
│   └── seed_admin.php   # Crear usuario administrador inicial
│
├── api/                 # Endpoints para frontend
│   └── get_all_data.php # API para obtener datos de viajes
│
├── index.php            # Página pública (visualizador de mapas)
├── login.php            # Página de inicio de sesión
├── database.sql         # Script SQL para crear base de datos
├── instructions.md      # Documentación del proyecto
├── README.md            # Instrucciones generales
└── LICENSE              # Licencia del proyecto
```

## Seguridad

- **uploads/**: Debe tener permisos de escritura pero NO debe permitir ejecución de PHP
- **config/**: Debe estar protegido del acceso directo mediante .htaccess o configuración del servidor
- **src/**: Contiene código PHP que no debe ser accesible directamente desde el navegador

## Notas

- Todas las librerías de terceros (Bootstrap, jQuery, Leaflet) deben descargarse localmente en `assets/vendor/`
- Las imágenes subidas se guardan en `uploads/points/` con nombres únicos
- El punto de entrada principal es `index.php` para el público y `admin/` para administradores

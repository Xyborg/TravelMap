# Procesamiento Automático de Imágenes

## Descripción General

TravelMap incluye un sistema de procesamiento automático de imágenes que optimiza las fotografías al momento de subirlas, reduciendo su peso y dimensiones sin pérdida visual significativa.

## Características

### 1. Redimensionamiento Automático
- Las imágenes se redimensionan automáticamente si exceden las dimensiones máximas configuradas
- Mantiene la proporción de aspecto original
- Las imágenes más pequeñas que el límite se conservan en su tamaño original

### 2. Compresión Inteligente
- **JPEG**: Compresión ajustable mediante nivel de calidad (0-100)
- **PNG**: Preserva transparencia y aplica compresión optimizada
- **GIF**: Mantiene compatibilidad sin procesamiento adicional

### 3. Formatos Soportados
- JPEG/JPG (con compresión ajustable)
- PNG (con preservación de transparencia)

## Configuración

Accede al panel de administración → **Configuración** → **Configuración de Imágenes**

### Parámetros Disponibles

| Parámetro | Descripción | Rango | Valor por Defecto |
|-----------|-------------|-------|-------------------|
| **Ancho Máximo** | Ancho máximo en píxeles | 800 - 4096 | 1920 |
| **Alto Máximo** | Alto máximo en píxeles | 600 - 4096 | 1080 |
| **Calidad JPEG** | Nivel de compresión (%) | 50 - 100 | 85 |

### Recomendaciones

- **1920x1080 (Full HD)**: Equilibrio ideal entre calidad y tamaño
- **2560x1440 (2K)**: Para imágenes de alta calidad
- **Calidad 85%**: Compresión óptima sin pérdida visual perceptible
- **Calidad 90-95%**: Para fotografías profesionales
- **Calidad 75-80%**: Para reducir más el tamaño de archivo

## Requisitos Técnicos

### Extensión PHP Requerida

El procesamiento de imágenes requiere la extensión **GD** de PHP.

#### Verificar si está instalada

Crea un archivo `info.php` con:
```php
<?php phpinfo(); ?>
```

Busca la sección "gd" en la salida.

#### Habilitar en XAMPP

1. Abre `php.ini` (generalmente en `C:\xampp\php\php.ini`)
2. Busca la línea: `;extension=gd`
3. Quita el punto y coma: `extension=gd`
4. Reinicia Apache

#### Habilitar en Linux (Ubuntu/Debian)

```bash
sudo apt-get install php-gd
sudo systemctl restart apache2
```

#### Habilitar en Linux (CentOS/RHEL)

```bash
sudo yum install php-gd
sudo systemctl restart httpd
```

## Funcionamiento Interno

### Proceso de Subida

1. **Validación**: Verifica tipo MIME y extensión
2. **Tamaño**: Comprueba que no exceda el límite de carga
3. **Almacenamiento**: Guarda el archivo temporal
4. **Procesamiento**:
   - Carga configuración desde base de datos
   - Determina si necesita redimensionar
   - Aplica compresión según el formato
   - Preserva transparencia (PNG)
   - Guarda versión optimizada
5. **Limpieza**: Libera memoria

### Código de Ejemplo

```php
// La función uploadImage() ahora procesa automáticamente
$result = FileHelper::uploadImage($_FILES['image']);

if ($result['success']) {
    // Imagen subida y procesada
    $path = $result['path'];
} else {
    // Error
    $error = $result['error'];
}
```

## Casos de Uso

### Fotografía de Paisaje (3000x2000)
- **Original**: ~2.5 MB
- **Configuración**: 1920x1080, Calidad 85%
- **Resultado**: ~350 KB (reducción del 86%)
- **Dimensiones finales**: 1620x1080

### Fotografía Vertical (1080x1920)
- **Original**: ~1.8 MB
- **Configuración**: 1920x1080, Calidad 85%
- **Resultado**: No se redimensiona (ya cumple límites)
- **Compresión**: ~280 KB (reducción del 84%)

### Imagen PNG con Transparencia
- **Mantenimiento**: Preserva canal alfa
- **Compresión**: Optimización sin pérdida de transparencia

## Solución de Problemas

### "La extensión GD no está disponible"
**Solución**: Habilita la extensión GD en php.ini y reinicia Apache

### Las imágenes no se procesan
**Causa**: Error de permisos o configuración
**Solución**: 
- Verifica permisos de escritura en `uploads/`
- Revisa logs de PHP en `xampp/apache/logs/error.log`

### Calidad de imagen baja
**Solución**: Aumenta el parámetro "Calidad JPEG" a 90-95%

### Imágenes muy grandes
**Solución**: Reduce las dimensiones máximas o la calidad de compresión

## Migración para Usuarios Existentes

Si ya tienes TravelMap instalado, ejecuta:

```sql
-- Importar desde phpMyAdmin o línea de comandos
mysql -u root -p travelmap < install/migration_image_settings.sql
```

Esto agregará las 3 nuevas configuraciones sin afectar datos existentes.

## Rendimiento

- **Memoria**: ~10-20 MB por imagen durante procesamiento
- **Tiempo**: < 1 segundo para imágenes de 3000x2000
- **CPU**: Uso temporal durante la subida

## Seguridad

- Validación de tipo MIME antes de procesar
- Solo acepta formatos permitidos (JPEG, PNG)
- No ejecuta código embebido en imágenes
- Archivos procesados tienen permisos 0644

## Limitaciones

- No procesa imágenes GIF animadas
- Máximo recomendado: 100 MB (configurable en PHP)
- Requiere memoria suficiente en PHP (min. 128 MB)

## Referencias

- [Documentación PHP GD](https://www.php.net/manual/es/book.image.php)
- [Configuración de subida de archivos](https://www.php.net/manual/es/ini.core.php#ini.upload-max-filesize)

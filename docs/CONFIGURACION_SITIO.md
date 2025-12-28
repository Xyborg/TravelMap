# Configuración del Sitio Público

## Descripción General

TravelMap permite personalizar completamente la apariencia y metadatos del sitio público (index.php) sin necesidad de editar código. Todas las configuraciones se gestionan desde el panel de administración.

## Características Disponibles

### 1. Título del Sitio
- **Campo**: Título del Sitio
- **Uso**: Aparece en la pestaña del navegador y en resultados de búsqueda
- **Límite**: 100 caracteres
- **Ejemplo**: `Mis Aventuras por el Mundo`
- **SEO**: Es uno de los factores más importantes para posicionamiento

### 2. Meta Description
- **Campo**: Descripción del Sitio
- **Uso**: Descripción breve que aparece en Google y otros buscadores
- **Límite**: 160 caracteres (recomendado)
- **Ejemplo**: `Descubre mis viajes por 30 países con mapas interactivos, rutas detalladas y fotografías de cada destino`
- **SEO**: Influye en el CTR (click-through rate) en resultados de búsqueda

### 3. Favicon
- **Campo**: Favicon (URL)
- **Uso**: Ícono que aparece en la pestaña del navegador
- **Formatos aceptados**: .ico, .png
- **Tamaños recomendados**: 
  - 16x16 píxeles (mínimo)
  - 32x32 píxeles (recomendado)
  - 64x64 píxeles (HD)
- **Ubicación**: Sube el archivo a `uploads/` y referencia la ruta
- **Ejemplo**: `/TravelMap/uploads/favicon.ico`

### 4. Código de Analytics
- **Campo**: Código de Analytics / Scripts Personalizados
- **Uso**: Insertar scripts de seguimiento o personalización
- **Formatos**: HTML, JavaScript
- **Casos de uso**:
  - Google Analytics
  - Facebook Pixel
  - Google Tag Manager
  - Scripts personalizados
  - Meta tags adicionales

## Acceso a la Configuración

1. Inicia sesión en el panel de administración
2. Navega a **Configuración** en el menú principal
3. Busca la sección **"Configuración del Sitio Público"**
4. Modifica los campos según tus necesidades
5. Haz clic en **"Guardar Configuración"**

## Guías de Configuración

### Crear y Subir un Favicon

#### Opción 1: Usando un generador online
1. Ve a https://favicon.io/ o https://realfavicongenerator.net/
2. Sube una imagen o genera un favicon desde texto
3. Descarga el archivo .ico o .png generado
4. Sube el archivo a `c:\xampp\htdocs\TravelMap\uploads\`
5. En el panel de configuración, ingresa: `/TravelMap/uploads/favicon.ico`

#### Opción 2: Usando Photoshop/GIMP
1. Crea una imagen de 32x32 píxeles
2. Exporta en formato PNG o ICO
3. Sube el archivo a la carpeta `uploads/`
4. Configura la ruta en el panel

### Configurar Google Analytics

#### Google Analytics 4 (GA4)
1. Accede a https://analytics.google.com/
2. Crea una propiedad (si aún no tienes una)
3. Copia el código de seguimiento que se ve así:

```html
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-XXXXXXXXXX');
</script>
```

4. Pega este código completo en el campo **"Código de Analytics"**
5. Guarda la configuración
6. Verifica en Google Analytics que esté recibiendo datos (puede tardar 24-48 horas)

#### Universal Analytics (versión antigua)
```html
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-XXXXXXXXX-X', 'auto');
  ga('send', 'pageview');
</script>
```

### Configurar Facebook Pixel

1. Accede a Facebook Business Manager
2. Ve a "Eventos" → "Píxeles"
3. Copia el código del píxel:

```html
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', 'XXXXXXXXXXXXXXX');
  fbq('track', 'PageView');
</script>
<noscript>
  <img height="1" width="1" style="display:none"
       src="https://www.facebook.com/tr?id=XXXXXXXXXXXXXXX&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
```

4. Pégalo en el campo de Analytics

### Configurar Google Tag Manager

```html
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-XXXXXXX');</script>
<!-- End Google Tag Manager -->
```

## Ejemplos de Configuración

### Ejemplo Básico
```
Título: Mi Blog de Viajes
Descripción: Aventuras por Asia, Europa y América con guías y consejos de viaje
Favicon: /TravelMap/uploads/favicon.ico
Analytics: (vacío)
```

### Ejemplo con Analytics
```
Título: Viajes por el Mundo - Juan Pérez
Descripción: 50 países visitados. Mapas interactivos, rutas GPS y fotografías de cada destino
Favicon: /TravelMap/uploads/logo-32x32.png
Analytics: <!-- Código de Google Analytics GA4 aquí -->
```

### Ejemplo con Múltiples Scripts
```html
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-XXXXXXXXXX');
</script>

<!-- Facebook Pixel -->
<script>
  fbq('init', 'XXXXXXXXXXXXXXX');
  fbq('track', 'PageView');
</script>

<!-- Meta tags adicionales -->
<meta property="og:title" content="Mis Viajes por el Mundo">
<meta property="og:description" content="Explora mis aventuras">
```

## Mejores Prácticas

### Título del Sitio
✅ **Bueno**: "Viajes por Europa - Blog de Juan Pérez"
❌ **Malo**: "Bienvenido a mi sitio web de viajes increíbles por todo el planeta tierra"

- Sé conciso y descriptivo
- Incluye palabras clave relevantes
- Máximo 60 caracteres para SEO óptimo

### Meta Description
✅ **Bueno**: "Descubre 30 países con mapas interactivos, rutas GPS y consejos de viaje. Guías detalladas de Asia, Europa y América."
❌ **Malo**: "Este es mi sitio web donde comparto fotos."

- Resume el contenido en 150-160 caracteres
- Incluye llamada a la acción
- Usa palabras clave naturalmente

### Favicon
✅ **Bueno**: Ícono simple y reconocible, buen contraste
❌ **Malo**: Imagen compleja, texto ilegible en tamaño pequeño

- Usa colores sólidos
- Evita detalles excesivos
- Prueba en diferentes navegadores

## Seguridad y Privacidad

### Código de Analytics

⚠️ **Advertencia**: El código que insertes en este campo se ejecutará en el navegador de todos los visitantes.

**Recomendaciones**:
- Solo pega código de fuentes confiables (Google, Facebook, etc.)
- No insertes código de terceros desconocidos
- Revisa las políticas de privacidad de los servicios que uses
- Considera agregar un aviso de cookies si usas analytics

### Ejemplo de Aviso de Privacidad

Si usas Google Analytics, considera agregar en tu sitio:

```html
<!-- Aviso de cookies simple -->
<script>
  if (!localStorage.getItem('cookiesAccepted')) {
    alert('Este sitio usa cookies para análisis. Al continuar, aceptas su uso.');
    localStorage.setItem('cookiesAccepted', 'true');
  }
</script>
```

O usa una solución más robusta como Cookie Consent.

## Verificación y Testing

### Verificar que los cambios se aplicaron

1. Abre el sitio público en una ventana de incógnito
2. Verifica el título en la pestaña del navegador
3. Inspecciona el código fuente (Ctrl+U) y busca:
   - `<title>` - debe mostrar tu título
   - `<meta name="description">` - debe mostrar tu descripción
   - `<link rel="icon">` - debe apuntar a tu favicon
   - Tu código de analytics en el `<head>`

### Testing de Analytics

#### Google Analytics
1. Accede a tu cuenta de Google Analytics
2. Ve a "Tiempo real" → "Descripción general"
3. Abre tu sitio público en otra pestaña
4. Deberías ver tu visita en tiempo real

#### Facebook Pixel
1. Instala la extensión "Facebook Pixel Helper" en Chrome
2. Visita tu sitio público
3. La extensión mostrará un ícono verde si el píxel está activo

## Migración para Usuarios Existentes

Si ya tenías TravelMap instalado antes de esta actualización:

1. Ejecuta el script de migración:
   ```
   http://localhost/TravelMap/install/migrate_site_settings.php
   ```

2. El script agregará las 4 nuevas configuraciones con valores por defecto

3. Accede al panel de configuración y personaliza según tus necesidades

## Preguntas Frecuentes

### ¿Los cambios afectan al panel de administración?
No, solo afectan al sitio público (index.php). El panel admin mantiene su configuración original.

### ¿Puedo usar HTML en el campo de analytics?
Sí, puedes insertar cualquier código HTML válido, incluyendo scripts, meta tags, etc.

### ¿El favicon debe estar en la carpeta uploads?
No necesariamente. Puede estar en cualquier ubicación accesible por URL. Solo asegúrate de usar la ruta correcta.

### ¿Cuánto demora en actualizarse el título?
Los cambios son inmediatos. Recarga la página (Ctrl+F5 para limpiar caché) para verlos.

### ¿Puedo agregar múltiples códigos de analytics?
Sí, puedes pegar varios códigos uno tras otro en el mismo campo.

## Recursos Adicionales

- [Google Analytics](https://analytics.google.com/)
- [Facebook Pixel](https://www.facebook.com/business/help/952192354843755)
- [Google Tag Manager](https://tagmanager.google.com/)
- [Favicon Generator](https://favicon.io/)
- [Real Favicon Generator](https://realfavicongenerator.net/)
- [Meta Tags Generator](https://metatags.io/)

## Soporte

Si tienes problemas con la configuración:
1. Verifica que ejecutaste el script de migración
2. Limpia la caché del navegador (Ctrl+Shift+Del)
3. Revisa los logs de PHP en `xampp/apache/logs/error.log`
4. Consulta la documentación de cada servicio (Analytics, Pixel, etc.)

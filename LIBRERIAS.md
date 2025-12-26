# IMPORTANTE: Descarga de Librerías Locales

Para que la aplicación funcione correctamente, debes descargar las siguientes librerías y colocarlas en las carpetas indicadas:

## 📦 Bootstrap 5

**Descargar de:** https://getbootstrap.com/docs/5.3/getting-started/download/

**Versión recomendada:** 5.3.x

**Archivos necesarios:**
- `bootstrap.min.css` → Colocar en: `assets/vendor/bootstrap/css/`
- `bootstrap.bundle.min.js` → Colocar en: `assets/vendor/bootstrap/js/`

**Estructura final:**
```
assets/vendor/bootstrap/
├── css/
│   └── bootstrap.min.css
└── js/
    └── bootstrap.bundle.min.js
```

## 📦 jQuery

**Descargar de:** https://jquery.com/download/

**Versión recomendada:** 3.7.x (versión comprimida/minified)

**Archivo necesario:**
- `jquery.min.js` → Colocar en: `assets/vendor/jquery/`

**Estructura final:**
```
assets/vendor/jquery/
└── jquery.min.js
```

## 📦 Leaflet.js (Core)

**Descargar de:** https://leafletjs.com/download.html

**Versión recomendada:** 1.9.4

**Archivos necesarios:**
- `leaflet.css` → Colocar en: `assets/vendor/leaflet/css/`
- `leaflet.js` → Colocar en: `assets/vendor/leaflet/js/`
- Carpeta `images` (con los iconos) → Colocar en: `assets/vendor/leaflet/css/images/`

**Estructura final:**
```
assets/vendor/leaflet/
├── css/
│   ├── leaflet.css
│   └── images/
│       ├── marker-icon.png
│       ├── marker-icon-2x.png
│       └── marker-shadow.png
└── js/
    └── leaflet.js
```

## 📦 Leaflet.draw (Plugin - Dibujo de Rutas)

**Descargar de:** https://github.com/Leaflet/Leaflet.draw/releases

**Versión recomendada:** 1.0.4

**Archivos necesarios:**
- `leaflet.draw.css` → Colocar en: `assets/vendor/leaflet/plugins/`
- `leaflet.draw.js` → Colocar en: `assets/vendor/leaflet/plugins/`
- Carpeta `images` (con iconos del toolbar) → Colocar en: `assets/vendor/leaflet/plugins/images/`

**Instrucciones:**
1. Ve a: https://github.com/Leaflet/Leaflet.draw/releases/tag/v1.0.4
2. Descarga el archivo `leaflet.draw-1.0.4.zip`
3. Extrae los archivos de la carpeta `dist/`:
   - `leaflet.draw.css` → `assets/vendor/leaflet/plugins/`
   - `leaflet.draw.js` → `assets/vendor/leaflet/plugins/`
   - Carpeta `images/` completa → `assets/vendor/leaflet/plugins/images/`

## 📦 Leaflet.markercluster (Plugin - Agrupación de Marcadores)

**Descargar de:** https://github.com/Leaflet/Leaflet.markercluster/releases

**Versión recomendada:** 1.5.3

**Archivos necesarios:**
- `MarkerCluster.css` → Colocar en: `assets/vendor/leaflet/plugins/`
- `MarkerCluster.Default.css` → Colocar en: `assets/vendor/leaflet/plugins/`
- `leaflet.markercluster.js` → Colocar en: `assets/vendor/leaflet/plugins/`

**Instrucciones:**
1. Ve a: https://github.com/Leaflet/Leaflet.markercluster/releases/tag/v1.5.3
2. Descarga el archivo `leaflet.markercluster-1.5.3.zip`
3. Extrae los archivos de la carpeta `dist/`:
   - `MarkerCluster.css` → `assets/vendor/leaflet/plugins/`
   - `MarkerCluster.Default.css` → `assets/vendor/leaflet/plugins/`
   - `leaflet.markercluster.js` → `assets/vendor/leaflet/plugins/`

**Estructura final de Leaflet completo:**
```
assets/vendor/leaflet/
├── css/
│   ├── leaflet.css
│   └── images/
│       ├── marker-icon.png
│       ├── marker-icon-2x.png
│       └── marker-shadow.png
├── js/
│   └── leaflet.js
└── plugins/
    ├── leaflet.draw.css
    ├── leaflet.draw.js
    ├── MarkerCluster.css
    ├── MarkerCluster.Default.css
    ├── leaflet.markercluster.js
    └── images/
        ├── spritesheet.png
        ├── spritesheet-2x.png
        └── spritesheet.svg
```

## 🚀 Pasos Rápidos

1. **Bootstrap 5:**
   - Descarga desde https://getbootstrap.com/docs/5.3/getting-started/download/
   - Extrae `bootstrap.min.css` → `assets/vendor/bootstrap/css/`
   - Extrae `bootstrap.bundle.min.js` → `assets/vendor/bootstrap/js/`

2. **jQuery:**
   - Descarga desde https://jquery.com/download/ (compressed production)
   - Renombra a `jquery-3.7.1.min.js` → `assets/vendor/jquery/`

3. **Leaflet Core:**
   - Descarga desde https://leafletjs.com/download.html
   - Extrae `leaflet.css` → `assets/vendor/leaflet/css/`
   - Extrae `leaflet.js` → `assets/vendor/leaflet/js/`
   - Extrae carpeta `images/` → `assets/vendor/leaflet/css/images/`

4. **Leaflet.draw Plugin:**
   - Descarga https://github.com/Leaflet/Leaflet.draw/releases/tag/v1.0.4
   - Extrae archivos de `dist/` → `assets/vendor/leaflet/plugins/`
   - Incluye: `leaflet.draw.css`, `leaflet.draw.js` y carpeta `images/`

5. **Leaflet.markercluster Plugin:**
   - Descarga https://github.com/Leaflet/Leaflet.markercluster/releases/tag/v1.5.3
   - Extrae archivos de `dist/` → `assets/vendor/leaflet/plugins/`
   - Incluye: `MarkerCluster.css`, `MarkerCluster.Default.css`, `leaflet.markercluster.js`

## ⚠️ Nota Importante

Sin estas librerías, la aplicación no funcionará correctamente ya que:
- El layout depende de **Bootstrap**
- El JavaScript usa **jQuery**
- Los mapas requieren **Leaflet** y sus plugins

**¡Todas las librerías son necesarias para el funcionamiento completo!**

## ✅ Verificación

Puedes verificar que los archivos estén correctamente instalados accediendo a:

**Bootstrap:**
- `http://localhost/TravelMap/assets/vendor/bootstrap/css/bootstrap.min.css`
- `http://localhost/TravelMap/assets/vendor/bootstrap/js/bootstrap.bundle.min.js`

**jQuery:**
- `http://localhost/TravelMap/assets/vendor/jquery/jquery-3.7.1.min.js`

**Leaflet:**
- `http://localhost/TravelMap/assets/vendor/leaflet/css/leaflet.css`
- `http://localhost/TravelMap/assets/vendor/leaflet/js/leaflet.js`
- `http://localhost/TravelMap/assets/vendor/leaflet/plugins/leaflet.draw.css`
- `http://localhost/TravelMap/assets/vendor/leaflet/plugins/leaflet.draw.js`
- `http://localhost/TravelMap/assets/vendor/leaflet/plugins/leaflet.markercluster.js`

Si ves el código fuente de las librerías, ¡están instaladas correctamente!

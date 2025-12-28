-- ============================================
-- Migración: Agregar configuraciones del sitio público
-- Fecha: 2025-12-28
-- Descripción: Agrega 4 nuevas configuraciones para personalizar el sitio público
-- ============================================

USE travelmap;

-- Agregar configuraciones de sitio público si no existen
INSERT INTO settings (setting_key, setting_value, setting_type, description) 
SELECT * FROM (
    SELECT 'site_title' as setting_key, 'Travel Map - Mis Viajes por el Mundo' as setting_value, 'string' as setting_type, 'Título del sitio público' as description
    UNION ALL
    SELECT 'site_description', 'Explora mis viajes por el mundo con mapas interactivos, rutas y fotografías', 'string', 'Descripción del sitio para SEO'
    UNION ALL
    SELECT 'site_favicon', '', 'string', 'URL del favicon (ejemplo: /TravelMap/uploads/favicon.ico)'
    UNION ALL
    SELECT 'site_analytics_code', '', 'string', 'Código de Google Analytics u otro script de análisis'
) AS tmp
WHERE NOT EXISTS (
    SELECT 1 FROM settings WHERE setting_key = tmp.setting_key
);

-- Verificar que se agregaron correctamente
SELECT setting_key, setting_value, setting_type, description 
FROM settings 
WHERE setting_key IN ('site_title', 'site_description', 'site_favicon', 'site_analytics_code')
ORDER BY setting_key;

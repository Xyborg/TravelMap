-- ============================================
-- Migración: Agregar configuraciones de procesamiento de imágenes
-- Fecha: 2025-12-28
-- Descripción: Agrega 3 nuevas configuraciones para el procesamiento automático de imágenes
-- ============================================

USE travelmap;

-- Agregar configuraciones de imagen si no existen
INSERT INTO settings (setting_key, setting_value, setting_type, description) 
SELECT * FROM (
    SELECT 'image_max_width' as setting_key, '1920' as setting_value, 'number' as setting_type, 'Ancho máximo de imágenes en píxeles' as description
    UNION ALL
    SELECT 'image_max_height', '1080', 'number', 'Alto máximo de imágenes en píxeles'
    UNION ALL
    SELECT 'image_quality', '85', 'number', 'Calidad de compresión JPEG (0-100)'
) AS tmp
WHERE NOT EXISTS (
    SELECT 1 FROM settings WHERE setting_key IN ('image_max_width', 'image_max_height', 'image_quality')
);

-- Verificar que se agregaron correctamente
SELECT setting_key, setting_value, setting_type, description 
FROM settings 
WHERE setting_key IN ('image_max_width', 'image_max_height', 'image_quality')
ORDER BY setting_key;

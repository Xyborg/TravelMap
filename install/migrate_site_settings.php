<?php
/**
 * Migración: Agregar configuraciones del sitio público
 * 
 * Ejecuta este script UNA SOLA VEZ desde el navegador:
 * http://localhost/TravelMap/install/migrate_site_settings.php
 * 
 * Después de ejecutarlo, elimina o protege este archivo
 */

require_once __DIR__ . '/../config/db.php';

// Configuración de salida
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Migración - Configuraciones del Sitio Público</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
        }
        .success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .info {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #0c5460;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .settings-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .settings-table th,
        .settings-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .settings-table th {
            background-color: #007bff;
            color: white;
        }
        .settings-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        code {
            background-color: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🌐 Migración de Configuraciones del Sitio Público</h1>
        
        <div class="info">
            <strong>ℹ️ Información:</strong> Este script agregará las configuraciones necesarias para personalizar el sitio público (título, descripción, favicon y analytics).
        </div>

<?php

try {
    // Obtener conexión
    $conn = getDB();
    
    echo "<h2>Verificando configuraciones existentes...</h2>";
    
    // Verificar si ya existen
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM settings WHERE setting_key IN ('site_title', 'site_description', 'site_favicon', 'site_analytics_code')");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count'] > 0) {
        echo '<div class="warning">';
        echo '<strong>⚠️ Algunas configuraciones ya existen</strong><br>';
        echo 'Se actualizarán solo las que falten.';
        echo '</div>';
    }
    
    echo "<h2>Agregando/Verificando configuraciones...</h2>";
    
    // Configuraciones a insertar
    $newSettings = [
        [
            'key' => 'site_title',
            'value' => 'Travel Map - Mis Viajes por el Mundo',
            'type' => 'string',
            'description' => 'Título del sitio público'
        ],
        [
            'key' => 'site_description',
            'value' => 'Explora mis viajes por el mundo con mapas interactivos, rutas y fotografías',
            'type' => 'string',
            'description' => 'Descripción del sitio para SEO'
        ],
        [
            'key' => 'site_favicon',
            'value' => '',
            'type' => 'string',
            'description' => 'URL del favicon (ejemplo: /TravelMap/uploads/favicon.ico)'
        ],
        [
            'key' => 'site_analytics_code',
            'value' => '',
            'type' => 'string',
            'description' => 'Código de Google Analytics u otro script de análisis'
        ]
    ];
    
    // Verificar e insertar cada configuración
    $inserted = 0;
    $skipped = 0;
    
    foreach ($newSettings as $setting) {
        // Verificar si ya existe
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM settings WHERE setting_key = ?");
        $stmt->execute([$setting['key']]);
        $exists = $stmt->fetch(PDO::FETCH_ASSOC)['count'] > 0;
        
        if (!$exists) {
            // Insertar
            $stmt = $conn->prepare("INSERT INTO settings (setting_key, setting_value, setting_type, description) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $setting['key'],
                $setting['value'],
                $setting['type'],
                $setting['description']
            ]);
            $inserted++;
        } else {
            $skipped++;
        }
    }
    
    if ($inserted > 0) {
        echo '<div class="success">';
        echo '<strong>✓ Migración completada exitosamente</strong><br>';
        echo "Se agregaron <strong>$inserted</strong> nuevas configuraciones.";
        if ($skipped > 0) {
            echo "<br>Se omitieron <strong>$skipped</strong> configuraciones existentes.";
        }
        echo '</div>';
    } else {
        echo '<div class="info">';
        echo '<strong>✓ Todas las configuraciones ya existen</strong><br>';
        echo 'No fue necesario agregar nuevas configuraciones.';
        echo '</div>';
    }
    
    // Mostrar configuraciones actuales
    $stmt = $conn->prepare("SELECT setting_key, setting_value, setting_type, description FROM settings WHERE setting_key IN ('site_title', 'site_description', 'site_favicon', 'site_analytics_code') ORDER BY setting_key");
    $stmt->execute();
    $settings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo '<h3>Configuraciones Actuales:</h3>';
    echo '<table class="settings-table">';
    echo '<tr><th>Clave</th><th>Valor</th><th>Tipo</th><th>Descripción</th></tr>';
    foreach ($settings as $setting) {
        $displayValue = $setting['setting_value'];
        if (empty($displayValue)) {
            $displayValue = '<em style="color: #999;">vacío</em>';
        } elseif (strlen($displayValue) > 50) {
            $displayValue = substr($displayValue, 0, 47) . '...';
        }
        
        echo '<tr>';
        echo '<td><code>' . htmlspecialchars($setting['setting_key']) . '</code></td>';
        echo '<td>' . $displayValue . '</td>';
        echo '<td>' . htmlspecialchars($setting['setting_type']) . '</td>';
        echo '<td>' . htmlspecialchars($setting['description']) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    
    echo '<h2>Próximos pasos</h2>';
    echo '<div class="info">';
    echo '<ol>';
    echo '<li>Accede al panel de administración: <a href="../admin/" target="_blank">Admin Panel</a></li>';
    echo '<li>Ve a <strong>Configuración</strong> en el menú</li>';
    echo '<li>Busca la sección <strong>"Configuración del Sitio Público"</strong></li>';
    echo '<li>Personaliza el título, descripción y otros campos según tus preferencias</li>';
    echo '<li>Para agregar un favicon:';
    echo '<ul>';
    echo '<li>Sube un archivo .ico o .png de 16x16 o 32x32 píxeles a <code>uploads/</code></li>';
    echo '<li>Ingresa la ruta en el campo Favicon (ejemplo: <code>/TravelMap/uploads/favicon.ico</code>)</li>';
    echo '</ul>';
    echo '</li>';
    echo '<li>Para agregar Google Analytics:';
    echo '<ul>';
    echo '<li>Copia el código de seguimiento desde tu cuenta de Google Analytics</li>';
    echo '<li>Pégalo en el campo "Código de Analytics"</li>';
    echo '</ul>';
    echo '</li>';
    echo '<li><strong>¡IMPORTANTE!</strong> Elimina o protege este archivo (<code>install/migrate_site_settings.php</code>)</li>';
    echo '</ol>';
    echo '</div>';
    
    echo '<h2>Ejemplo de código de Google Analytics</h2>';
    echo '<div class="info">';
    echo '<p>Si deseas agregar Google Analytics, el código se vería así:</p>';
    echo '<pre style="background: #f4f4f4; padding: 10px; border-radius: 4px; overflow-x: auto;">';
    echo htmlspecialchars('<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag(\'js\', new Date());
  gtag(\'config\', \'G-XXXXXXXXXX\');
</script>');
    echo '</pre>';
    echo '<p><small>Reemplaza <code>G-XXXXXXXXXX</code> con tu ID de medición real.</small></p>';
    echo '</div>';
    
} catch (PDOException $e) {
    echo '<div class="error">';
    echo '<strong>❌ Error de base de datos:</strong><br>';
    echo htmlspecialchars($e->getMessage());
    echo '</div>';
} catch (Exception $e) {
    echo '<div class="error">';
    echo '<strong>❌ Error:</strong><br>';
    echo htmlspecialchars($e->getMessage());
    echo '</div>';
}

?>

    </div>
</body>
</html>

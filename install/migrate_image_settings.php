<?php
/**
 * Migración: Agregar configuraciones de procesamiento de imágenes
 * 
 * Ejecuta este script UNA SOLA VEZ desde el navegador:
 * http://localhost/TravelMap/install/migrate_image_settings.php
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
    <title>Migración - Configuraciones de Imagen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
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
            border-bottom: 3px solid #4CAF50;
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
            background-color: #4CAF50;
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
        <h1>🖼️ Migración de Configuraciones de Imagen</h1>
        
        <div class="info">
            <strong>ℹ️ Información:</strong> Este script agregará las configuraciones necesarias para el procesamiento automático de imágenes.
        </div>

<?php

try {
    // Obtener conexión
    $conn = getDB();
    
    echo "<h2>Verificando configuraciones existentes...</h2>";
    
    // Verificar si ya existen
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM settings WHERE setting_key IN ('image_max_width', 'image_max_height', 'image_quality')");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count'] > 0) {
        echo '<div class="info">';
        echo '<strong>✓ Las configuraciones ya existen</strong><br>';
        echo 'No es necesario ejecutar esta migración nuevamente.';
        echo '</div>';
        
        // Mostrar configuraciones actuales
        $stmt = $conn->prepare("SELECT setting_key, setting_value, setting_type, description FROM settings WHERE setting_key IN ('image_max_width', 'image_max_height', 'image_quality') ORDER BY setting_key");
        $stmt->execute();
        $settings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo '<h3>Configuraciones Actuales:</h3>';
        echo '<table class="settings-table">';
        echo '<tr><th>Clave</th><th>Valor</th><th>Tipo</th><th>Descripción</th></tr>';
        foreach ($settings as $setting) {
            echo '<tr>';
            echo '<td><code>' . htmlspecialchars($setting['setting_key']) . '</code></td>';
            echo '<td><strong>' . htmlspecialchars($setting['setting_value']) . '</strong></td>';
            echo '<td>' . htmlspecialchars($setting['setting_type']) . '</td>';
            echo '<td>' . htmlspecialchars($setting['description']) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        
    } else {
        echo "<h2>Agregando nuevas configuraciones...</h2>";
        
        // Configuraciones a insertar
        $newSettings = [
            [
                'key' => 'image_max_width',
                'value' => '1920',
                'type' => 'number',
                'description' => 'Ancho máximo de imágenes en píxeles'
            ],
            [
                'key' => 'image_max_height',
                'value' => '1080',
                'type' => 'number',
                'description' => 'Alto máximo de imágenes en píxeles'
            ],
            [
                'key' => 'image_quality',
                'value' => '85',
                'type' => 'number',
                'description' => 'Calidad de compresión JPEG (0-100)'
            ]
        ];
        
        // Insertar cada configuración
        $stmt = $conn->prepare("INSERT INTO settings (setting_key, setting_value, setting_type, description) VALUES (?, ?, ?, ?)");
        
        $inserted = 0;
        foreach ($newSettings as $setting) {
            $stmt->execute([
                $setting['key'],
                $setting['value'],
                $setting['type'],
                $setting['description']
            ]);
            $inserted++;
        }
        
        echo '<div class="success">';
        echo '<strong>✓ Migración completada exitosamente</strong><br>';
        echo "Se agregaron <strong>$inserted</strong> nuevas configuraciones.";
        echo '</div>';
        
        // Mostrar configuraciones insertadas
        $stmt = $conn->prepare("SELECT setting_key, setting_value, setting_type, description FROM settings WHERE setting_key IN ('image_max_width', 'image_max_height', 'image_quality') ORDER BY setting_key");
        $stmt->execute();
        $settings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo '<h3>Configuraciones Agregadas:</h3>';
        echo '<table class="settings-table">';
        echo '<tr><th>Clave</th><th>Valor</th><th>Tipo</th><th>Descripción</th></tr>';
        foreach ($settings as $setting) {
            echo '<tr>';
            echo '<td><code>' . htmlspecialchars($setting['setting_key']) . '</code></td>';
            echo '<td><strong>' . htmlspecialchars($setting['setting_value']) . '</strong></td>';
            echo '<td>' . htmlspecialchars($setting['setting_type']) . '</td>';
            echo '<td>' . htmlspecialchars($setting['description']) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    
    // Verificar extensión GD
    echo '<h2>Verificando requisitos...</h2>';
    
    if (extension_loaded('gd')) {
        $gdInfo = gd_info();
        echo '<div class="success">';
        echo '<strong>✓ Extensión GD instalada y activa</strong><br>';
        echo 'Versión: ' . htmlspecialchars($gdInfo['GD Version']) . '<br>';
        echo 'Soporte JPEG: ' . ($gdInfo['JPEG Support'] ? 'Sí' : 'No') . '<br>';
        echo 'Soporte PNG: ' . ($gdInfo['PNG Support'] ? 'Sí' : 'No');
        echo '</div>';
    } else {
        echo '<div class="error">';
        echo '<strong>⚠️ Extensión GD NO está instalada</strong><br>';
        echo 'El procesamiento de imágenes NO funcionará hasta que habilites la extensión GD.<br>';
        echo '<br><strong>Solución:</strong><br>';
        echo '1. Abre <code>php.ini</code> (en XAMPP: <code>C:\\xampp\\php\\php.ini</code>)<br>';
        echo '2. Busca la línea <code>;extension=gd</code><br>';
        echo '3. Quita el punto y coma: <code>extension=gd</code><br>';
        echo '4. Reinicia Apache<br>';
        echo '</div>';
    }
    
    echo '<h2>Próximos pasos</h2>';
    echo '<div class="info">';
    echo '<ol>';
    echo '<li>Accede al panel de administración: <a href="../admin/">Admin Panel</a></li>';
    echo '<li>Ve a <strong>Configuración</strong> en el menú</li>';
    echo '<li>Ajusta las opciones de <strong>Configuración de Imágenes</strong> según tus necesidades</li>';
    echo '<li><strong>¡IMPORTANTE!</strong> Elimina o protege este archivo (<code>install/migrate_image_settings.php</code>)</li>';
    echo '</ol>';
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

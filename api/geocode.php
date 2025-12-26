<?php
/**
 * API Proxy para Geocoding con Nominatim
 * 
 * Actúa como intermediario para evitar problemas de CORS
 * al realizar búsquedas de lugares con OpenStreetMap Nominatim
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

// Validar que sea una petición GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

// Obtener el parámetro de búsqueda
$query = $_GET['q'] ?? '';

// Validar que haya una consulta
if (empty($query) || strlen(trim($query)) < 3) {
    http_response_code(400);
    echo json_encode(['error' => 'La consulta debe tener al menos 3 caracteres']);
    exit;
}

// Parámetros para Nominatim
$limit = isset($_GET['limit']) ? min((int)$_GET['limit'], 10) : 5;
$format = 'json';
$addressdetails = 1;

// Construir URL de Nominatim
$nominatimUrl = 'https://nominatim.openstreetmap.org/search?' . http_build_query([
    'format' => $format,
    'q' => $query,
    'limit' => $limit,
    'addressdetails' => $addressdetails
]);

// Configurar cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $nominatimUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

// User-Agent es requerido por Nominatim
curl_setopt($ch, CURLOPT_USERAGENT, 'TravelMap/1.0 (PHP Proxy)');

// Headers adicionales
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Accept-Language: es,en'
]);

// Ejecutar petición
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);

curl_close($ch);

// Verificar si hubo error en cURL
if ($response === false) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error al conectar con el servicio de geocoding',
        'details' => $curlError
    ]);
    exit;
}

// Verificar código HTTP
if ($httpCode !== 200) {
    http_response_code($httpCode);
    echo json_encode([
        'error' => 'El servicio de geocoding retornó un error',
        'http_code' => $httpCode
    ]);
    exit;
}

// Verificar que la respuesta sea JSON válido
$data = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Respuesta inválida del servicio de geocoding'
    ]);
    exit;
}

// Devolver los resultados
echo json_encode($data);

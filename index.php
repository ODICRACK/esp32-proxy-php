<?php
// Proxy para evitar el bloqueo de InfinityFree

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$baseUrl = "https://odimon.42web.io/PHP/index.php";

// Leer parámetros que vengan del ESP32
$query = http_build_query($_GET);

// Construir URL final
$target = "$baseUrl?$query";

// Llamar al servidor real
$response = @file_get_contents($target);

// Si falla, intenta mostrar el error
if ($response === FALSE) {
    echo json_encode([
        "success" => false,
        "error" => "No se pudo conectar al servidor original."
    ]);
    exit;
}

// Devolver al ESP32 la respuesta tal cual
echo $response;
?>
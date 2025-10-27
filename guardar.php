<?php
// Permitir CORS si pruebas localmente
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain; charset=utf-8");

// Leer datos JSON del cuerpo de la solicitud
$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (!$data || !isset($data["latitud"]) || !isset($data["longitud"])) {
    http_response_code(400);
    echo "Datos inválidos";
    exit;
}

$lat = $data["latitud"];
$lng = $data["longitud"];
$fecha = $data["fecha"] ?? date("Y-m-d H:i:s");

$linea = "Fecha: $fecha | Latitud: $lat | Longitud: $lng" . PHP_EOL;

// Ruta donde se guardará el archivo
$archivo = __DIR__ . "/coordenadas.txt";

// Guardar (agregar al final)
file_put_contents($archivo, $linea, FILE_APPEND | LOCK_EX);

echo "Coordenadas guardadas correctamente en el servidor.";
?>

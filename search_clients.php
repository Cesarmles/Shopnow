<?php
// Configura tu clave API de Google Maps
$api_key = 'TU_CLAVE_API_AQUI';

// Define la ubicación y el término de búsqueda
$location = '40.730610,-73.935242'; // Coordenadas de la ubicación (latitud,longitud)
$radius = 5000; // Radio de búsqueda en metros
$keyword = 'cliente'; // Palabra clave para la búsqueda

// URL para la solicitud de la API
$url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$location&radius=$radius&keyword=$keyword&key=$api_key";

// Ejecuta la solicitud cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

// Decodifica la respuesta JSON
$data = json_decode($response, true);

// Verifica si la solicitud fue exitosa
if ($data['status'] == 'OK') {
    echo "<h1>Resultados de Búsqueda:</h1>";
    foreach ($data['results'] as $place) {
        echo "<h2>" . htmlspecialchars($place['name']) . "</h2>";
        echo "<p>Dirección: " . htmlspecialchars($place['vicinity']) . "</p>";
        echo "<p>Tipo: " . htmlspecialchars(implode(', ', $place['types'])) . "</p>";
        echo "<p><a href='https://www.google.com/maps/place/?q=place_id:" . htmlspecialchars($place['place_id']) . "' target='_blank'>Ver en Google Maps</a></p>";
        echo "<hr>";
    }
} else {
    echo "<p>Error en la solicitud: " . htmlspecialchars($data['status']) . "</p>";
}
?>

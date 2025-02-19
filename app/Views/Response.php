<?php
namespace App\Views;

class Response {
    public static function sendResponse($status, $message, $data = null) {
    header('Content-Type: application/json');
    
    // Erstellen der Antwortstruktur
    $response = [
        'status' => $status,
        'message' => $message
    ];
    
    // Wenn es zusätzliche Daten gibt, füge diese der Antwort hinzu
    if ($data) {
        $response['data'] = $data;
    }
    
    // Rückgabe der JSON-kodierten Antwort
    echo json_encode($response);
    exit;  // Stoppe die Ausführung, da die Antwort gesendet wurde
}
}

?>

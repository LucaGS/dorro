<?php
require_once('/app/views/response.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getUser':
            // Transaktionshistorie abrufen
            if (isset($_GET['user_id'])) {
                $user_id = $_GET['user_id'];
                sendResponse("found", 'user123123', 'userID');
            } else {
                sendResponse('error', 'Benutzer-ID fehlt');
            }
            break;

        default:
            sendResponse('error', 'Unbekannte Aktion');
            break;
    }
}
?>

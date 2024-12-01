<?php
require_once('/app/views/response.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getUser':
                sendResponse("found", 'user123123', 'userID');
            break;
        default:
            sendResponse('error', 'Unbekannte Aktion');
            break;
    }
}
?>

<?php
require_once(__DIR__+'/app/views/response.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getUser':
                echo 'userfound';
            break;
        default:
           echo 'no user found';
            break;
    }
}
?>

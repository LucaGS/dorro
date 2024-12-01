<?php
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

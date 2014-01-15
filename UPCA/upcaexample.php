<?php
    ini_set('display_errors',1);
    error_reporting(E_ALL|E_STRICT);
    include 'UPCA.php';
    $code = isset($_GET['code']) ? $_GET['code'] :'123456789012'; 
    header("Content-type: image/svg+xml");
    echo draw($code);
?>

<?php
include_once __DIR__ . '/PDOHelper.php';
$pdoHelper = new PDOHelper();
echo json_encode( $pdoHelper->getUserByIdAndPassword( $_GET ),JSON_UNESCAPED_UNICODE );
?>
<?php
// SCRIPT PARA SUBIR IMÁGENES AL SERVIDOR (IMÁGENES DE PERFIL Y DE PRODUCTOS)
define('UPLOAD_DIR','profile_pictures/');

// Se obtiene la imagen de un json
$data = json_decode(file_get_contents('php://input'), true);
$url = $data['img'];
$image_parts = explode(';base64,', $data['img']);
$image_type_aux = explode('image/', $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);
$file = UPLOAD_DIR . uniqid() . '.png';
if (file_put_contents($file, $image_base64))
    echo json_encode($file);
?>

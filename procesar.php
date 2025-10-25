<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$archivo_json = 'usuarios.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
    $contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : '';

    if (empty($nombre) || empty($correo) || empty($contrasena)) {
        header('Location: index.php?error=campos_vacios');
        exit;
    }
    
    $contrasena_hasheada = password_hash($contrasena, PASSWORD_DEFAULT);

    $nuevo_usuario = [
        'id' => uniqid('user_', true), 
        'nombre' => $nombre,
        'correo' => $correo,
        'contrasena' => $contrasena_hasheada,
        'fecha_registro' => date('Y-m-d H:i:s')
    ];

    $usuarios = [];
    
    if (file_exists($archivo_json)) {

        $contenido = file_get_contents($archivo_json);

        $usuarios = json_decode($contenido, true);
 
        if (!is_array($usuarios)) {
            $usuarios = [];
        }
    }

    $usuarios[] = $nuevo_usuario;

    $json_datos = json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    
    if (file_put_contents($archivo_json, $json_datos)) {
        header('Location: index.php?success=1');
        exit;
    } else {
        header('Location: index.php?error=escritura');
        exit;
    }
    
} else {
    header('Location: index.php');
    exit;
}
?>
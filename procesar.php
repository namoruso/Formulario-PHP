<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$archivo_json = 'usuarios.json';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$accion = isset($_POST['accion']) ? $_POST['accion'] : '';

function leerUsuarios($archivo) {
    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);
        $usuarios = json_decode($contenido, true);
        return is_array($usuarios) ? $usuarios : [];
    }
    return [];
}

function guardarUsuarios($archivo, $usuarios) {
    $json_datos = json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($archivo, $json_datos);
}

function buscarUsuarioPorCorreo($usuarios, $correo) {
    foreach ($usuarios as $usuario) {
        if ($usuario['correo'] === $correo) {
            return $usuario;
        }
    }
    return null;
}

if ($accion === 'registrar') {

    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
    $contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : '';
    $contrasena2 = isset($_POST['confirm-contrasena']) ? trim($_POST['confirm-contrasena']) : '';

    if (empty($nombre) || empty($correo) || empty($contrasena) || empty($contrasena2)) {
        header('Location: index.php?registro&error=campos_vacios');
        exit;
    }

    $usuarios = leerUsuarios($archivo_json);

    if (buscarUsuarioPorCorreo($usuarios, $correo) !== null) {
        header('Location: index.php?registro&error=correo_existente');
        exit;
    }

    if ($contrasena != $contrasena2) {
        header('Location: index.php?registro&error=contrasenas_distintas');
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
 
    $usuarios[] = $nuevo_usuario;

    if (guardarUsuarios($archivo_json, $usuarios)) {
        header('Location: index.php?success=1');
        exit;
    } else {
        header('Location: index.php?registro&error=escritura');
        exit;
    }
}

elseif ($accion === 'login') {

    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
    $contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : '';

    if (empty($correo) || empty($contrasena)) {
        header('Location: index.php?error=campos_vacios');
        exit;
    }

    $usuarios = leerUsuarios($archivo_json);

    $usuario = buscarUsuarioPorCorreo($usuarios, $correo);

    if ($usuario === null) {
        header('Location: index.php?error=usuario_no_existe');
        exit;
    }

    if (password_verify($contrasena, $usuario['contrasena'])) {

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_correo'] = $usuario['correo'];

        header('Location: bienvenida.php');
        exit;
    } else {
        header('Location: index.php?error=credenciales_invalidas');
        exit;
    }
}

else {
    header('Location: index.php');
    exit;
}
?>
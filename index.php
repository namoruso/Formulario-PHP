<?php
$mostrar_exito = isset($_GET['success']) && $_GET['success'] == '1';
$mostrar_error = isset($_GET['error']);
$mensaje_error = '';

if ($mostrar_error) {
    switch ($_GET['error']) {
        case 'campos_vacios':
            $mensaje_error = 'Todos los campos son obligatorios.';
            break;
        case 'correo_existente':
            $mensaje_error = 'Este correo electrónico ya está registrado.';
            break;
        case 'escritura':
            $mensaje_error = 'Error al guardar los datos. Verifique los permisos.';
            break;
        case 'credenciales_invalidas':
            $mensaje_error = 'Correo o contraseña incorrectos.';
            break;
        case 'usuario_no_existe':
            $mensaje_error = 'No existe una cuenta con este correo electrónico.';
            break;
        default:
            $mensaje_error = 'Ha ocurrido un error. Intente nuevamente.';
    }
}

$mostrar_registro = isset($_GET['registro']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $mostrar_registro ? 'Registro' : 'Inicio de Sesión'; ?> - Hollow Knight</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="container">
        <h1><?php echo $mostrar_registro ? 'Crear Cuenta' : 'Iniciar Sesión'; ?></h1>
        
        <?php if ($mostrar_exito): ?>
        <div class="alert alert-success">
            <span class="alert-icon">✓</span>
            <div>
                <strong>¡Registro exitoso!</strong><br>
                Ahora puedes iniciar sesión.
            </div>
        </div>
        <?php endif; ?>
        
        <?php if ($mostrar_error): ?>
        <div class="alert alert-error">
            <span class="alert-icon">⚠</span>
            <div>
                <strong>Error</strong><br>
                <?php echo htmlspecialchars($mensaje_error); ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if ($mostrar_registro): ?>
        <form action="procesar.php" method="POST">
            <input type="hidden" name="accion" value="registrar">
            
            <div class="form-group">
                <label for="nombre">
                    Nombre <span class="required">*</span>
                </label>
                <input 
                    type="text" 
                    id="nombre" 
                    name="nombre" 
                    placeholder="Ingrese su nombre completo"
                    required
                >
            </div>
            
            <div class="form-group">
                <label for="correo">
                    Correo Electrónico <span class="required">*</span>
                </label>
                <input 
                    type="email" 
                    id="correo" 
                    name="correo" 
                    placeholder="ejemplo@correo.com"
                    required
                >
            </div>
            
            <div class="form-group">
                <label for="contrasena">
                    Contraseña <span class="required">*</span>
                </label>
                <input 
                    type="password" 
                    id="contrasena" 
                    name="contrasena" 
                    placeholder="Mínimo 6 caracteres"
                    required
                >
            </div>
            
            <button type="submit">Registrarse</button>
        </form>
        
        <p class="toggle-form">
            ¿Ya tienes cuenta? <a href="index.php">Inicia sesión aquí</a>
        </p>
        
        <?php else: ?>
        <form action="procesar.php" method="POST">
            <input type="hidden" name="accion" value="login">
            
            <div class="form-group">
                <label for="correo">
                    Correo Electrónico <span class="required">*</span>
                </label>
                <input 
                    type="email" 
                    id="correo" 
                    name="correo" 
                    placeholder="ejemplo@correo.com"
                    required
                >
            </div>
            
            <div class="form-group">
                <label for="contrasena">
                    Contraseña <span class="required">*</span>
                </label>
                <input 
                    type="password" 
                    id="contrasena" 
                    name="contrasena" 
                    placeholder="Ingrese su contraseña"
                    required
                >
            </div>
            
            <button type="submit">Iniciar Sesión</button>
        </form>
        
        <p class="toggle-form">
            ¿No tienes cuenta? <a href="index.php?registro">Regístrate aquí</a>
        </p>
        <?php endif; ?>
    </div>
</body>
</html>
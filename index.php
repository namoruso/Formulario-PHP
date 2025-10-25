<?php
$mostrar_exito = isset($_GET['success']) && $_GET['success'] == '1';
$mostrar_error = isset($_GET['error']);
$mensaje_error = '';

if ($mostrar_error) {
    switch ($_GET['error']) {
        case 'campos_vacios':
            $mensaje_error = 'Todos los campos son obligatorios.';
            break;
        case 'escritura':
            $mensaje_error = 'Error al guardar los datos. Verifique los permisos.';
            break;
        default:
            $mensaje_error = 'Ha ocurrido un error. Intente nuevamente.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h1>Registro de Usuario</h1>
        
        <?php if ($mostrar_exito): ?>
        <div class="alert alert-success">
            <span class="alert-icon">✓</span>
            <div>
                <strong>¡Registro exitoso!</strong><br>
                El usuario ha sido registrado correctamente.
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
        
        <form action="procesar.php" method="POST">
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
    </div>
</body>
</html>
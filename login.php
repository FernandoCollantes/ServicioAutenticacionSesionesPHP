<?php
// INICIO DE SESIÓN
// session_start() SIEMPRE debe ser lo primero en cada página que use sesiones
// Inicia o reanuda una sesión existente
session_start();

// Si el usuario ya está autenticado, redirigir a la página de bienvenida
// Esto evita que alguien ya logueado vuelva a ver el login
if (isset($_SESSION['usuario'])) {
    header("Location: bienvenida.php");
    exit(); // IMPORTANTE: siempre usar exit() después de header() para detener la ejecución
}

// Array predefinido de usuarios válidos (simulación de base de datos)
// Formato: "nombre_usuario" => "contraseña"
$usuarios = [
    "admin" => "1234",
    "usuario" => "abcd",
    "carlos" => "php2024"
];

// Variable para almacenar mensajes de error
$error = "";

// PROCESAMIENTO DEL FORMULARIO
// Verificar si se ha enviado el formulario mediante método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Obtener los datos del formulario y limpiarlos
    // trim() elimina espacios en blanco al inicio y final
    $nombre_usuario = trim($_POST['usuario'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? '');
    
    // VALIDACIÓN DE CREDENCIALES
    // Verificar si el usuario existe en el array Y si la contraseña coincide
    if (isset($usuarios[$nombre_usuario]) && $usuarios[$nombre_usuario] === $contrasena) {
        
        // AUTENTICACIÓN EXITOSA
        // Guardar información del usuario en la sesión
        $_SESSION['usuario'] = $nombre_usuario;
        $_SESSION['hora_login'] = date('H:i:s'); // Guardar hora de inicio de sesión
        
        // Redirigir a la página de bienvenida
        header("Location: bienvenida.php");
        exit();
        
    } else {
        // Credenciales incorrectas
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Autenticación</title>
    <!-- ENLACE AL CSS EXTERNO -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Contenedor centrado -->
    <div class="center-container">
        <div class="form-box">
            <h2>Iniciar Sesión</h2>
            
            <!-- Mostrar mensaje de error si existe -->
            <?php if ($error): ?>
                <div class="alert-error">
                    <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <!-- FORMULARIO DE LOGIN -->
            <form method="POST" action="">
                
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input 
                        type="text" 
                        id="usuario" 
                        name="usuario" 
                        required 
                        placeholder="Ingresa tu usuario"
                        autocomplete="username"
                    >
                </div>
                
                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input 
                        type="password" 
                        id="contrasena" 
                        name="contrasena" 
                        required 
                        placeholder="Ingresa tu contraseña"
                        autocomplete="current-password"
                    >
                </div>
                
                <button type="submit" class="btn-primary">Ingresar</button>
            </form>
            
            <!-- Información de usuarios de prueba -->
            <div class="alert-info">
                <strong>Usuarios de prueba:</strong><br>
                • <code>admin</code> / <code>1234</code><br>
                • <code>usuario</code> / <code>abcd</code><br>
                • <code>carlos</code> / <code>php2024</code>
            </div>
        </div>
    </div>
</body>
</html>
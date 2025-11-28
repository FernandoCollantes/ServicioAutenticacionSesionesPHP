<?php
// INICIO DE SESIÓN
session_start();

// Si el usuario ya está autenticado, redirigir a bienvenida
if (isset($_SESSION['usuario'])) {
    header("Location: bienvenida.php");
    exit();
}

// Array de usuarios válidos
$usuarios = [
    "admin" => "1234",
    "usuario" => "abcd",
    "carlos" => "php2024"
];

// Variable para mensajes de error
$error = "";

// PROCESAMIENTO DEL FORMULARIO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = trim($_POST['usuario'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? '');
    
    // VALIDACIÓN DE CREDENCIALES
    if (isset($usuarios[$nombre_usuario]) && $usuarios[$nombre_usuario] === $contrasena) {
        // AUTENTICACIÓN EXITOSA
        $_SESSION['usuario'] = $nombre_usuario;
        $_SESSION['hora_login'] = date('H:i:s');
        
        header("Location: bienvenida.php");
        exit();
    } else {
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
    <link rel="stylesheet" href="/ServicioAutenticacionSesionesPHP/frontend/css/main.css">
</head>
<body>
    <!-- Contenedor principal centrado -->
    <div class="container">
        
        <!-- Card de login -->
        <div class="card">
            
            <!-- Header del card -->
            <div class="card-header">
                <h2>Iniciar Sesión</h2>
            </div>
            
            <!-- Body del card -->
            <div class="card-body">
                
                <!-- Mensaje de error -->
                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <!-- Formulario -->
                <form method="POST" action="">
                    
                    <!-- Campo de usuario -->
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input 
                            type="text" 
                            id="usuario" 
                            name="usuario" 
                            class="form-control"
                            placeholder="Ingresa tu usuario"
                            required
                        >
                    </div>
                    
                    <!-- Campo de contraseña -->
                    <div class="form-group">
                        <label for="contrasena">Contraseña</label>
                        <input 
                            type="password" 
                            id="contrasena" 
                            name="contrasena" 
                            class="form-control"
                            placeholder="Ingresa tu contraseña"
                            required
                        >
                    </div>
                    
                    <!-- Botón de submit -->
                    <button type="submit" class="btn btn-primary btn-block">
                        Ingresar
                    </button>
                    
                </form>
                
            </div>
            
            <!-- Footer del card -->
            <div class="card-footer">
                <div class="alert alert-info">
                    <strong>Usuarios de prueba:</strong><br>
                    admin / 1234<br>
                    usuario / abcd<br>
                    carlos / php2024
                </div>
            </div>
            
        </div>
        
    </div>
</body>
</html>
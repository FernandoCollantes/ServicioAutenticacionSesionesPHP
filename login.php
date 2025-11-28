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
    <style>
        /* Estilos básicos para el formulario */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }
        
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
        }
        
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        button:hover {
            transform: translateY(-2px);
        }
        
        .error {
            background: #fee;
            color: #c33;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #c33;
        }
        
        .info {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 12px;
            color: #1976d2;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        
        <!-- Mostrar mensaje de error si existe -->
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <!-- FORMULARIO DE LOGIN -->
        <!-- action="" envía al mismo archivo, method="POST" para enviar datos de forma segura -->
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
            
            <button type="submit">Ingresar</button>
        </form>
        
        <!-- Información de usuarios de prueba -->
        <div class="info">
            <strong>Usuarios de prueba:</strong><br>
            • admin / 1234<br>
            • usuario / abcd<br>
            • carlos / php2024
        </div>
    </div>
</body>
</html>
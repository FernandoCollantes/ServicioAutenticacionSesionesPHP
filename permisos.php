<?php
// PÁGINA DE ACCESO DENEGADO
// Esta página se muestra cuando alguien intenta acceder a contenido protegido sin autenticarse

// Iniciar sesión para verificar el estado
session_start();

// Si el usuario YA está autenticado, redirigirlo a bienvenida
// (No tiene sentido que vea esta página si ya tiene sesión activa)
if (isset($_SESSION['usuario'])) {
    header("Location: bienvenida.php");
    exit();
}

// Si llegamos aquí, el usuario NO está autenticado
// Mostramos la página de acceso denegado
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Denegado - Sistema de Autenticación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        .error-container {
            background: white;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        
        .error-icon {
            font-size: 80px;
            margin-bottom: 20px;
            animation: shake 0.5s;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }
        
        h1 {
            color: #d32f2f;
            margin: 0 0 15px 0;
            font-size: 32px;
        }
        
        .subtitle {
            color: #666;
            font-size: 18px;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .message-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 20px;
            margin: 25px 0;
            text-align: left;
            border-radius: 5px;
        }
        
        .message-box strong {
            color: #856404;
            display: block;
            margin-bottom: 10px;
        }
        
        .message-box ul {
            margin: 10px 0;
            padding-left: 20px;
            color: #856404;
        }
        
        .message-box li {
            margin: 5px 0;
        }
        
        .btn {
            display: inline-block;
            padding: 15px 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 20px;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }
        
        .info-text {
            color: #999;
            font-size: 14px;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #eee;
        }
        
        .shield-icon {
            display: inline-block;
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <!-- ICONO DE ERROR -->
        <div class="error-icon shield-icon"></div>
        
        <!-- TÍTULO PRINCIPAL -->
        <h1>Acceso Denegado</h1>
        
        <!-- SUBTÍTULO EXPLICATIVO -->
        <p class="subtitle">
            No tienes permiso para acceder a esta página porque no has iniciado sesión.
        </p>
        
        <!-- CAJA DE INFORMACIÓN -->
        <div class="message-box">
            <strong>¿Por qué veo esta página?</strong>
            <ul>
                <li>Intentaste acceder a una página protegida</li>
                <li>Tu sesión no está activa o ha expirado</li>
                <li>Necesitas autenticarte primero</li>
            </ul>
        </div>
        
        <!-- BOTÓN PARA IR AL LOGIN -->
        <a href="login.php" class="btn">
            Ir al Login
        </a>
        
        <!-- INFORMACIÓN ADICIONAL -->
        <p class="info-text">
            Si ya tienes una cuenta, inicia sesión para acceder al contenido protegido.
        </p>
    </div>
    
    <script>
        // Mensaje opcional en consola para desarrolladores
        console.log("Acceso denegado - Se requiere autenticación");
        console.log("Redirige al usuario a login.php para autenticarse");
    </script>
</body>
</html>
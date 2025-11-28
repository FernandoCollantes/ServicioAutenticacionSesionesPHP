<?php
// PÁGINA DE BIENVENIDA (PROTEGIDA)
// Esta página solo debe ser accesible para usuarios autenticados

// Iniciar sesión para acceder a $_SESSION
session_start();

// PROTECCIÓN DE PÁGINA
// Verificar si el usuario está autenticado
// Si no existe la variable de sesión 'usuario', significa que no ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirigir a la página de "sin permisos"
    header("Location: permisos.php");
    exit();
}

// Si llegamos aquí, el usuario está autenticado correctamente
$nombre_usuario = $_SESSION['usuario'];
$hora_login = $_SESSION['hora_login'] ?? 'No disponible';

// Obtener la hora actual del servidor
$hora_actual = date('H:i:s');
$fecha_actual = date('d/m/Y');

// Obtener el día de la semana en español
$dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
$dia_semana = $dias[date('w')];

// Mensaje personalizado según el usuario
$mensajes_personalizados = [
    "admin" => "¡Bienvenido Administrador! Tienes acceso total al sistema.",
    "usuario" => "¡Hola! Esperamos que tengas un excelente día.",
    "carlos" => "¡Bienvenido Profesor! Listo para enseñar PHP hoy."
];

// Obtener mensaje personalizado o usar uno por defecto
$mensaje_bienvenida = $mensajes_personalizados[$nombre_usuario] ?? "¡Bienvenido al sistema!";

// Determinar saludo según la hora
$hora_numerica = (int)date('H');
if ($hora_numerica >= 6 && $hora_numerica < 12) {
    $saludo = "Buenos días";
} elseif ($hora_numerica >= 12 && $hora_numerica < 20) {
    $saludo = "Buenas tardes";
} else {
    $saludo = "Buenas noches";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida - Sistema de Autenticación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header h1 {
            margin: 0;
            font-size: 32px;
        }
        
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }
        
        .content {
            padding: 40px;
        }
        
        .info-card {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        
        .info-card h3 {
            margin-top: 0;
            color: #667eea;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .label {
            font-weight: bold;
            color: #555;
        }
        
        .value {
            color: #333;
        }
        
        .welcome-message {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            padding: 25px;
            border-radius: 10px;
            margin: 20px 0;
            text-align: center;
            font-size: 18px;
            color: #333;
            line-height: 1.6;
        }
        
        .actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            justify-content: center;
        }
        
        .btn {
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.2s, box-shadow 0.2s;
            display: inline-block;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .btn-logout {
            background: #dc3545;
            color: white;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .emoji {
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- ENCABEZADO CON SALUDO -->
        <div class="header">
            <h1><span class="emoji"></span> <?php echo $saludo; ?>, <?php echo htmlspecialchars($nombre_usuario); ?>!</h1>
            <p><?php echo $dia_semana; ?>, <?php echo $fecha_actual; ?></p>
        </div>
        
        <div class="content">
            <!-- MENSAJE DE BIENVENIDA PERSONALIZADO -->
            <div class="welcome-message">
                <span class="emoji"></span>
                <p><?php echo htmlspecialchars($mensaje_bienvenida); ?></p>
            </div>
            
            <!-- INFORMACIÓN DE LA SESIÓN -->
            <div class="info-card">
                <h3>Información de tu sesión</h3>
                
                <div class="info-item">
                    <span class="label">Usuario:</span>
                    <span class="value"><?php echo htmlspecialchars($nombre_usuario); ?></span>
                </div>
                
                <div class="info-item">
                    <span class="label">Hora actual:</span>
                    <span class="value"><?php echo $hora_actual; ?></span>
                </div>
                
                <div class="info-item">
                    <span class="label">Inicio de sesión:</span>
                    <span class="value"><?php echo $hora_login; ?></span>
                </div>
                
                <div class="info-item">
                    <span class="label">Fecha:</span>
                    <span class="value"><?php echo $fecha_actual; ?></span>
                </div>
                
                <div class="info-item">
                    <span class="label">Estado:</span>
                    <span class="value" style="color: #28a745; font-weight: bold;">Autenticado ✓</span>
                </div>
            </div>
            
            <!-- ACCIONES DISPONIBLES -->
            <div class="actions">
                <!-- Enlace para cerrar sesión -->
                <a href="logout.php" class="btn btn-logout">
                    Cerrar Sesión
                </a>
                
                <!-- Enlace opcional para recargar la página -->
                <a href="bienvenida.php" class="btn btn-secondary">
                    Actualizar Hora
                </a>
            </div>
        </div>
    </div>
</body>
</html>
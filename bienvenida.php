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
    <!-- ENLACE AL CSS EXTERNO -->
    <link rel="stylesheet" href="/ServicioAutenticacionSesionesPHP/frontend/css/main.css">
</head>
<body>
    <div class="main-container">
        <!-- ENCABEZADO CON SALUDO -->
        <div class="page-header">
            <h1>
                <?php echo $saludo; ?>, <?php echo htmlspecialchars($nombre_usuario); ?>!
            </h1>
            <p><?php echo $dia_semana; ?>, <?php echo $fecha_actual; ?></p>
        </div>
        
        <div class="content-area">
            <!-- MENSAJE DE BIENVENIDA PERSONALIZADO -->
            <div class="welcome-message">
                <p><?php echo htmlspecialchars($mensaje_bienvenida); ?></p>
            </div>
            
            <!-- INFORMACIÓN DE LA SESIÓN -->
            <div class="info-card">
                <h3>Información de tu sesión</h3>
                
                <div class="info-item">
                    <span class="info-label">Usuario:</span>
                    <span class="info-value"><?php echo htmlspecialchars($nombre_usuario); ?></span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Hora actual:</span>
                    <span class="info-value"><?php echo $hora_actual; ?></span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Inicio de sesión:</span>
                    <span class="info-value"><?php echo $hora_login; ?></span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Fecha:</span>
                    <span class="info-value"><?php echo $fecha_actual; ?></span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Estado:</span>
                    <span class="info-value" style="color: var(--success-color); font-weight: bold;">
                        Autenticado 
                    </span>
                </div>
            </div>
            
            <!-- ACCIONES DISPONIBLES -->
            <div class="button-group">
                <a href="logout.php" class="btn btn-danger">
                    Cerrar Sesión
                </a>
                <a href="bienvenida.php" class="btn btn-secondary">
                    Actualizar Hora
                </a>
            </div>
        </div>
    </div>
</body>
</html>
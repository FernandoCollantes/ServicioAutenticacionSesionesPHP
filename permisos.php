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
    <!-- ENLACE AL CSS EXTERNO -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="center-container">
        <div class="error-box">
            <!-- ICONO DE ERROR -->
            <div class="icon-large animate-float"></div>
            
            <!-- TÍTULO PRINCIPAL -->
            <h2 style="color: var(--danger-color); margin-bottom: 15px;">
                Acceso Denegado
            </h2>
            
            <!-- SUBTÍTULO EXPLICATIVO -->
            <p class="text-muted mb-medium">
                No tienes permiso para acceder a esta página porque no has iniciado sesión.
            </p>
            
            <!-- CAJA DE INFORMACIÓN -->
            <div class="alert-warning">
                <strong>¿Por qué veo esta página?</strong>
                <ul style="text-align: left; margin: 10px 0; padding-left: 20px;">
                    <li>Intentaste acceder a una página protegida</li>
                    <li>Tu sesión no está activa o ha expirado</li>
                    <li>Necesitas autenticarte primero</li>
                </ul>
            </div>
            
            <!-- BOTÓN PARA IR AL LOGIN -->
            <a href="login.php" class="btn btn-primary" style="margin-top: 20px;">
                Ir al Login
            </a>
            
            <!-- INFORMACIÓN ADICIONAL -->
            <div class="divider"></div>
            <p class="text-muted">
                Si ya tienes una cuenta, inicia sesión para acceder al contenido protegido.
            </p>
        </div>
    </div>
</body>
</html>
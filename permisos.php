<?php
// PÁGINA DE ACCESO DENEGADO
session_start();

// Si el usuario YA está autenticado, redirigirlo a bienvenida
if (isset($_SESSION['usuario'])) {
    header("Location: bienvenida.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Denegado - Sistema de Autenticación</title>
    <link rel="stylesheet" href="/ServicioAutenticacionSesionesPHP/frontend/css/main.css">
</head>
<body>
    <!-- Contenedor principal centrado -->
    <div class="container">
        
        <!-- Card de error -->
        <div class="card card-error">
            
            <!-- Header del card -->
            <div class="card-header card-header-danger">
                <h2>Acceso Denegado</h2>
            </div>
            
            <!-- Body del card -->
            <div class="card-body text-center">

                <!-- Mensaje principal -->
                <p class="text-muted">
                    No tienes permiso para acceder a esta página porque no has iniciado sesión.
                </p>
                
                <!-- Alerta informativa -->
                <div class="alert alert-warning">
                    <strong>¿Por qué veo esta página?</strong>
                    <ul class="list">
                        <li>Intentaste acceder a una página protegida</li>
                        <li>Tu sesión no está activa o ha expirado</li>
                        <li>Necesitas autenticarte primero</li>
                    </ul>
                </div>
                
                <!-- Botón de acción -->
                <a href="login.php" class="btn btn-primary btn-block">
                    Ir al Login
                </a>
                
            </div>
            
            <!-- Footer del card -->
            <div class="card-footer">
                <p class="text-muted">
                    Si ya tienes una cuenta, inicia sesión para acceder al contenido protegido.
                </p>
            </div>
            
        </div>
        
    </div>
</body>
</html>
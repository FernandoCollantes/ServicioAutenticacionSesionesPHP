<?php
// SCRIPT DE CIERRE DE SESIÓN
// Este archivo se encarga de destruir la sesión completamente y redirigir al login

// PASO 1: Iniciar la sesión para poder destruirla
// Necesitamos session_start() para acceder a la sesión actual
session_start();

// PASO 2: Eliminar todas las variables de sesión
// Esto limpia el array $_SESSION, eliminando todos los datos almacenados
$_SESSION = array();

// PASO 3: Destruir la cookie de sesión si existe
// Las sesiones PHP usan cookies para identificar al usuario
// Debemos eliminar también la cookie del navegador
if (isset($_COOKIE[session_name()])) {
    // session_name() devuelve el nombre de la cookie de sesión (por defecto "PHPSESSID")
    // setcookie() con tiempo en el pasado elimina la cookie
    setcookie(
        session_name(),        // Nombre de la cookie
        '',                    // Valor vacío
        time() - 3600,        // Tiempo de expiración en el pasado (hace 1 hora)
        '/'                   // Ruta (disponible en todo el sitio)
    );
}

// PASO 4: Destruir la sesión en el servidor
// session_destroy() elimina todos los datos de sesión del servidor
session_destroy();

// PASO 5: Redirigir al login
// Después de cerrar sesión, enviamos al usuario de vuelta al login
header("Location: login.php");
exit();

/*
NOTA IMPORTANTE: Este archivo NO muestra ninguna página HTML
Solo ejecuta las acciones necesarias y redirige inmediatamente

FLUJO COMPLETO DEL CIERRE DE SESIÓN:
1. Usuario hace clic en "Cerrar sesión" desde bienvenida.php
2. Se ejecuta logout.php
3. Se eliminan todos los datos de sesión
4. Se destruye la cookie
5. Se destruye la sesión del servidor
6. Usuario es redirigido automáticamente al login
7. Si intenta volver a bienvenida.php, será enviado a permisos.php

¿POR QUÉ TODOS ESTOS PASOS?
- $_SESSION = array() → Limpia las variables de sesión
- setcookie() → Elimina la cookie del navegador (lado cliente)
- session_destroy() → Elimina los datos del servidor (lado servidor)

Hacer solo uno de estos pasos sería inseguro e incompleto.
*/
?>
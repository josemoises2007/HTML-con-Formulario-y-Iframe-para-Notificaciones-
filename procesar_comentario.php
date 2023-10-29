<?php
// Configuración de la base de datos MySQL
$servername = " localhost";
$username = "id20395560_jake";
$password = "Miraxus.4444";
$dbname = "id20395560_videos";

// Recopilar datos del formulario
$nombre = $_POST['nombre'] ?? '';
$es_anonimo = isset($_POST['anonimo']) ? 1 : 0;
$comentario = $_POST['comentario'] ?? '';

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Insertar los datos en la base de datos
$sql = "INSERT INTO comentarios (nombre, es_anonimo, comentario, fecha) VALUES (?, ?, ?, NOW())";

// Preparar y ejecutar la consulta con parámetros para prevenir inyección SQL
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("sis", $nombre, $es_anonimo, $comentario);
    $stmt->execute();
    $stmt->close();
    // Redireccionar a la página HTML en GitHub después de procesar el comentario
    header("Location: https://josemoises2007.github.io/HTML-con-Formulario-y-Iframe-para-Notificaciones-/");
    exit; // Terminar la ejecución del script después de la redirección
} else {
    echo "Error al preparar la consulta: " . $conn->error;
}

$conn->close();
?>

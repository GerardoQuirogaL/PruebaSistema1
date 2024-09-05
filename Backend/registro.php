<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qr_code = $_POST['qr_code'];

    // Buscar el vehículo por el código QR
    $stmt = $pdo->prepare("SELECT * FROM vehiculos WHERE qr_code = :qr_code AND fecha_salida IS NULL");
    $stmt->execute(['qr_code' => $qr_code]);
    $vehiculo = $stmt->fetch();

    if ($vehiculo) {
        // Registrar la salida
        $stmt = $pdo->prepare("UPDATE vehiculos SET fecha_salida = NOW() WHERE id = :id");
        $stmt->execute(['id' => $vehiculo['id']]);
        echo "Salida registrada para el vehículo con placa: " . $vehiculo['placa'];
    } else {
        // Registrar la entrada
        $stmt = $pdo->prepare("INSERT INTO vehiculos (placa, qr_code, fecha_entrada) VALUES (:placa, :qr_code, NOW())");
        $stmt->execute(['placa' => $_POST['placa'], 'qr_code' => $qr_code]);
        echo "Entrada registrada para el vehículo con placa: " . $_POST['placa'];
    }
}
?>

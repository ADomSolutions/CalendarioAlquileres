<?php
header("Content-Type: application/json"); // Asegurarse de enviar JSON
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservas";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
  die(json_encode(["success" => false, "message" => "Conexión fallida: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $data = json_decode(file_get_contents("php://input"), true);

  // Validar datos recibidos
  if (isset($data['nombre_propiedad'], $data['link'], $data['fecha_inicio'], $data['fecha_fin'], $data['color'])) {
    $nombre = $conn->real_escape_string($data['nombre_propiedad']);
    $link = $conn->real_escape_string($data['link']);
    $inicio = $conn->real_escape_string($data['fecha_inicio']);
    $fin = $conn->real_escape_string($data['fecha_fin']);
    $color = $conn->real_escape_string($data['color']);

    // Insertar datos en la base
    $sql = "INSERT INTO reservas (nombre_propiedad, link, fecha_inicio, fecha_fin, color) 
            VALUES ('$nombre', '$link', '$inicio', '$fin', '$color')";

    if ($conn->query($sql) === TRUE) {
      echo json_encode(["success" => true]);
    } else {
      echo json_encode(["success" => false, "message" => "Error al guardar: " . $conn->error]);
    }
  } else {
    echo json_encode(["success" => false, "message" => "Datos incompletos."]);
  }
  exit;
}

// Obtener reservas existentes
$result = $conn->query("SELECT * FROM reservas");
$reservas = [];
while ($row = $result->fetch_assoc()) {
  $reservas[] = $row;
}

echo json_encode($reservas);
$conn->close();
?>

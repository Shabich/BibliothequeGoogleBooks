<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tektok";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$title = isset($data['title']) ? $data['title'] : "";
$authors = isset($data['authors']) ? $data['authors'] : "";
$categories = isset($data['categories']) ? $data['categories'] : "";
$thumbnail = isset($data['thumbnail']) ? $data['thumbnail'] : "";
$description = isset($data['description']) ? $data['description'] : "";




$stmt = $conn->prepare("INSERT INTO books (title, authors, categories, thumbnail, description) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $title, $authors, $categories, $thumbnail, $description);

$response = [];


if ($stmt->execute() === TRUE) {
    $last_id = $conn->insert_id;  
    $response = array("status" => "valide", "message" => "Livre ajouté avec succès", "id" => $last_id);
} else {
    $response = array("status" => "error", "message" => "Erreur lors de l'ajout du livre: " . $stmt->error);
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>

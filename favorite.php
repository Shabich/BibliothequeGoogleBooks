<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tektok";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $title = isset($data['title']) ? $data['title'] : "";
    $authors = isset($data['authors']) ? $data['authors'] : "";
    $categories = isset($data['categories']) ? $data['categories'] : "";
    $thumbnail = isset($data['thumbnail']) ? $data['thumbnail'] : "";
    $description = isset($data['description']) ? $data['description'] : "";

    $stmt = $conn->prepare("INSERT INTO books (title, authors, categories, thumbnail, description, user_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $authors, $categories, $thumbnail, $description, $user_id);

    $response = [];

    if ($stmt->execute() === TRUE) {
        $last_id = $conn->insert_id;  
        $response = array("status" => "valide", "message" => "Livre ajouté avec succès", "id" => $last_id);
    } else {
        $response = array("status" => "error", "message" => "Erreur lors de l'ajout du livre: " . $stmt->error);
    }

    $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $bookId = isset($data['id']) ? $data['id'] : "";

    $stmt = $conn->prepare("DELETE FROM books WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ss", $bookId, $user_id);

    $response = [];

    if ($stmt->execute() === TRUE) {
        $response = array("status" => "valide", "message" => "Livre supprimé avec succès");
    } else {
        $response = array("status" => "error", "message" => "Erreur lors de la suppression du livre: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "bloggerhaven";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// API endpoint to add a new blog
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract values from form data
    $author = $_POST['Author'];
    $title = $_POST['Title'];
    $para1 = $_POST['Para1'];
    $para2 = $_POST['Para2'];
    $para3 = $_POST['Para3'];

    // If we directly put value => blogs might have appostrophe which might interfere with the sql command itself
    $sql = "INSERT INTO blogs (Author, Title, Para1, Para2, Para3) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $author, $title, $para1, $para2, $para3);
    if ($stmt->execute()) {
        http_response_code(200);
        echo json_encode(array('message' => 'New blog added successfully'));
    } else {
        http_response_code(500);
        echo json_encode(array('message' => 'Error adding blog: ' . $conn->error));
    }
    $stmt->close();
} else {
    http_response_code(405);
    echo json_encode(array('message' => 'Method Not Allowed'));
}
$conn->close();
?>

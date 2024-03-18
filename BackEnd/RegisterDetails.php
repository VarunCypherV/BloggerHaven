<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloggerhaven";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$Username = $_POST['Username'];
$Password = $_POST['Password'];

if(empty($Username) || empty($Password)) {
    $response = array("success" => false, "message" => "Username or password is empty.");
    echo json_encode($response);
    exit();
}

// Generate UserId (UI + random 4 digits)
// Initialize Liked as empty JSON
$Liked = json_encode(array());

$sql = "INSERT INTO users (Username, Password, Liked) VALUES ('$Username', '$Password', '$Liked')";

if ($conn->query($sql) === TRUE) {
    $response = array("success" => true, "message" => "Registration successful.");
    echo json_encode($response);
} else {
    $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
    echo json_encode($response);
}

$conn->close();
?>

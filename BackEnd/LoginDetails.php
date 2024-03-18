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

$sql = "SELECT * FROM users WHERE Username = '$Username' AND password = '$Password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $response = array("success" => true, "message" => "Login successful.");
    echo json_encode($response);
} else {
    $response = array("success" => false, "message" => "Invalid username or password.");
    echo json_encode($response);
}
$conn->close();
?>

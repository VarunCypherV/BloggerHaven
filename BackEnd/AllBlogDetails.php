<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bloggerhaven";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Blogs";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $blogs = array();
    while($row = $result->fetch_assoc()) {
        $blogs[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($blogs);
} else {
    echo "0 results";
}

$conn->close();

?>

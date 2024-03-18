<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bloggerhaven";

// Check if BlogId is provided in the URL
if(isset($_GET['BlogId'])) {
    $blogId = $_GET['BlogId'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement with parameterized query to prevent SQL injection
    $sql = "SELECT * FROM Blogs WHERE BlogId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $blogId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the details of the blog
        $blog = $result->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode($blog);
    } else {
        echo "0 results";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "BlogId parameter is missing.";
}
?>

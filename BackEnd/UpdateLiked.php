<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "bloggerhaven";

function addBlogIdToLiked($conn, $userId, $blogId) {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $updateQuery = "UPDATE users SET Liked = JSON_SET(Liked, '$.\"$blogId\"', NOW()) WHERE UserId = $userId";
    if ($conn->query($updateQuery) === TRUE) {
        return true;
    } else {
        return false;
    }
}

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['UserId']) && isset($_POST['BlogId'])) {
        $userId = $_POST['UserId'];
        $blogId = $_POST['BlogId'];

        if (addBlogIdToLiked($conn, $userId, $blogId)) {
            http_response_code(200);
            echo json_encode(array('message' => 'BlogId added to Liked for user ' . $userId));
        } else {
            http_response_code(500);
            echo json_encode(array('message' => 'Failed to add BlogId to Liked for user ' . $userId));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('message' => 'UserId and BlogId are required'));
    }
} else {
    http_response_code(405);
    echo json_encode(array('message' => 'Method Not Allowed'));
}

// Close the database connection
$conn->close();
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bloggerhaven";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$UserId = $_GET['UserId']; 
$query1 = "SELECT JSON_KEYS(Liked) AS BlogIds, JSON_EXTRACT(Liked, '$.*') AS TimeStamps FROM users WHERE UserId = $UserId";
$result1 = $conn->query($query1);

if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $blogIds = json_decode($row['BlogIds']);
        $timeStamps = json_decode($row['TimeStamps']);
        $firstBlogId = $blogIds[0];
        $secondBlogId = $blogIds[1];
        $query2_first = "SELECT * FROM blogs WHERE BlogId = $firstBlogId";
        $result2_first = $conn->query($query2_first);
        $firstBlogDetails = $result2_first->fetch_assoc();
        $query2_second = "SELECT * FROM blogs WHERE BlogId = $secondBlogId";
        $result2_second = $conn->query($query2_second);
        $secondBlogDetails = $result2_second->fetch_assoc();
        
        $response = array(
            'first' => $firstBlogDetails,
            'second' => $secondBlogDetails
        );
        $json_response = json_encode($response);
        echo $json_response;
    }
} else {
    echo "No results found";
}

$conn->close();

?>

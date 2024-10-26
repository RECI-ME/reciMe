// categories.php
<?php
include 'path/to/database_connection.php';

$sql = "SELECT DISTINCT category FROM Recipes";
$result = $conn->query($sql);

$categories = [];
while ($row = $result->fetch_assoc()) {
    $categories[] = $row['category'];
}

echo json_encode(['categories' => $categories]);
?>

// search.php
<?php
include "../../server/db.php"

$search_query = $_GET['query'];
$sql = "SELECT r.*, c.name AS chef_name, c.image AS chef_image 
        FROM Recipes r 
        JOIN Chefs c ON r.chef_id = c.id 
        WHERE r.name LIKE ? OR c.name LIKE ? OR r.category LIKE ?";

$stmt = $conn->prepare($sql);
$like_query = "%" . $search_query . "%";
$stmt->bind_param('sss', $like_query, $like_query, $like_query);
$stmt->execute();
$result = $stmt->get_result();

$recipes = [];
while ($row = $result->fetch_assoc()) {
    $recipes[] = $row;
}

echo json_encode(['recipes' => $recipes]);
?>

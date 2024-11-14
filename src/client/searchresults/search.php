// search.php
<?php
include "../../server/db.php"

if (isset($_GET['autocomplete']) && $_GET['autocomplete'] == 'true') {
    // Handle autocomplete request
    $term = $_GET['query'] . '%'; // Filter by the beginning of the input term
    $sql = "SELECT DISTINCT r.name AS recipe_name 
            FROM Recipes r 
            WHERE r.name LIKE ? 
            UNION 
            SELECT DISTINCT c.name AS chef_name 
            FROM Chefs c 
            WHERE c.name LIKE ?";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $term, $term);
    $stmt->execute();
    $result = $stmt->get_result();

    $suggestions = [];
    while ($row = $result->fetch_assoc()) {
        // Add recipe or chef names to suggestions
        $suggestions[] = $row['recipe_name'] ?? $row['chef_name'];
    }

    echo json_encode($suggestions);
} else {
    // Regular search query
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
}

$stmt->close();
$conn->close();
?>

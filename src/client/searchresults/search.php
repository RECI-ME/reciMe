// search.php
<?php
include "../../server/db.php"

if (isset($_GET['autocomplete']) && $_GET['autocomplete'] == 'true') {

    $term = $_GET['query'] . '%'; 
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

    echo json_encode($suggestions);  // Return suggestions in JSON format
} else {
    // Regular search query logic here, if needed
}

$stmt->close();
$conn->close();
?>

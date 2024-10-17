<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['recipe_id'])) {
    $recipe_id = $_POST['recipe_id'];
    $query = $db->prepare('DELETE FROM Recipes WHERE recipe_id = ?');
    $result = $query->execute([$recipe_id]);
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>

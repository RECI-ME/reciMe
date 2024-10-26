<?php

$host = '';
$dbname = ''; 
$username = ''; 
$password = ''; 

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_POST['userId'];
$recipe_id = $_POST['recipeId'];

$check_query = "SELECT * FROM Favorites WHERE user_id = ? AND recipe_id = ?";
$stmt = $conn->prepare($check_query);
$stmt->bind_param("ii", $user_id, $recipe_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $delete_query = "DELETE FROM Favorites WHERE user_id = ? AND recipe_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("ii", $user_id, $recipe_id);
    if ($stmt->execute()) {
        echo json_encode(["message" => "Recipe unliked"]);
    } else {
        echo json_encode(["message" => "Error unliking the recipe"]);
    }
} else {
    $insert_query = "INSERT INTO Favorites (user_id, recipe_id) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ii", $user_id, $recipe_id);
    if ($stmt->execute()) {
        echo json_encode(["message" => "Recipe liked"]);
    } else {
        echo json_encode(["message" => "Error liking the recipe"]);
    }
}

$stmt->close();
$conn->close();
?>

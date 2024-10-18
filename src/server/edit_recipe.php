<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "server accepts only post requests for new recipes";
}

$env = parse_ini_file("../../env.ini");
if ($env == FALSE) {
    echo "server could not parse env file";
}

$conn = new mysqli(
    $env["DB_SERVER"],
    $env["DB_USERNAME"],
    $env["DB_PASSWORD"],
    $env["DB"]
);

if ($conn->connect_error) {
    echo "couldn't connect to sql server";
}

$recipe_id = -1;

$query_result = $conn->query("SELECT recipe_id FROM Recipes WHERE "
    . "Recipes.name = '" . $_POST["recipe"] . "' "
    . "AND Recipes.user_id = " . $_POST["user_id"]
);

if ($query_result == FALSE || $query_result->num_rows == 0) {
    echo "couln't locate the correct recipe";
}

while($row = $query_result->fetch_assoc()) {
    $recipe_id = $row["recipe_id"];
    break;
}

$query_result = $conn->query("UPDATE Recipes SET name = '" . ($_POST["name"]) . "' "
    . "WHERE Recipes.recipe_id = " . recipe_id;
);

if ($query_result == FALSE) {
    echo "failed to update recipe";
}

$query_result = $conn->query("SELECT category_id FROM Categories WHERE Categories.name = '" . $_POST["category"] . "'");
if ($query_result->num_rows == 0) {
    echo "no such category exists: " . $_POST["category"];
}

$category_id = -1;

while ($row = $query_result->fetch_assoc()) {
    $category_id = $row["category_id"];
    break;
}

if ($category_id == -1) {
    echo "no such category exists!";
}

$query_result = $conn->query("UPDATE Recipes SET category = " . $category_id . " "
    . "WHERE Recipes.recipe_id = " . recipe_id;
);

if ($query_result == FALSE) {
    echo "failed to update recipe";
}

echo "recipe posted! <a href='http://localhost'>Go Back</a>";

?>

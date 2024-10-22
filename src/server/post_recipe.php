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


$query_result = $conn->query("INSERT INTO Recipes(name, category, trending, user_id) VALUES("
    . "'" . $_POST["name"] . "', "
    . $category_id . ", "
    . "NULL, "
    . $_POST["user_id"] . ")"
);

if ($query_result == FALSE) {
    echo "failed to insert recipe";
}

echo "recipe posted! <a href='http://localhost'>Go Back</a>";

?>

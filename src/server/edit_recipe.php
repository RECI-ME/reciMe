<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "server accepts only post requests for new recipes";
    header("Location: ../server/error.php?error=" . urlencode("invalid_request"));
}

$env = parse_ini_file("../../env.ini");
if ($env == FALSE) {
    echo "server could not parse env file";
    header("Location: ../server/error.php?error=" . urlencode("internal_server_err"));
}

$conn = new mysqli(
    $env["DB_SERVER"],
    $env["DB_USERNAME"],
    $env["DB_PASSWORD"],
    $env["DB"]
);

if ($conn->connect_error) {
    echo "couldn't connect to sql server";
    header("Location: ../server/error.php?error=" . urlencode("internal_server_err"));
}

$update_image = "";
$image_size = getimagesize($_FILE["image"]["name"]);
if ($image_size > 0) {
    $image_dir = "../../user_images/" . $_POST["user_id"] . "/" . $_POST["recipe_id"] . "/";
    $file_name = basename($_FILE["image"]["name"]);

    $upload_status = move_uploaded_file($_FILE["image"]["name"], $image_dir . $file_name);
    if (!$upload_status) {
        echo "failed to upload image";
        header("Location: ../server/error.php?error=" . urlencode("internal_server_err"));
    }

    $update_image = "image = '" . $image_dir . $file_name . "', ";
}


$query_result = $conn->query("UPDATE Recipes 
    SET name = '" . $_POST["name"] . "', "
    . $update_image
    . "description = '" . $_POST["description"] . "', "
    . "category = " . $_POST["category"]
    . " WHERE Recipes.recipe_id = " . $_POST["recipe_id"];
);

if ($query_result == FALSE) {
    echo "failed to update recipe";
    header("Location: ../server/error.php?error=" . urlencode("internal_server_err"));
}

echo "recipe posted! <a href='http://localhost'>Go Back</a>";

?>

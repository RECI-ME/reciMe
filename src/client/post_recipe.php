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

$image_dir = "../../user_images/$user_id/" . $_POST["name"] . "/";
$file_name = basename($_FILES["image"]["name"]);

$upload_err = move_uploaded_file($_FILES["image"]["name"], $image_dir . $file_name);
if (!$upload_err) {
    echo "failed to upload file!";
}


$query_result = $conn->query("INSERT INTO Recipes(name, image, description, category, trending, user_id) VALUES("
    . "'" . $_POST["name"] . "', "
    . "'$file_name', " 
    . "'" . $_POST["description"] . ", "
    . $_POST["category"] . ", "
    . "NULL, "
    . $_POST["user_id"] . ")"
);

if ($query_result == FALSE) {
    echo "failed to insert recipe";
}

echo "recipe posted! <a href='http://localhost'>Go Back</a>";

?>

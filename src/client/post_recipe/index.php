<!DOCTYPE html>
<html>
    <head>
        <title>ReciMe | Post Recipe</title>
        <link rel="icon" type="image/png" href="../../../assets/recimelogo.png">

        <link rel="stylesheet" href="../global.css">
        <link rel="stylesheet" href="./index.css">
    </head>

    <body>
        <a href="../home/index.html">Back To Homepage</a>
        <a href="../edit_recipe/index.php">Edit Recipes</a>

        <div id="center_form">
            <form action="../../server/post_recipe.php" method="post">
                <input type="hidden" name="user_id" value="1" />

                <label for="name">Recipe Name</label>
                <input name="name" type="text" />

                <label for="category">Category</label>
                <select name="category" > 
                    <?php
                        $env = parse_ini_file("../../../env.ini");

                        if ($env == false) {
                            echo "server conn error!";
                        }

                        $conn = new mysqli(
                            $env["DB_SERVER"], 
                            $env["DB_USERNAME"], 
                            $env["DB_PASSWORD"],
                            $env["DB"]
                        );

                        if ($conn->connect_error) {
                            echo "server conn error!";
                        }

                        $categories_result = $conn->query("SELECT name FROM Categories");

                        if ($categories_result->num_rows == 0) {
                            echo "couldn't get categories from server!";
                        }

                        while ($row = $categories_result->fetch_assoc()) {
                            echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
                        }


                        $conn->close();
                    ?>
                </select>
                
                <button type="submit">Post</button>
            </form>
        </div>
    </body>
</html>

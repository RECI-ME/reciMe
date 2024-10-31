<?php
session_start();
$errorMessage = isset($_SESSION['error']) ? $_SESSION['error'] : "An unexpected error occurred.";
unset($_SESSION['error']); // Clear error after displaying
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../client/global.css"> <!-- Global CSS for consistent styling -->
    <link rel="stylesheet" href="../../client/searchresult/search_result.css"> <!-- Adjust path as necessary -->
    <title>Error Page</title>
    <style>
        /* Additional styles for error page */
        #error-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 90vh; /* Adjust as necessary */
            padding: 20px;
            background: var(--secondary);
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            color: var(--background);
        }

        #error-title {
            font-size: 2em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #error-message {
            font-size: 1.2em;
            text-align: center;
            margin-bottom: 20px;
        }

        #back-home {
            background-color: var(--primary);
            color: var(--secondary);
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
            text-decoration: none; /* Remove underline from link */
        }

        #back-home:hover {
            background-color: var(--accent);
        }
    </style>
</head>
<body>
    <header>
        <div class="banner">
            <div class="cursor" id="profile">
                <img src="../../../assets/default_avatar_cream.png" alt="User Icon" width="30px" />
            </div>
            <div class="logo-container">
                <a href="../../../index.html">
                    <img src="../../../assets/logo_horizontal.png" alt="ReciMe Logo" class="logo" />
                </a>
            </div>
        </div>
    </header>

    <main id="error-container">
        <div id="error-title">Oops! Something went wrong.</div>
        <div id="error-message">
            <?php echo htmlspecialchars($errorMessage); ?>
        </div>
        <a id="back-home" href="../../../index.html">Go Back Home</a>
    </main>

    <script>
        // You can add any additional JavaScript functionality here if needed
    </script>
</body>
</html>

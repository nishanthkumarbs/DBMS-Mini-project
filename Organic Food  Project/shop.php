<?php
session_start();

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basicecomm";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Function to add items to the cart
function addToCart($conn, $product_id, $product_quantity) {
    // Assuming you have a user ID in the session
    $username = isset($_SESSION["user"]["name"]) ? $_SESSION["user"]["name"] : null;

    echo "Username from session: " . $username;


    $stmt = $conn->prepare("INSERT INTO cart (username, product_id, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $username, $product_id, $product_quantity);

    if ($stmt->execute()) {
        return true;
    } else {
        // Print specific error details for debugging
        echo "Error: " . $stmt->error;
        return false;
    }
}

if (isset($_POST["add_to_cart"])) {
    // Get the product ID from the form
    $product_id = $_POST["product_id"];

    // Get the product quantity from the form
    $product_quantity = $_POST["product_quantity"];

    // Add the product and quantity to the cart session
    $_SESSION["cart"][$product_id] = $product_quantity;

    // Add the product to the cart database
    $success = addToCart($conn, $product_id, $product_quantity);

    if ($success) {
        // Redirect to cart.php
        header("location: cart.php");
        exit();
    } else {
        echo "Error adding item to cart.";
    }
}


// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organic Food Shopping Web Application</title>
    <link rel="stylesheet" href="shop.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        nav {
            background-color: #444;
            overflow: hidden;
        }

        nav a {
            float: left;
            display: block;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: #333;
        }

        main {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        li {
            width: 30%;
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            background-color: #fff;
            transition: transform 0.3s ease-in-out;
        }

        li:hover {
            transform: scale(1.05);
        }

        img {
            width: 100%;
            height: auto;
            border: 1px solid #ddd;
        }

        form {
            margin-top: 10px;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome <?php
                    $user = $_SESSION["user"];
                    echo $user["name"];
                    ?> to Organic Food Shopping Web Application</h1>
    </header>
    <nav>
        <a href="shop.php">Home</a>
        <a href="#">About</a>
        <a href="cart.php">Cart</a>
        <a href="logout.php">Logout</a>
    </nav>
    <main>
    <h2>Products</h2>
        <ul>
            <?php
            // Display products fetched from the database
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<img src='admin/" . $row['img'] . "' alt='Product Image' width='300' >"; 
                echo "<p>" . $row['info'] . "</p>";
                echo "<p><span>&#8377 " . $row['price'] . "</span></p>";
                echo "<form method='post' action='shop.php'>";
                echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
                echo "<label for='product" . $row['id'] . "_quantity'>Quantity:</label>";
                echo "<input type='number' id='product" . $row['id'] . "_quantity' name='product_quantity' value='1' min='1' max='10'><br><br>";
                echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
                echo "</form>";
                echo "</li>";
            }
        ?>
        </ul>
    </main>
    <footer>
        <p>&copy; Organic Food Shopping Web Application</p>
    </footer>
    <script src="shop.php"></script>
</body>

</html>

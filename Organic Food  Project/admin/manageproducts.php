<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" type="text/css" href="manageproducts.css">
</head>

<style>
    body {
        background-color: #ffffff;
        font-family: Arial, sans-serif;
    }

    header {
        background-color: green;
        color: #ffffff;
        padding: 20px;
    }

    nav ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    nav li {
        display: inline-block;
        margin-right: 20px;
    }

    nav a {
        color: #ffffff;
        text-decoration: none;
    }

    nav a:hover {
        text-decoration: underline;
    }

    section {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        display: flex; /* Use flexbox to create a row layout */
        flex-wrap: wrap; /* Allow items to wrap to the next line if there's not enough space */
        justify-content: space-between; /* Distribute items evenly along the row */
    }

    h1 {
        color: green;
        font-size: 32px;
        margin-bottom: 20px;
    }

    h2 {
        color: green;
        font-size: 24px;
        margin-bottom: 10px;
    }

    .product-container {
        width: calc(33.33% - 20px); /* Set the width of each product container (adjust as needed) */
        margin-bottom: 20px;
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #666666;
    }

    .delete-btn {
        background-color: red;
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .delete-btn:hover {
        background-color: #B22222;
    }
    #a{
        text-align:center;
    }

    footer {
        background-color: green;
        color: #ffffff;
        padding: 20px;
        text-align: center;
    }
</style>

<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="dashboard.php">Admin Dashboard</a>
                </li>
                <li>
                    <a href="addshop.php">Add Product</a>
                </li>
                <li>
                    <a href="manageproducts.php" class="active">Manage Products</a>
                </li>
                <li><a href="logout.php">Logout</a></li>

            </ul>
        </nav>
    </header>
    <h1 id='a'>Manage Products</h1>

    <section>

        <?php
        // Fetch and display products from the database for management
        $conn = mysqli_connect("localhost", "root", "", "basicecomm");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $result = mysqli_query($conn, "SELECT * FROM products");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product-container'>";
                echo "<h2>" . $row['name'] . "</h2>";
                echo "<p>" . $row['info'] . "</p>";
                echo "<p>Price: &#8377 " . $row['price'] . "</p>";
                echo "<img src='" . $row['img'] . "' alt='Product Image' width='200' height='150'>"; ?>
                <br><?php

                        // Add a Delete button with a confirmation prompt
                        echo "<form action='delete_product.php' method='post' style='display:inline-block;'>";
                        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
                        echo "<br><button type='submit' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</button>";
                        echo "</form>";

                        echo "</div>";
                    }
                } else {
                    echo "No products available.";
                }

                mysqli_close($conn);
                    ?>
    </section>

    <footer>
        <p>&copy; Organic Food Shopping Web Application</p>
    </footer>
</body>

</html>

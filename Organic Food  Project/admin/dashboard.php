<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="dashboard.css">
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
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
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
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .product {
        max-width: 200px;
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #666666;
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
                    <a href="dashboard.php" class="active">Dashboard</a>
                </li>
                <li>
                    <a href="addshop.php">Add Product</a>
                </li>
                <li>
                    <a href="manageproducts.php">Manage Products</a>
                </li>
                <li>
                    <a href="vieworders.php">View Orders</a>
                </li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <h1 id='a'>Dashboard</h1>

        <div class="product-container">
            <?php
            // Fetch and display products from the database for the dashboard
            $conn = mysqli_connect("localhost", "root", "", "basicecomm");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $result = mysqli_query($conn, "SELECT * FROM products");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='product'>";
                    echo "<h2>" . $row['name'] . "</h2>";
                    echo "<p>" . $row['info'] . "</p>";
                    echo "<p>Price: &#8377 " . $row['price'] . "</p>";
                    echo "<img src='" . $row['img'] . "' alt='Product Image' width='200' height='150'>";
                    echo "</div>";
                }
            } else {
                echo "No products available.";
            }

            mysqli_close($conn);
            ?>
        </div>
    </section>

    <footer>
        <p>&copy; Organic Food Shopping Web Application</p>
    </footer>
</body>

</html>

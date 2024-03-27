<?php
// Fetch and display orders with product names from the database
$conn = mysqli_connect("localhost", "root", "", "basicecomm");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT o.id, o.product_id, o.quantity, o.username, p.name
                                FROM cart o
                                JOIN products p ON o.product_id = p.id");

// Check for query execution success
if ($result === false) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
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

    footer {
        background-color: green;
        color: #ffffff;
        padding: 20px;
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: green;
        color: white;
    }
    #a{
        text-align:center;
    }
</style>

<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="dashboard.php">Dashboard</a>
                </li>
                <li>
                    <a href="addshop.php">Add Product</a>
                </li>
                <li>
                    <a href="manageproducts.php">Manage Products</a>
                </li>
                <li>
                    <a href="vieworders.php" class="active">View Orders</a>
                </li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <h1 id='a'>View Orders</h1>

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['quantity'] . "Kgs</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        // Add other columns if needed
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No orders available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <footer>
        <p>&copy; Organic Food Shopping Web Application</p>
    </footer>
</body>

</html>

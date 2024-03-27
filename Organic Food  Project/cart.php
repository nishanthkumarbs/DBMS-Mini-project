<!DOCTYPE html>
<html>

<head>
    <title>Shopping Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="your-styles.css">

    <style>
        body {
            /* background-color: green; */
            margin: 0;
            font-family: Arial, sans-serif;
        }

        header,
        
        main,
        footer {
            background-color: white;
            padding: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #dddddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        footer {
            background-color: green;
            color: black;
            text-align: center;
            color: white;
            /* max-width: 264px;
            margin-top: 20px;
            padding: 10px; */
        }
		 ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            background-color: green;
             
        }
        a{
            color: white;
            
        }


        li:hover {
            transform: scale(1.05);
            
        }
        #a{
        text-align:center;
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


        @media (max-width: 600px) {
            /* Adjust styles for small screens */
            table {
                font-size: 14px;
            }

            th,
            td {
                padding: 6px;
            }

            footer {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1 id='a'><?php session_start();
            $user = $_SESSION['user'];
            echo $user['name']; ?> Organic Food Shopping Cart</h1>
    </header>

    <nav>
        <ul>
            <li>
                <a href="shop.php">Home</a>
            </li>
            <li>
                <a href="cart.php">Products</a>
            </li>
            <li>
                <a href="#">Contact Us</a>
            </li>
            <li>
                <a href="cart.php">Cart</a>
            </li>
        </ul>
    </nav>

    <main>
    <section>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "basicecomm";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $total = 0;

            // Fetch cart items from the database
            $user_id = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : null;
            $sql = "SELECT cart.*, products.name, products.price FROM cart INNER JOIN products ON cart.product_id = products.id WHERE cart.username = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                // Check for query preparation error
                echo "Error preparing query: " . $conn->error;
            } else {
                // Bind the parameter
                $stmt->bind_param("s", $user_id);
            
                // Execute the statement
                $stmt->execute();
            
                // Get the result set
                $result = $stmt->get_result();
            
                if ($result === false) {
                    // Check for query execution error
                    echo "Error executing query: " . $stmt->error;
                } 
                elseif  ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $name = $row['name'];
                    $quantity = $row['quantity'];
                    $price = $row['price'];
                    $item_total = $quantity * $price;
                    $total += $item_total;

                    echo "<tr>";
                    echo "<td>$name</td>";
                    echo "<td>$quantity</td>";
                    echo "<td> &#8377 $price </td>";
                    echo "<td> &#8377 $item_total </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Your cart is empty</td></tr>";
            }
            $stmt->close();
        }

            echo "<tr>";
            echo "<td colspan='3'>Total:</td>";
            echo "<td> &#8377 $total </td>";
            echo "</tr>";
            ?>
        </table>
        <form action="checkout.php" method="post">
            <input type="submit" value="Checkout" style="background-color:green;color:white;" />
        </form>
    </section>
</main>

    <footer>
        <p>&COPY; Organic Food Shopping Web Application</p>
    </footer>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "basicecomm");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $productName = htmlspecialchars($_POST['productName']);
    $productDescription = htmlspecialchars($_POST['productDescription']);
    $productPrice = floatval($_POST['productPrice']);
    $productImage = $_FILES['productImage'];

    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($productImage['name']);

    if (move_uploaded_file($productImage['tmp_name'], $uploadFile)) {
        $sql = "INSERT INTO products (name, price, img, info) VALUES ('$productName', '$productPrice', '$uploadFile', '$productDescription')";
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            header('Location: dashboard.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo 'File upload failed.';
    }

    mysqli_close($conn);
}
?>

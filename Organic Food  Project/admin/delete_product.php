<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    $conn = mysqli_connect("localhost", "root", "", "basicecomm");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Perform the deletion
    $deleteQuery = "DELETE FROM products WHERE id = $productId";
    
    if (mysqli_query($conn, $deleteQuery)) {
        // Deletion successful
        echo "Product successfully deleted.";

        // Redirect to the manageproducts.php page or any other page
        header('Location: manageproducts.php');
        exit();
    } else {
        // Deletion failed
        echo "Error deleting product: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>

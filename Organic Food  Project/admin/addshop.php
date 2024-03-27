<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="addproduct.css">
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
		max-width: 600px; 
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
	
	label { 
		display: block; 
		margin-bottom: 5px; 
		color: #666666; 
	} 
	
	input[type="text"], 
	input[type="email"] { 
		width: 100%; 
		padding: 10px; 
		border: 1px solid #cccccc; 
		border-radius: 5px; 
		margin-bottom: 10px; 
		font-size: 16px; 
	} 
	
	input[type="submit"] { 
		background-color: green; 
		color: #ffffff; 
		padding: 10px 20px; 
		border: none; 
		border-radius: 5px; 
		font-size: 16px; 
		cursor: pointer; 
	} 
	
	input[type="submit"]:hover { 
		background-color: #228B22; 
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

             
				<li><a href="dashboard.php">Home</a></li> 
				<li><a href="addshop.php" class="active">Add Product</a></li> 
                <li>
                <a href="manageproducts.php" >Manage Products</a>
            </li>
				<li><a href="logout.php">Logout</a></li> 

			</ul> 
        </nav>

    </header>

    <section>
        <h1 id='a'>Add Product</h1>
        <form action="process_add_product.php" method="post" enctype="multipart/form-data">
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="productName" required>

            <label for="productDescription">Product Description:</label>
            <textarea id="productDescription" name="productDescription" rows="4" required></textarea>

            <label for="productPrice">Product Price:</label>
            <input type="text" id="productPrice" name="productPrice" required>

            <label for="productImage">Product Image:</label>
            <input type="file" id="productImage" name="productImage" accept="image/*" required>

            <input type="submit" value="Add Product">
        </form>
    </section>

    <footer>
        <p>&copy; Organic Food Shopping Web Application</p>
    </footer>
</body>

</html>

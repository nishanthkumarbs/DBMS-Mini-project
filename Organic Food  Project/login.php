<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
	$username = $_POST["username"]; 
	$password = $_POST["password"]; 

	// Connect to the database 
	$host = "localhost"; 
	$dbname = "basicecomm"; 
	$username_db = "root"; 
	$password_db = ""; 

	try { 
		$db = new PDO( 
			"mysql:host=$host;dbname=$dbname", 
			$username_db, 
			$password_db
		); 
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

		// Check if the user exists in the database 
		$stmt = $db->prepare("SELECT * FROM users WHERE name = :username"); 
		$stmt->bindParam(":username", $username); 
		$stmt->execute(); 
		$user = $stmt->fetch(PDO::FETCH_ASSOC); 

		if ($user) { 
			// Verify the password 
			if (password_verify($password, $user["password"])) { 
				session_start(); 
				$_SESSION["user"] = [
					"name" => $username, // Use the correct variable $username
					// ... other user information
				];
				echo '<script type="text/javascript"> 
	window.onload = function () { 
		alert("Welcome to Organic Food shopping website"); 
		window.location.href = "shop.php"; 
	}; 
</script> 
'; 
$_SESSION["user"] = [
    "name" => $username,
    // ... other user information
];
			} else { 
				echo "<h2>Login Failed</h2>"; 
				echo "Invalid email or password."; 
			} 
		} else { 
			echo "<h2>Login Failed</h2>"; 
			echo "User doesn't exist"; 
		} 
	} catch (PDOException $e) { 
		echo "Connection failed: " . $e->getMessage(); 
	} 
} 
?>

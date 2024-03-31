<?php
// Check if the ID parameter is not set or empty
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect the user back to the AdminPanel.php page with an error message
    header("Location: AdminPanel.php?error=missing_id");
    exit();
}

require_once 'Connection.php';

// Fetch the link details from the database
$sql = "SELECT * FROM links WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$result = $stmt->get_result();

// Check if a record was found
if ($result->num_rows === 0) {
    // Redirect the user back to the AdminPanel.php page with an error message
    header("Location: AdminPanel.php?error=invalid_id");
    exit();
}

$link = $result->fetch_assoc();

$sql = "SELECT * FROM links";
$result = $conn->query($sql);

if(isset($_SESSION['AdminLoginId'])) {
    header("location: home.php");
    exit(); // Stop further execution
}

// Logout functionality
if(isset($_POST['Logout'])) {
    session_destroy();
    header("location: home.php");
    exit(); // Stop further execution
}
?>
<!DOCTYPE html> 
<html lang="en"> 

<head> 
	<meta charset="UTF-8"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- Add custom CSS -->
	<link rel="stylesheet" href="mycss.css"> 
	<link rel="stylesheet" href="responsive.css"> 
	<title>ADMIN-HUSSEIN</title> 
</head> 

<body> 
	
	<!-- for header part -->
	<header> 
		<div class="logosec"> 
			<div class="logo">ADMIN-HUSSEIN</div> 
			<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png"
				class="icn menuicn"
				id="menuicn"
				alt="menu-icon"> 
		</div> 
		<div class="searchbar"> 
			<input type="text" placeholder="Search"> 
			<div class="searchbtn"> 
				<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
					class="icn srchicn"
					alt="search-icon"> 
			</div> 
		</div> 
		<div class="message"> 
			<div class="circle"></div> 
			<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png"
				class="icn"
				alt=""> 
			<div class="dp"> 
				<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png"
					class="dpicn"
					alt="dp"> 
			</div> 
		</div> 
	</header> 

	<div class="main-container"> 
		<div class="navcontainer"> 
			<nav class="nav"> 
				<div class="nav-upper-options"> 
					<div class="nav-option option1"> 
						<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182148/Untitled-design-(29).png"
							class="nav-img"
							alt="dashboard"> 
                            <a href="AdminPanel.php" style="color: white;"><h3>Dashboard</h3></a>
					</div> 
					<div class="option2 nav-option"> 
						<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/9.png"
							class="nav-img"
							alt="articles"> 
					  <a href="create.php" style="color: black;"><h3>Add Link</h3></a> 
					</div> 
					<div class="nav-option option3"> 
						<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/5.png"
							class="nav-img"
							alt="report"> 
							<h3>Article</h3>
					</div> 
					<div class="nav-option option4"> 
						<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/6.png"
							class="nav-img"
							alt="institution"> 
                            <a href="index.php" style="color: black;"><h3>links</h3></a> 
					</div> 
					<div class="nav-option option5"> 
						<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183323/10.png"
							class="nav-img"
							alt="blog"> 
						<h3> Profile</h3> 
					</div> 
					<div class="nav-option option6"> 
						<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/4.png"
							class="nav-img"
							alt="settings"> 
						<h3> Settings</h3> 
					</div> 
					<div class="nav-option logout">
						<form method="POST">
							<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/7.png" class="nav-img" alt="logout">
					
							<a href="logout.php" style="text-decoration: none; color: #212529;">
    <button type="submit" name="Logout" style="background: none;color: #212529; border: none; cursor: pointer;font-size:26px;">
        Logout
    </button>
</a>
						</form>

					</div>
				</div> 
			</nav> 
		</div> 


    <div class="container mt-5">
        <h1>Edit Link</h1>
        <form method="post" action="update_link.php">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($link['id']); ?>">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($link['title']); ?>">
    </div>
    <div class="form-group">
        <label for="url">URL:</label>
        <input type="text" id="url" name="url" class="form-control" value="<?php echo htmlspecialchars($link['url']); ?>">
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" class="form-control"><?php echo htmlspecialchars($link['description']); ?></textarea>
    </div>
    <button type="submit" name="update">Update</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <script src="./script.js"></script>
</body>
</html> 

<?php
session_start();
require_once 'Connection.php';

if(isset($_SESSION['Id'])) {
    header("location: AdminLogin.php");
    exit(); // Stop further execution
}

// Logout functionality
if(isset($_POST['Logout'])) {
    session_destroy();
    header("location: home.php");
    exit(); // Stop further execution
}

// Only proceed with database operations if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $url = $_POST['url'];
    $description = $_POST['description'];

    $sql = "INSERT INTO links (title, url, description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $url, $description);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit(); // Stop further execution after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $stmt->close();
}

// Retrieve data from the database
$sql = "SELECT * FROM links";
$result = $conn->query($sql);

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
					
							<a href="home.php" style="text-decoration: none; color: #212529;">
    <button type="submit" name="Logout" style="background: none;color: #212529; border: none; cursor: pointer;font-size:26px;">
        Logout
    </button>
</a>


					</div>
				</div> 
			</nav> 
		</div> 

		 
			<div class="searchbar2"> 
				<input type="text" name="" id="" placeholder="Search"> 
				<div class="searchbtn"> 
					<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
						class="icn srchicn"
						alt="search-button"> 
				</div> 
			</div> 
			<div class="container mt-5">
    <div class="row">
      <div class="col-md-3">
        <div class="box box1">
          <div class="text">
            <h2 class="topic-heading">60.5k</h2>
            <h2 class="topic">Article Views</h2>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="box box2">
          <div class="text">
            <h2 class="topic-heading">150</h2>
            <h2 class="topic">Likes</h2>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="box box3">
          <div class="text">
            <h2 class="topic-heading">320</h2>
            <h2 class="topic">Comments</h2>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="box box4">
          <div class="text">
            <h2 class="topic-heading">70</h2>
            <h2 class="topic">Published</h2>
          </div>
        </div>
      </div>
    </div>
  </div>




        



    <!-- Your JavaScript import here -->
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <script src="./script.js"></script>
</body> 
</html>

<?php
session_start();
require_once 'Connection.php';

if(isset($_SESSION['AdminLoginId'])) {
    header("location: AdminLogin.php");
    exit(); // Stop further execution
}

// Logout functionality
if(isset($_POST['Logout'])) {
    session_destroy();
    header("location: AdminLogin.php");
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

// Close the database connection after retrieving data
$conn->close();
?>

<!DOCTYPE html> 
<html lang="en"> 

<head> 
	<meta charset="UTF-8"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<!-- Add Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
						<h3> Dashboard</h3> 
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
						<h3> Report</h3> 
					</div> 
					<div class="nav-option option4"> 
						<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/6.png"
							class="nav-img"
							alt="institution"> 
						<h3> Institution</h3> 
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
							<button type="submit" name="Logout">Logout</button>
						</form>

					</div>
				</div> 
			</nav> 
		</div> 

		<div class="main"> 
			<div class="searchbar2"> 
				<input type="text" name="" id="" placeholder="Search"> 
				<div class="searchbtn"> 
					<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
						class="icn srchicn"
						alt="search-button"> 
				</div> 
			</div> 
			<div class="box-container"> 
				<div class="box box1"> 
					<div class="text"> 
						<h2 class="topic-heading">60.5k</h2> 
						<h2 class="topic">Article Views</h2> 
					</div> 
					
				</div> 
				<div class="box box2"> 
					<div class="text"> 
						<h2 class="topic-heading">150</h2> 
						<h2 class="topic">Likes</h2> 
					</div> 
				</div> 
				<div class="box box3"> 
					<div class="text"> 
						<h2 class="topic-heading">320</h2> 
						<h2 class="topic">Comments</h2> 
					</div> 
				</div> 
				<div class="box box4"> 
					<div class="text"> 
						<h2 class="topic-heading">70</h2> 
						<h2 class="topic">Published</h2> 
					</div> 
				</div> 
			</div> 
           
            


    <div class="container mt-5">
        <h1 class="text-center"></h1>
       

		<?php if ($result && $result->num_rows > 0): ?>
            <table class='table'>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Description</th>
                    <th>Created At</th>
                </tr>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><a href="<?php echo $row["url"]; ?>"><?php echo $row["title"]; ?></a></td>
                        <td><?php echo $row["url"]; ?></td>
                        <td><?php echo $row["description"]; ?></td>
                        <td><?php echo $row["created_at"]; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>0 results</p>
        <?php endif; ?>
    </div>
    <!-- Your JavaScript import here -->
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</body> 
</html>

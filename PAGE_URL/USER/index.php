<?php
require_once 'Connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM links ORDER BY created_at DESC"; // Fetch entries in descending order of creation time
$result = $conn->query($sql);


if(isset($_SESSION['AdminLoginId'])) {
    header("location: AdminLogin.php");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-5DlycP2UU7Jf+T5HRvq4nQyKnLRQIi3JfHyoXlN/B5q+CLHeX/2m3ppFOr3SW5Ff" crossorigin="anonymous">

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
    <input type="text" id="searchInput" placeholder="Search" onkeyup="searchTable()"> 
    <div class="searchbtn"> 
        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
            class="icn srchicn"
            alt="search-icon"> 
    </div> 
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
                            <a href="index.php" style="color: black;"><h3>Links</h3></a>  
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
   
    <?php if ($result && $result->num_rows > 0) : ?>
        <table class='table'>
            <tr>
             
                <th>Title</th>
                <th>URL</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    
                    <td><a href="<?php echo $row["url"]; ?>"><?php echo $row["title"]; ?></a></td>
                    <td><?php echo $row["url"]; ?></td>
                    <td><?php  echo $row["description"] !== null ? substr($row["description"], 0, 125) : '';  // Displaying first 50 characters of description ?></td>
                    <td><?php echo $row["created_at"]; ?></td>
                    <td>
    <a href="edit.php?id=<?php echo $row["id"]; ?>" class="btn btn-edit">
        <i class="fas fa-edit"></i> Edit
    </a>
    <form action="delete.php" method="post" style="display: inline;">
        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
        <button type="submit" class="btn btn-delete">
            <i class="fas fa-trash-alt"></i> Delete
        </button>
    </form>
</td>



                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <p>0 results</p>
    <?php endif; ?>

    <?php
    // No need to close the connection here since it's already closed after retrieving data
    ?>
</div>
 <script src="./script.js"></script>

</div>
</body>
</html>

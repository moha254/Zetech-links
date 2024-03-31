<?php
require_once 'Connection.php';

$sql = "SELECT * FROM links";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mycss.css"> 
    <title>Links</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
                require_once 'Connection.php';

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $title = $_POST['title'];
                    $url = $_POST['url'];
                    $description = $_POST['description'];

                    $sql = "INSERT INTO links (title, url, description) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $title, $url, $description);

                    if ($stmt->execute()) {
                        header("Location: index.php");
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                    $stmt->close();
                }

                $conn->close();
            ?>
          
          <div class="container mt-5">
        <h1 class="text-center">Welcome Admin</h1>
        <h1 class="text-center">Create Link</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="url">URL:</label>
                <input type="text" name="url" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <input type="submit" value="Submit" class="btn btn-primary">
        </form>
        <!-- Button to direct to the admin panel -->
        <a href="AdminPanel.php" class="btn btn-secondary custom-button">Go to Admin Panel</a>
    </div>
    <!-- Add Bootstrap JS (optional) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="./script.js"></script> 
</body>
</html>
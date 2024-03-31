<?php
require_once 'Connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM links";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Links</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Links</h1>
    <a href="create.php" class="btn btn-primary">Create a new link</a>

    <?php if ($result) : ?>
        <table class='table'>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>URL</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><a href="<?php echo $row["url"]; ?>"><?php echo $row["title"]; ?></a></td>
                    <td><?php echo $row["url"]; ?></td>
                    <td><?php echo $row["description"]; ?></td>
                    <td><?php echo $row["created_at"]; ?></td>
                    <td>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <p>0 results</p>
    <?php endif; ?>

    <?php
    // Close the connection
    $conn->close();
    ?>
</div>
</body>
</html>

<?php
require_once 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Retrieve form data
    $id = $_POST['id'];
    $title = $_POST['title'];
    $url = $_POST['url'];
    $description = $_POST['description'];

    // Update the link in the database
    $sql = "UPDATE links SET title=?, url=?, description=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $url, $description, $id);
    $stmt->execute();

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

    // Redirect back to the AdminPanel.php page after updating
    header("Location: index.php?success=link_updated");
    exit();
}
?>

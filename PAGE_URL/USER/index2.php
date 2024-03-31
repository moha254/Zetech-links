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



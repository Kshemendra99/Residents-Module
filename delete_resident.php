<?php
include 'config.php';
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn->query("DELETE FROM residents WHERE id=$id");
    echo "Deleted successfully. <a href='search.php'>Back</a>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Residents</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
<h3>Are you sure you want to delete this resident?</h3>
<form method="post">
    <input type="submit" value="YES"><br>
    <a href="search.php">Cancel</a>
</form>
</div>
</body>
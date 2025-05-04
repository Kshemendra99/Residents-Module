<?php include 'config.php'; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Resident</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Register Form -->
    <div class="form-container">
        <h2>Register New Resident</h2>

        <form action="add_resident.php" method="POST">
            
            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" required>

            <label for="nic">NIC:</label>
            <input type="text" name="nic" required>

            <label for="address">Address:</label>
            <textarea name="address" required></textarea>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="occupation">Occupation:</label>
            <input type="text" name="occupation">

            <label for="gender">Gender:</label>
            <select name="gender" required>
                <option value="">--Select--</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <input type="submit" value="Add Resident">
        </form>

        <div class="search-link">
            <a href="search.php">Search Residents</a>
        </div>
    </div>
</body>
</html>

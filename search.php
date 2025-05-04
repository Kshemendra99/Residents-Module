<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Residents</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="search">
    <div class="form-container">
        <h2>Search Residents</h2>

        <form action="search.php" method="GET">
            <label for="search">Search by Name, Address, or NIC:</label>
            <input type="text" name="search_query" id="search" required>
            <input type="submit" value="Search">
        </form>
    </div>

    <?php
    if (isset($_GET['search_query'])) {
        // Sanitize and prepare the search query
        $search = "%" . $_GET['search_query'] . "%";

        // Prepare SQL query to search for residents by full_name, address, or nic
        $stmt = $conn->prepare("SELECT * FROM residents WHERE full_name LIKE ? OR address LIKE ? OR nic LIKE ?");
        $stmt->bind_param("sss", $search, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any matching residents are found
        if ($result->num_rows > 0) {
            echo "<div class='search-results'>";
            echo "<h3>Search Results:</h3>";
            echo "<table border='1'>
                    <tr>
                        <th>Full Name</th>
                        <th>DOB</th>
                        <th>NIC</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Occupation</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>";
            // Loop through the result set and display each resident's information in a table row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['full_name']}</td>
                        <td>{$row['dob']}</td>
                        <td>{$row['nic']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['occupation']}</td>
                        <td>{$row['gender']}</td>
                        <td>
                            <a href='edit_resident.php?id={$row['id']}'>Edit</a> |
                            <a href='delete_resident.php?id={$row['id']}'>Delete</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
            echo "</div>";
        } else {
            // If no results were found
            echo "<div class='search-results'><p>No matching residents found.</p></div>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
    
    <div class="search-link">
        <a href="index.php">Back to Registration</a>
    </div>
    </div>
</body>
</html>

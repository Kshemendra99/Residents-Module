<?php
include 'config.php';

$id = $_GET['id'] ?? $_POST['id'] ?? null;

if (!$id) {
    echo "Invalid resident ID.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, so update the resident
    $full_name = $_POST['full_name'];
    $dob = $_POST['dob'];
    $nic = $_POST['nic'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $occupation = $_POST['occupation'];
    $gender = $_POST['gender'];

    $stmt = $conn->prepare("UPDATE residents SET full_name=?, dob=?, nic=?, address=?, phone=?, email=?, occupation=?, gender=? WHERE id=?");
    $stmt->bind_param("ssssssssi", $full_name, $dob, $nic, $address, $phone, $email, $occupation, $gender, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating resident.";
    }
} else {
    // Page loaded normally, fetch resident details
    $stmt = $conn->prepare("SELECT * FROM residents WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "Resident not found.";
        exit;
    } else {
        $resident = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Resident</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Resident Details</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?= $resident['id'] ?>">

            <label>Full Name:</label>
            <input type="text" name="full_name" value="<?= htmlspecialchars($resident['full_name']) ?>" required>

            <label>Date of Birth:</label>
            <input type="date" name="dob" value="<?= $resident['dob'] ?>" required>

            <label>NIC:</label>
            <input type="text" name="nic" value="<?= htmlspecialchars($resident['nic']) ?>" required>

            <label>Address:</label>
            <textarea name="address" required><?= htmlspecialchars($resident['address']) ?></textarea>

            <label>Phone:</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($resident['phone']) ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($resident['email']) ?>">

            <label>Occupation:</label>
            <input type="text" name="occupation" value="<?= htmlspecialchars($resident['occupation']) ?>">

            <label>Gender:</label>
            <select name="gender" required>
                <option value="">--Select--</option>
                <option value="Male" <?= $resident['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= $resident['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                <option value="Other" <?= $resident['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
            </select>

            <input type="submit" value="Update Resident">
        </form>
    </div>
</body>
</html>

<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $dob = $_POST['dob'];
    $nic = $_POST['nic'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $occupation = $_POST['occupation'];
    $gender = $_POST['gender'];

    // Check if NIC already exists
    $stmt = $conn->prepare("SELECT id FROM residents WHERE nic = ?");
    $stmt->bind_param("s", $nic);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Resident exist under this NIC! Please insert correct NIC.'); window.history.back();</script>";
    } else {
        // Insert new record
        $stmt = $conn->prepare("INSERT INTO residents (full_name, dob, nic, address, phone, email, occupation, gender)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $full_name, $dob, $nic, $address, $phone, $email, $occupation, $gender);

        if ($stmt->execute()) {
            echo "<script>alert('Resident added successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error inserting resident: " . $stmt->error . "');</script>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>

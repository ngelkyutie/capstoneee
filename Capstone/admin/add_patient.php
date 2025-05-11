<?php
require '../connection/db_connection.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $default_password = password_hash('default123', PASSWORD_BCRYPT); // Default password

    // Insert patient into the database
    $sql = "INSERT INTO patients (email, password, first_name, last_name) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $email, $default_password, $first_name, $last_name);

    if ($stmt->execute()) {
        echo "Patient account created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <link rel="stylesheet" href="../css/add_patient.css">
</head>
<body>
    <div class="add-patient-container">
        <h2>Manage Patients</h2>
        <button id="openModalButton">Add Patient</button>
    </div>

    <!-- Modal Overlay -->
    <div id="addPatientModal" class="modal-overlay">
        <div class="modal-content">
            <span id="closeModalButton" class="close-button">&times;</span>
            <h2>Add Patient</h2>
            <form id="addPatientForm" method="POST" action="add_patient.php">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" required>

                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <button type="submit">Add Patient</button>
            </form>
        </div>
    </div>

    <script src="../js/add_patient.js"></script>
</body>
</html>
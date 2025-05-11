<?php
require '../connection/db_connection.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $password = trim($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash the password

    // Check if the patient already exists
    $check_sql = "SELECT * FROM patients WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param('s', $email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Patient already exists
        header('Location: patient_staff_Mngmt.php?error=exists');
        exit;
    } else {
        // Insert new patient into the database
        $sql = "INSERT INTO patients (email, password, first_name, last_name, is_password_changed) VALUES (?, ?, ?, ?, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $email, $hashed_password, $first_name, $last_name);

        if ($stmt->execute()) {
            // Redirect back to patient_staff_Mngmt.php with a success flag
            header('Location: patient_staff_Mngmt.php?success=1');
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            alert('Patient successfully added!');
        });
    </script>
<?php elseif (isset($_GET['error']) && $_GET['error'] == 'exists'): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            alert('Error: Patient account already exists!');
        });
    </script>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/user.css">
</head>
<body>

<div class="sidebar">
    <div class="sidebar-top">
      <img src="../Assets/Logo.png" alt="Logo" class="logo">
      <a href="../admin/dashboard.php" class="icon-wrapper" title="Dashboard"><i class="fa-solid fa-tachograph-digital"></i></a>
      <a href="../admin/patient_staff_Mngmt.php" class="icon-wrapper active"><i class="fa-solid fa-users"></i></a>
      <a href="schedule_follow_up.php" class="icon-wrapper" title="Appointments"><i class="fa-solid fa-calendar-check"></i></a>
      <a href="content_management.php" class="icon-wrapper" title="Content Management"><i class="fa-solid fa-file-pen"></i></a>
      <a href="../admin/PostProcedure_Form.php" class="icon-wrapper" title="Users"><i class="fa-solid fa-file-contract"></i></a>
    </div> 
    <div class="sidebar-bottom">
      <a href="notifications.php" class="icon-wrapper" title="Notifications"><i class="fas fa-bell icon"></i></a>
      <a href="profile.php" class="icon-wrapper" title="Profile"><img src="../Assets/avatar.jpg" alt="User" class="avatar"></a>
      <a href="../admin/admin_login.php" class="icon-wrapper" title="Logout" onclick="return confirmLogout(event);"><i class="fas fa-sign-out-alt icon"></i></a>
    </div>
</div>

<div class="content container-fluid">
    <!-- Staff Management -->
    <h4 class="mt-4">Staff Management</h4>
    <table id="staffTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th><th>Username</th><th>Name</th><th>Role</th><th>Email Address</th><th>Mobile</th><th>Created</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $staff = [
                [1, 'Angel', 'Angel Cuadronal', 'Staff', 'angelkyutdo5@gmail.com', '0999888777', '2025-04-12 08:13:56'],
                [2, 'Joy123', 'Aleck Joy Carpio', 'Staff', 'joywinxwood@gmail.com', '0999888778', '2025-04-12 08:13:56'],
                [3, 'Japan', 'Justine Valera', 'Staff', 'justinesiroal@gmail.com', '0999888779', '2025-04-12 08:13:56'],
                [4, 'Jiga', 'Jessie Valera', 'Staff', 'jessiewlowame@gmail.com', '0999888770', '2025-04-12 08:13:56'],
            ];
            foreach ($staff as $row) {
                echo "<tr>";
                foreach ($row as $col) echo "<td>$col</td>";
                echo '<td class="action-buttons">
                        <button class="btn btn-info btn-sm">View</button>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                      </td>';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="mb-3">
        <button class="btn btn-primary btn-sm">Add Staff +</button>
    </div>

    <!-- Patient's Management -->
    <h4 class="mt-5">Patient's Management</h4>
<table id="patientsTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Patient Number</th>
            <th>Date</th>
            <th>Time</th>
            <th>Treatment</th>
            <th>Appointment Type</th>
            <th>Status</th>
            <th>Patient Name</th>
            <th>Reason</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT id, email, first_name, last_name, is_password_changed, created_at FROM patients";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>"; // Placeholder for "Date"
                echo "<td>--:--</td>"; // Placeholder for "Time"
                echo "<td>--</td>"; // Placeholder for "Treatment"
                echo "<td>--</td>"; // Placeholder for "Appointment Type"
                echo "<td>" . ($row['is_password_changed'] ? 'Active' : 'Pending') . "</td>";
                echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                echo "<td>--</td>"; // Placeholder for "Reason"
                echo '<td class="action-buttons">
                        <button class="btn btn-info btn-sm">View</button>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                      </td>';
                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>
</tbody>
    </table>
    <div class="mb-3">
    <button class="btn btn-primary btn-sm" id="openModalButton">Add Patient +</button>
</div>

<div id="addPatientModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <span id="closeModalButton" class="close-button">&times;</span>
        <h2>Add Patient</h2>
        <form id="addPatientForm" method="POST" action="patient_staff_Mngmt.php">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Add Patient</button>
        </form>
    </div>
</div>
<div id="successPrompt" class="success-prompt">
    Patient successfully added!
</div>
<!-- Scripts -->
 <script src="../js/add_patient.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#staffTable').DataTable();
        $('#patientsTable').DataTable();
    });
</script>

</body>
</html>
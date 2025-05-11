

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="sidebar">
    <div class="sidebar-top">
      <img src="../Assets/Logo.png" alt="Logo" class="logo">
      <a href="../admin/dashboard.php" class="icon-wrapper active" title="Dashboard"><i class="fa-solid fa-tachograph-digital"></i></a>
      <a href="../admin/patient_staff_Mngmt.php" class="icon-wrapper"><i class="fa-solid fa-users"></i></a>
      <a href="schedule_follow_up.php" class="icon-wrapper" title="Appointments"><i class="fa-solid fa-calendar-check"></i></i></a>
      <a href="content_management.php" class="icon-wrapper" title="Content Management"><i class="fa-solid fa-file-pen"></i></a>
      <a href="../admin/PostProcedure_Form.php" class="icon-wrapper" title="Users"><i class="fa-solid fa-file-contract"></i></a>
    </div> 
    <div class="sidebar-bottom">
      <a href="notifications.php" class="icon-wrapper" title="Notifications"><i class="fas fa-bell icon"></i></a>
      <a href="profile.php" class="icon-wrapper" title="Profile"><img src="../Assets/avatar.jpg" alt="User" class="avatar"></a>
      <a href="../admin/admin_login.php" class="icon-wrapper" title="Logout" onclick="return confirmLogout(event);"><i class="fas fa-sign-out-alt icon"></i></a>
    </div>
</div>

<div class="main-content">
    <h3 class="title">Dashboard</h3>
    <div class= "cards">
    <div class="card">
        <h3>Today</h3>
       
    </div>
    <div class="card">
        <h3>Tomorrow</h3>
       
    </div>
    <div class="card">
        <h3>This Week</h3>
      
    </div>
    <div class="card">
        <h3>This Month</h3>
    
    </div>
</div>

  <div class="appointment-section">
    <h2>Recent Appointments</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th><th>Patient Number</th><th>Date</th><th>Time</th><th>Treatment</th><th>Type</th><th>Status</th><th>Patient</th><th>Reason</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>1</td><td>25-0101</td><td>Sat, Apr 12</td><td>10:30 AM</td><td>Cleaning</td><td>Follow-Up</td><td><span class="status pending">Pending</span></td><td>Angel Cudalenci</td><td>-</td></tr>
        <tr><td>2</td><td>25-0102</td><td>Sat, Apr 12</td><td>12:30 PM</td><td>Flexible Denture</td><td>Re-schedule</td><td><span class="status pending">Pending</span></td><td>Alexi Joy Carpio</td><td>Out of the Country</td></tr>
        <tr><td>3</td><td>25-0103</td><td>Sat, Apr 12</td><td>2:30 PM</td><td>Cleaning</td><td>Follow-Up</td><td><span class="status confirmed">Confirmed</span></td><td>Jace Cuaderno</td><td>-</td></tr>
        <tr><td>4</td><td>25-0104</td><td>Sat, Apr 12</td><td>12:00 PM</td><td>LS Plastic Denture</td><td>Follow-Up</td><td><span class="status completed">Completed</span></td><td>John Rey Laticanero</td><td>-</td></tr>
      </tbody>
    </table>
  </div>

  <div class="chart">
    
    <div class="chart-box" style="margin-top: 20px;">
    <h3>User Demographics: Sex</h3>
    <canvas id="sexChart"></canvas>
    </div>
    <div class="chart-box" style="margin-top: 20px;">
    <h3>User Demographics: Age</h3>
    <canvas id="ageChart"></canvas>
    </div>
  </div>

  <div class="chart-box" style="margin-top: 20px;">
    <h3>Service Feedback</h3>
    <canvas id="feedbackChart"></canvas>
  </div>
</div>
</body>
<script src="../js/admin_dashboard.js"></script>
</html>
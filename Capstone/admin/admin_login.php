<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<div class="login-wrapper">
    <link rel="stylesheet" href="../css/admin_login.css">
</head>

<body>
<div class="login-wrapper">
    <div class="login-left">
      <img src="../Assets/Logo Nav Bar.png" alt="Logo" class="logo">
      <h2>Admin Portal<br><strong>LOG IN</strong></h2>

      <form method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Login</button>
      </form>

      <div class="forgot"><a href="../forgot_pass/forgot-password.php">Forgot Password?</a></div>
    </div>
    <div class="login-right">
    <img src="../Assets/tooth.png" alt="Tooth-image" class="tooth-image">
    </div>
  </div>
   
</body>
</html>
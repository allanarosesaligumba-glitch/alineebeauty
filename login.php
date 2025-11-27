<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost","root","","registration_db");
if(!$conn){ die("Connection failed: ".mysqli_connect_error()); }

$login_error = "";

// Login process
if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_email'] = $row['email'];
            header("Location: index.php");
            exit();
        } else {
            $login_error = "Incorrect password.";
        }
    } else {
        $login_error = "Email not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Velour Glow | Home</title>
  <link rel="stylesheet" href="style.css">
  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200&display=swap">

  <style>
  .login_error{colo: red;}
/* LOGIN FORM STYLING – SAME AS REGISTRATION */
.login-section {
  background-color: #F3F3E6;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 60px 20px;
}

.login-container {
  background: #fff9e6;
  border: 2px solid #EECD5C;
  box-shadow: 0 6px 20px rgba(29, 25, 18, 0.15);
  border-radius: 12px;
  padding: 40px;
  width: 100%;
  max-width: 420px;
  text-align: center;
}

.login-container h1 {
  font-size: 1.8rem;
  color: #1D1912;
  margin-bottom: 20px;
  font-family: 'Poppins', sans-serif;
}

.login-container input {
  width: 100%;
  padding: 10px 14px;
  margin-bottom: 15px;
  border: 1px solid #D2A63C;
  border-radius: 8px;
  outline: none;
  background-color: #fff;
  font-size: 1rem;
}

.login-container input:focus {
  border-color: #BB8525;
}

.login-container a {
  color: #BB8525;
  text-decoration: none;
}

.login-container a:hover {
  text-decoration: underline;
}
</style>

</head>
<body>
  <!-- Top Bar -->
  <div class="top-bar">
    <p>VELOUR GLOW COSMETICS <a href="shop.php">Shop Now</a></p>
  </div>

  <!-- Navbar -->
  <header>
    <div class="navbar">
      <!-- Left Nav -->
      <nav class="nav-left">
        <a href="index.php" class="nav-link">Home</a>
        <a href="shop.php" class="nav-link">Shop</a>
        <a href="tutorials.php" class="nav-link">Tutorial & Tips</a>
        <a href="about.php" class="nav-link">About Us</a>
        <a href="contact.php" class="nav-link">Contact</a>
      </nav>

      <!-- Logo Center -->
      <div class="nav-logo">
        <h2>Velour Glow</h2>
      </div>

      <!-- Right Nav -->
      <div class="nav-right">
        <div class="search-box">
          <input type="text" placeholder="What are you looking for?">
          <i class="fa fa-search"></i>
        </div>
        <a href="login.php" class="nav-link active"><i class="fa fa-user"></i></a>
        <a href="cart.php"><i class="fa fa-bag-shopping"></i></a>
      </div>
    </div>
  </header>

<section class="login-section">
  <div class="login-container">
    <h1>Login to Your Account</h1>

    <?php if($login_error != ""): ?>
      <p style="color:red; text-align:center;"><?= $login_error ?></p>
    <?php endif; ?>

    <form method="post" action="">
      <input type="email" name="email" placeholder="Email" required><br><br>
      <input type="password" name="password" placeholder="Password" required><br><br>
      <button type="submit" name="login" 
  style="background-color:#D9BD71; color:#1D1912; font-weight:600; padding:12px 20px; border:none; border-radius:8px; font-size:1rem; width:100%; cursor:pointer; transition:0.3s;"
  onmouseover="this.style.backgroundColor='#BB8525'; this.style.color='#fff';"
  onmouseout="this.style.backgroundColor='#D9BD71'; this.style.color='#1D1912';"
>Login</button>
    </form>

    <p style="font-weight: bold;"><a href="forgot_password.php">Forgot Password?</a></p>
    <p style="font-weight: bold;"><a href="register.php">Create an account</a></p>
  </div>
</section>

<footer>
  <p style="text-align:center;">&copy; 2025 Velour Glow Cosmetics. All Rights Reserved.</p>
</footer>

</body>
</html>

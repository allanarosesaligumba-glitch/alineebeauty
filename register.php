<?php
// Database connection
$conn = mysqli_connect("localhost","root","","registration_db");
if(!$conn){ die("Connection failed: ".mysqli_connect_error()); }

$register_msg = "";

if(isset($_POST['register'])){
    $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
    $surname  = mysqli_real_escape_string($conn,$_POST['surname']);
    $contact  = mysqli_real_escape_string($conn,$_POST['contact']);
    $email    = mysqli_real_escape_string($conn,$_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email exists
    $check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($check) > 0){
        $register_msg = "Email already registered.";
    } else {
        $sql = "INSERT INTO users (lastname,surname,contact,email,password)
                VALUES ('$lastname','$surname','$contact','$email','$password')";
        if(mysqli_query($conn,$sql)){
            $register_msg = "Registration successful! You can now <a href='login.php'>login</a>.";
        } else {
            $register_msg = "Error: ".mysqli_error($conn);
        }
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
    /* ===== Registration Page Styles ===== */
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #F3F3E6;
      margin: 0;
      padding: 0;
      color: #1D1912;
    }

    .register-section {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 60px 20px;
    }

    .register-container {
      background: #fff9e6;
      border: 2px solid #EECD5C;
      box-shadow: 0 6px 20px rgba(29, 25, 18, 0.15);
      border-radius: 12px;
      padding: 40px;
      width: 100%;
      max-width: 420px;
      text-align: center;
    }

    .register-container h1 {
      font-size: 1.8rem;
      color: #1D1912;
      margin-bottom: 20px;
    }

    .register-form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .register-form input {
      padding: 10px 14px;
      border: 1px solid #D2A63C;
      border-radius: 8px;
      outline: none;
      background-color: #fff;
    }

    .register-form input:focus {
      border-color: #BB8525;
    }

    /* ===== Register Button Style ===== */
    .register-form button {
      background-color: #D9BD71;
      color: #1D1912;
      font-weight: 600;
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      width: 100%;
      transition: 0.3s;
    }

    .register-form button:hover {
      background-color: #BB8525;
      color: #fff;
    }

    /* ===== Login link below form ===== */
    .register-container p a {
      display: inline-block;
      color: #BB8525;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 8px;
      margin-top: 10px;
      transition: 0.3s;
      font-weight: 600;
    }

    .register-container p a:hover {
      text-decoration: underline;
    }

    .top-bar {
  background: #D9bd71;
  text-align: center;
  font-size: 13px;
  color: #1D1912;
  padding: 10px 0;
  letter-spacing: 1px;
}

.top-bar a {
  color: #1D1912;
  font-weight: 600;
  margin-left: 5px;
  border-bottom: 1px solid #1D1912;
}

.top-bar a:hover {
  color: #BB8525;
}

/* ===== NAVBAR ===== */
header {
  background: #F3F3E6;
  border-bottom: 1px solid #EECD5C;
  position: sticky;
  top: 0;
  z-index: 1000;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 40px;
}

.nav-left, .nav-right {
  display: flex;
  align-items: center;
  gap: 20px;
}

.nav-link {
  font-size: 13px;
  font-weight: 500;
  color: #1D1912;
  padding-bottom: 3px;
}

.nav-link:hover,
.nav-link.active {
  border-bottom: 2px solid #BB8525;
  color: #BB8525;
}

.nav-logo h2 {
  font-family: "Dancing Script", cursive;
  font-size: 22px;
  color: #1D1912;
}

/* ===== SEARCH BOX ===== */
.search-box {
  position: relative;
}

.search-box input {
  padding: 6px 30px 6px 10px;
  border: none;
  border-bottom: 1px solid #D2A63C;
  outline: none;
  font-size: 13px;
  background-color: transparent;
  color: #1D1912;
}

.search-box input::placeholder {
  color: #7a745e;
}

.search-box i {
  position: absolute;
  right: 8px;
  top: 50%;
  transform: translateY(-50%);
  color: #7a745e;
  cursor: pointer;
}

/* ===== ICONS ===== */
.nav-right i {
  font-size: 18px;
  cursor: pointer;
  color: #1D1912;
  transition: color 0.3s;
}

.nav-right i:hover {
  color: #BB8525;
}

/* ===== FOOTER ===== */
footer {
  text-align: center;
  padding: 20px;
  background: #D9bd71;
  color: #1D1912;
  font-size: 14px;
  margin-top: 40px;
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


<!-- Registration Section -->
<section class="register-section">
  <div class="register-container">
    <h1>Create an Account</h1>

    <?php if(isset($register_msg) && $register_msg != ""): ?>
      <p style="color:green; text-align:center;"><?= $register_msg ?></p>
    <?php endif; ?>

    <form method="post" action="" class="register-form">
      <input type="text" name="lastname" placeholder="Lastname" required>
      <input type="text" name="surname" placeholder="Surname" required>
      <input type="text" name="contact" placeholder="Contact Number" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="register">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
  </div>
</section>

<footer>
  <p>&copy; 2025 Velour Glow Cosmetics. All Rights Reserved.</p>
</footer>

</body>
</html>

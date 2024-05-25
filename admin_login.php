<?php
session_start();

// If the session variable is set and true, redirect to index_admin.html
if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
  session_destroy();
   header("Location: index_admin.html");
   exit(); // Exit to prevent further execution
}

// Check login credentials
if (isset($_POST["login"])) {
    $admin_username = "admin"; // Predefined admin username
    $admin_password = "admin123"; // Predefined admin password
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Verify username and password
    if ($username === $admin_username && $password === $admin_password) {
        // Set session variable and redirect to index_admin.html
        $_SESSION["admin"] = true;
        header("Location: index_admin.html");
        exit(); // Exit to prevent further execution
    } else {
        // Display error message for invalid credentials
        echo "<div class='alert alert-danger'>Invalid username or password</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
    .navbar {
      background-color:white;
      color: #fff;
      display: flex;
      align-items: center;
      padding:20px;
    }

    .navbar img {
      margin-right: 10px;
      height: 60px; /* Adjust height as needed */
    }

    .marquee {
      width: 100%;
      overflow: hidden;
    }

    .marquee span {
      display: inline-block;
      padding-right: 100%; /* Move the text out of the viewport */
      animation: marquee 15s linear infinite;
    }

    @keyframes marquee {
      0% { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }
    .marquee-text
    {
      color: black;
      font-weight: bold;
      font-family: "Bell MT", serif;
      font-size: 35px;
      
    }
    .image-container {
      position: fixed;
      bottom: 100px;
      left: 0;
      margin: 20px;
    }
  </style>
</head>
<body>

    <!-- Paste the navbar section here -->
    <div class="container">
   
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <input type="text" placeholder="Enter Username" name="username" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password" name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        
    </div>
    <div class="image-container">
        <img src="admin1.png" alt="Logo" style="height: 400px;">
</body>
</html>

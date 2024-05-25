<?php
session_start();
if (isset($_SESSION["user"])) {
    session_destroy();
    header("Location:login.php");
    exit(); // Exit to prevent further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration Form</title>
    <link rel="stylesheet" href="Login-page/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
  </style>
</head>
<body>
<div class="navbar">
    <img src="Mock Test/SUCCESSNAVIGATOR.png" alt="Logo">
    <div class="marquee">
      <marquee direction="left" loop="" class="marquee-text"scrollamount="10">SUCCESSNAVIGATOR - Navigate Your Success: Your Ultimate Companion for Competitive Exams...!</marquee>
    </div>
  </div>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="#" class="sign-in-form" method="post">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" placeholder="Email" name="email" class="form-control">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" class="form-control">
                    </div>
                    <input type="submit" value="Login" name="login" class="btn solid">
                    <?php
                        if (isset($_POST["login"])) {
                            $email = $_POST["email"];
                            $password = $_POST["password"];
                            require_once "database.php";
                            $sql = "SELECT * FROM users WHERE email = '$email'";
                            $result = mysqli_query($conn, $sql);
                            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            if ($user) {
                                if (password_verify($password, $user["password"])) {
                                    $_SESSION["user"] = "yes";
                                    header("Location: User Dashboard/userdashboard.html");
                                    exit(); // Exit to prevent further execution
                                } else {
                                    echo "<div class='alert alert-danger'>Password does not match</div>";
                                }
                            } else {
                                echo "<div class='alert alert-danger'>Email does not exist</div>";
                            }
                        }
                    ?>
                    <p class="social-text">Or Sign in with social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
                <form action="#" class="sign-up-form" method="post">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Full Name" name="fullname" class="form-control">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" class="form-control">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" class="form-control">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Repeat Password" name="repeat_password" class="form-control">
                    </div>
                    <input type="submit" class="btn" value="Sign up" name="submit">
                    <?php
                        if (isset($_POST["submit"])) {
                            $fullName = $_POST["fullname"];
                            $email = $_POST["email"];
                            $password = $_POST["password"];
                            $passwordRepeat = $_POST["repeat_password"];
                            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                            $errors = array();
                            if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat)) {
                                array_push($errors,"All fields are required");
                            }
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                array_push($errors, "Email is not valid");
                            }
                            if (strlen($password) < 8) {
                                array_push($errors,"Password must be at least 8 characters long");
                            }
                            if ($password !== $passwordRepeat) {
                                array_push($errors,"Passwords do not match");
                            }
                            require_once "database.php";
                            $sql = "SELECT * FROM users WHERE email = '$email'";
                            $result = mysqli_query($conn, $sql);
                            $rowCount = mysqli_num_rows($result);
                            if ($rowCount > 0) {
                                array_push($errors,"Email already exists!");
                            }
                            if (count($errors) > 0) {
                                foreach ($errors as  $error) {
                                    echo "<div class='alert alert-danger'>$error</div>";
                                }
                            } else {
                                $sql = "INSERT INTO users(full_name, email, password) VALUES (?, ?, ?)";
                                $stmt = mysqli_stmt_init($conn);
                                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                                if ($prepareStmt) {
                                    mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                                    mysqli_stmt_execute($stmt);
                                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
                                } else {
                                    die("Something went wrong");
                                }
                            }
                        }
                    ?>
                    <p class="social-text">Or Sign up with social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3 style="color:black;">New here ?</h3>
                    <p style="color:black;">
                    Do The Registraion...!!
                    Click on Sign up Option for Registration

                    </p>
                    <button class="btn transparent"style="color:black;" id="sign-up-btn">Sign up</button>
                </div>
                <img src="Login-page/img/login1.png" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3 style="color:black;">One of us ?</h3>
                    <p style="color:black;">
                        If You  are Already Register...
                        Click On Sign in Below...
                    </p>
                    <button class="btn transparent" style="color:black;" id="sign-in-btn">Sign in</button>
                </div>
                <img src="Login-page/img/login1.png" class="image" alt="" />
            </div>
        </div>
    </div>
    <script src="Login-page/app.js"></script>
</body>
</html>

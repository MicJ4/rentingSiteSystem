<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Form</title>
<link rel="stylesheet" href="login.css" />
</head>
<body class="loginBody">
  <div class="card">
    <?php
    session_start(); 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $db_host = 'localhost'; 
        $db_username = 'root'; 
        $db_password = ''; 
        $db_name = 'rentingSite';

       
        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

     
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $username = $_POST['username'];
        $passwords = $_POST['passwords'];

        $query = "SELECT * FROM userDetails WHERE username = '$username' AND passwords = '$passwords'";
        $result = $conn->query($query);
        if ($result->num_rows >= 1) {
          
          $_SESSION['username'] = $username;
    
          if ($username === 'SUPERADMIN') {
              header('Location: admin.php');
          } else {
              header('Location: home.php');
          }

        } else {
        
            $cred_error = "Incorect username or password.";
            $show_error = 1; 
        }
    }
    ?>
    <form class="loginForm" action="" method="POST">
      <div class="form-group">
        <label>Username</label>
        <input type="text" id="username" name="username" autocomplete="off" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" id="passwords" name="passwords" required>
      </div>
      <div class="form-group">
        <button type="submit" class="loginButton" value="Login" id='loginButton'>Login</button>
      </div>
      <?php 
          if ($show_error === 1 ) {
            echo "<p style='color:rgb(6,15,46);'>{$cred_error}</p>";
          }
      ?>
     <a href="register.php" style="color:rgb(21, 37, 94);padding:10px;font-size:130%;text-decoration:none;">create new account</a>
    </form>
  </div>
</body>
</html>

<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: after_login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: after_login.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/TTMS_GP_MUMBAI/css/bootstrap_1.css">
	<link rel="stylesheet" href="/TTMS_GP_MUMBAI/css/style.css">
	<link rel="stylesheet" href="/TTMS_GP_MUMBAI/css/font-awesome.min.css">
    <style type="text/css">
       .wrapper{ 
		width: 350px;
		padding: 20px; 
		margin-top:-10px;
		margin-left:600px;
		}
    </style>
</head>
<body class="body">
		
			<div class = "menu-bar">
				<img src="/TTMS_GP_MUMBAI/img/gimp.png" id="logo"/><center>
				<div style = "position:relative; top:15px; color:white;">
				<h2 style="font-size:28px">GOVERNMENT POLYTECHNIC MUMBAI</h2>
				</div>
				<div style = "position:relative; top:18px; color:white;">
				<h4>शासकीय तंत्रनिकेतन मुंबई</h4>
				</div>
				<div style = "position:relative; top:21px; color:white;e">
				<h4>MAHARASHTRA GOVERNMENT AUTONOMOUS INSTITUTE</h4>
				</div>
				<div style = "position:relative; top:28px; color:black;">
				<h2 align="right"><span style="background-color:#ffff33">&nbsp;&nbsp;TIMETABLE MANAGEMENT SYSTEM&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
				</div>
				</center>
				
				<nav>
			<ul class = "nav">
				<li class = "active"><a href="after_login.php"><i class="fa fa-home"></i>HOME</a></li>
				<li><a href="#"><i class="fa fa-sticky-note"></i>SYLLABUS</a>
					<div class="sub-menu-1">
						<ul>
							<li><a href="IT_pdf.php">Information Technology</a></li>
							<li><a href="CO_pdf.php">Computer Engineering</a></li>
							<li><a href="CE_pdf.php">Civil Engineering</a></li>
							<li><a href="ME_pdf.php">Mechanical Engineering</a></li>
							<li><a href="EC_pdf.php">Electronics Engineering</i></a></li>
							<li><a href="EE_pdf.php">Electrical Engineering</a></li>
							<li><a href="IS_pdf.php">Instrumention Engineering</a></li>
							<li><a href="RT_pdf.php">Rubber Technology</a></li>
							<li><a href="LT_pdf.php">Leather Technology</a></li>

						</ul>

					</div>
					</ul>
					</nav>
					</div>
    <div class="wrapper">
        <h1 style="font-size:40px">Login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label><h4>Username<h4></label>
                <input type="text" autocomplete="off" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label><h4>Password<h4></label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p><h4>Don't have an account? <a href="register.php">Sign up now</a>.</h4></p>
        </form>
    </div>    
</body>
</html>
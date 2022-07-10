<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["teachername"]))){
        $username_err = "Please enter a teacher name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM teacherfs WHERE teacher_name = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["teachername"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This Teacher Name is already taken.";
                } else{
                    $username = trim($_POST["teachername"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 2){
        $password_err = "Code must have atleast more than 2 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO teacherfs (teacher_name, teach_code) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = $password;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // if done print DONE
                echo "Teacher Added Successfully";
            } else{
                echo "Something went wrong. Please try again later.";
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="/TTMS_GP_MUMBAI/css/bootstrap_1.css">
	<link rel="stylesheet" href="/TTMS_GP_MUMBAI/css/style.css">
    <style type="text/css">
        body{
		font: 14px sans-serif;
		}
        .wrapper{ 
		width: 350px; 
		padding: 20px;
		margin-top:0px;
		margin-left:500px;		
		}
    </style>
</head>
<body class="body">
		<div class = "menu-bar">
				<img src="/TTMS_GP_MUMBAI/img/gimp.png" id="logo"/><center>
				<div style = "position:relative; top:10px; color:white;">
				<h2 style="font-size:28px">GOVERNMENT POLYTECHNIC MUMBAI</h2>
				</div>
				<div style = "position:relative; top:10px; color:white;">
				<h4>शासकीय तंत्रनिकेतन मुंबई</h4>
				</div>
				<div style = "position:relative; top:10px; color:white;e">
				<h4>MAHARASHTRA GOVERNMENT AUTONOMOUS INSTITUTE</h4>
				</div>
				<div style = "position:relative; top:15px; color:black;">
				<h2 align="right"><span style="background-color:#ffff33">&nbsp;&nbsp;TIMETABLE MANAGEMENT SYSTEM&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
				</div></center>
				<nav>
					<ul class = "nav">
					<li class = "active"><a href="after_login.php"><i class="fa fa-home"></i>HOME</a></li>	
					</ul>
				</nav>
		</div>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Teacher Name</label>
                <input type="text" name="teachername" class="form-control" value="<?php echo $username; ?>" autocomplete="OFF">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Teacher Code</label>
                <input type="text" name="password" class="form-control" value="<?php echo $password; ?>" autocomplete="OFF>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>
<!-- LINKED WITH DEPARTMENT\INFORMATION TECHNOLOGY\-->
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<html>
<title>
IT_CLASSES
</title>
	<head>
		<link rel="stylesheet" href="/TTMS_GP_MUMBAI/css/style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<style type="text/css">
		fieldset{
		display: block;
		border: 3px  solid #000;
		margin-top: 40px;
		margin-left: 50px;
		margin-right: 50px;
		padding-top: 0em;
		padding-bottom: 0.625em;
		padding-left: 2em;
		padding-right: 0em;
		}
		</style>
	</head>
		<body class="body">
			<div class = "menu-bar">
				<img src="/TTMS_GP_MUMBAI/img/gimp.png" id="logo"/>
				<div style = "position:relative; top:15px; color:white;">
				<h2 style="font-size:28px">GOVERNMENT POLYTECHNIC MUMBAI</h2>
				</div>
				<div style = "position:relative; top:18px; color:white;">
				<h4>शासकीय तंत्रनिकेतन मुंबई</h4>
				</div>
				<div style = "position:relative; top:21px; color:white;e">
				<h4>MAHARASHTRA GOVERNMENT AUTONOMOUS INSTITUTE</h4>
				</div>
				<div style = "position:relative; top:32px; color:black;">
				<h2 ><span style="background-color:#ffff33">&nbsp;&nbsp;TIMETABLE MANAGEMENT SYSTEM&nbsp;&nbsp;</span> </h2>
				</div>
		<nav>
				
			<ul class = "nav">
				<li class = "active"><a href="after_login.php"><i class="fa fa-home"></i>HOME</a></li>
				<li><a href="after_login.php"><i class="fa fa-building"></i>DEPARTMENT</a>
				</li>
				<li><a href="#"><i class="fa fa-user"></i>ADD TEACHER</a>
					<div class="sub-menu-1">
						<ul>
							<li><a href="teacher-register_FS.php">FIRST SHIFT</a></li>
							<li><a href="teacher-register_SS.php">SECOND SHIFT</a></li>
						</ul>
					</div>
				</li>
				<li class = "active"><a href="#" class="btn btn-danger">SIGNOUT</a>
				<div class="sub-menu-1">
						<ul>
							<li><a href="logout.php">LOGOUT</a></li>
							<li><a href="reset-password.php">RESET PASSWORD</a></li>
						</ul>
					</div></li>
			</ul>
		</nav>
			
			</div>	
			<fieldset>
			<legend style="font-size:30px"><b>CREATE TIMETABLE FOR IT DEPARTMENT</b></legend>
			<div class="container">
			<a href="fyfs.php"><button type="submit" class = "btnf btn1">FYFS</button></a><a href="syfs.php"><button type="submit" class = "btns btn2">SYFS</button></a><a href="tyfs.php"><button type="submit" class = "btnf btn1">TYFS</button></a><br>
			<a href="fyss.php"><button type="submit" class = "btns btn2">FYSS</button></a><a href="syss.php"><button type="submit" class = "btnf btn1">SYSS</button></a><a href="tyss.php"><button type="submit" class = "btns btn2">TYSS</button></a><br>
			</div>
			</fieldset>
		</body>
</html>
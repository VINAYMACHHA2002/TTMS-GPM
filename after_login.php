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
	<head>
		<link rel="stylesheet" href="/TTMS_GP_MUMBAI/css/style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
				<h2><span style="background-color:#ffff33">&nbsp;&nbsp;TIMETABLE MANAGEMENT SYSTEM&nbsp;&nbsp;</span> </h2>
				</div>
				
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

				</li>
				<li><a href="#"><i class="fa fa-building"></i>DEPARTMENT</a>
					<div class="sub-menu-1">
						<ul>
							<li class="hover-me"><a href="IT_classes.php">Information Technology<i class="fa fa-angle-right"></i></a>
							</li>
							<li class="hover-me"><a href="#">Computer Engineering<i class="fa fa-angle-right"></i></a>
							</li>
							<li class="hover-me"><a href="#">Civil Engineering<i class="fa fa-angle-right"></i></a>
							</li>
							<li class="hover-me"><a href="#">Mechanical Engineering<i class="fa fa-angle-right"></i></a>
							</li>
							<li class="hover-me"><a href="#">Electronics Engineering<i class="fa fa-angle-right"></i></a>
							</li>
							<li class="hover-me"><a href="#">Electrical Engineering<i class="fa fa-angle-right"></i></a>
							</li>
							<li class="hover-me"><a href="#">Instrumention Engineering<i class="fa fa-angle-right"></i></a>
							</li>
							<li class="hover-me"><a href="#">Rubber Technology</a><i class="fa fa-angle-right"></i>
							</li>
							<li class="hover-me"><a href="#">Leather Technology<i class="fa fa-angle-right"></i></a>
							</li>
						</ul>
					</div>
					

				</li>
				<li><a href="#"><i class="fa fa-user"></i>ADD TEACHER</a>
					<div class="sub-menu-1">
						<ul>
							<li><a href="teacher-register_FS.php">FIRST SHIFT</a></li>
							<li><a href="teacher-register_SS.php">SECOND SHIFT</a></li>
						</ul>
					</div>
				</li>
				<li class = "active"><a href="" class="btn btn-danger">SIGNOUT</a>
				<div class="sub-menu-1">
						<ul>
							<li><a href="logout.php">LOGOUT</a></li>
							<li><a href="reset-password.php">RESET PASSWORD</a></li>
						</ul>
					</div></li>
				
	
			</ul>
		</nav>
			</div>	
			
		</body>
</html>
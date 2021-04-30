<?php
session_name('sesRegister');
session_set_cookie_params(['path' => '/~juprus/icd0007_project/']);
session_start();
$_SESSION['tokenGen'] = bin2hex(random_bytes(15));
?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration</title>
	<script src="../scripts/showHidePwd.js"></script>
	<link rel="stylesheet" href="../styles/style.css">
</head>
<body>
	<header>
		<img class="logo" src="../img/JAMLogo.png">
		<nav>
			<a href="../index.php">Main page</a>
		</nav>
	</header>
	<form method="post" action="registerValidation.php">
		<label for="name"><b>Name</b></label>
		<input type="text" id="name" name="name"  placeholder="Full Name"  pattern="^[A-Za-z]+(\s[A-Za-z]+){0,2}$" required>
		<br>
		<br>
		<label for="email"><b>Email</b></label>
		<input type="text" id="email" name="email" placeholder="Email" required>
		<br>
		<br>
		<div id="positionDiv">
		<label><b>Position:</b></label>
			<ul>
				<li>
					<label>
						<input type="radio" name="position" value="employee" id="employee" name="position" onclick="ShowHide()" checked>
						<span>Employee</span>
					</label>
				</li>
				<li>
					<label>
						<input type="radio" name="position" value="employer" id="employer" name="position" onclick="ShowHide()">
						<span>Employer</span>
					</label>
				</li>
			</ul>
		</div>
		<label for="regPassword"><b>Password</b></label>
		<input type="password" id="regPassword" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
		<span id="reveal-pwd" onmouseenter="showPwd()" onmouseleave="hidePwd()" >?</span>
		<br>
		<label for="name" class="pswRequirement">* Password must have at least 8 characters and at least one number, <br> one uppercase letter and one lowercase letter.<br></label>
		<br>
		<label for="regCPassword"><b>Confirm Password</b></label>
		<input type="password" id="regCPassword" name="cPassword" placeholder="Confirm Password" required>
		<span id="reveal-pwd" onmouseenter="showcPwd()" onmouseleave="hidecPwd()" >?</span>
		<br>
		<br>
		<!-- box to enter company token, visible by default and as "employee"-->
		<div id="haveToken" style="display:block">
			<label for="company"><b>Company token</b></label>
			<input type="text" id="company" name="company" placeholder="Given by the employer">
		</div>
		<!-- box that gives the company token, visible when selecting "employer"-->
		<div id="companyGen"  style="display:none">
		<p><b><?php
		echo "Give this token to employees for registering: ";
		echo "<br>";
		echo $_SESSION['tokenGen'];?></b></p>
		</div>
		<br>
		<button class="registerButton" type="submit" name="register"><b>Register</b></button>
	</form>
</body>
</html>

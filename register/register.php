<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration</title>
	<script type="text/javascript">
	function ShowHide(){
	var employee = document.getElementById("employee");
	var employer = document.getElementById("employer");
	companyGen.style.display = employee.checked ? "none" : "block";
	haveToken.style.display = employee.checked ? "block" : "none";
	}
	</script>
	<link rel="stylesheet" href="../styles/style.css">
</head>
<body>
	<header>
		<p class="logo">Logo JAM</p>
		<nav>
			<a href="index.html">Main page</a>
			<a href="#">Profile</a>
		</nav>
	</header>
	<form method="post" action="register1.php">
		<label for="name"><b>Name</b></label>
		<input type="text" id="name" name="name"  placeholder="Full Name"  pattern="^[A-Za-z]+(\s[A-Za-z]+){0,2}$" required>
		<br>
		<br>
		<label for="email"><b>Email</b></label>
		<input type="text" id="email" name="email" placeholder="Email" required>
		<br>
		<br>
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

		<label for="name">Password must have at least 8 characters and at least one number, one uppercase letter and one lowercase letter.<br></label>
		<label for="name"><b>Password</b></label>
		<input type="password" id="password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
		<br>
		<br>
		<label for="name"><b>Confirm Password</b></label>
		<input type="password" id="cPassword" name="cPassword" placeholder="Confirm Password" required>
		<br>
		<br>
		<div id="haveToken" style="display:block">
			<label for="company"><b>Company token (token given by the employer)</b></label>
			<input type="text" id="company" name="company" required>
		</div>

		<div id="companyGen"  style="display:none">

		<p><b><?php require_once("genToken.php");
		echo "Give this token to employees for registering: ";
		echo "<br>";
		echo generateRandomString();?></b></p>
		</div>
		<br>
		<button class="registerButton" type="submit"><b>Register</b></button>
	</form>
</body>
</html>

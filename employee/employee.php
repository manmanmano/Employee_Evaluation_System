<?php
require_once("employeetable.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $_SESSION['name']; ?> evaluation</title>
        <link rel="stylesheet" href="../styles/style.css">
    </head>
    <body>
		<header>
            <img class="logo" src="../img/JAMLogo.png">
			<nav>
				<form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                    <input type="submit" name="logout" value="Log out">
                </form>
			</nav>
		</header>
        <h1>Welcome <?php echo $_SESSION['name']; ?>!</h1>
		<h1>My evaluation</h1>
        <form method="GET" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <label for="date">Week:</label>
            <input type="date" id="date" name="date">
            <input type="submit" name="search" value="Search">
        </form><br>
        <table>
            <tr>
                <th>Week</th>
                <th>Year</th>
                <th>Evaluation</th>
            </tr>
            <?php
            require_once("../sessionstart.php");
            createTable($_SESSION['token']);
            ?>
        </table>
        <footer>
            <h3>Contact JAM</h3>
            <p>
                Send us an email to:<br><a href="mailto: fake@mail.com">info@JAM.com</a>
                <br><br>
                Call us to:<br><a href="tel: +372 5555 5555">+372 5555 5555</a>
            </p>
        </footer>
    </body>
</html>
<script type="text/javascript">
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Some text in the Modal..</p>
  </div>

</div>

<?php
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("refresh:0; url=../index.php");
}
?>

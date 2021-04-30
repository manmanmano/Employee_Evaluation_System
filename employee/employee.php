<?php
//required for dynamic table and names of employees
require_once("employeetable.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--displays the user name in title-->
        <title><?php echo $_SESSION['name']; ?> evaluation</title>
        <link rel="stylesheet" href="../styles/style.css">
    </head>
    <body>
		<header>
            <img class="logo" src="../img/JAMLogo.png">
			<nav>
                <a href="userCredentials.php">User's credentials</a>
                <a href="../index.php">Log out</a>
			</nav>
		</header>
        <!-- Welcome #username-->
        <h1>Welcome <?php echo $_SESSION['name']; ?>!</h1>
        <!-- form for filtering the table-->
        <form method="GET" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <label for="date">Week:</label>
            <input type="date" id="date" name="date">
            <input type="submit" name="search" value="Search">
        </form><br>
        <p>* To reset the search click the search button again without entering any parameters</p><br>
        <table>
            <tr>
                <th>Week</th>
                <th>Year</th>
                <th>Evaluation</th>
            </tr>
            <?php
            //creates dynamic table
            require_once("../sessionstart.php");
            createTable($_SESSION['token']);
            ?>
        </table>
        <script>
            //the modal box is not implemented
            function modal(year, week) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "employee?week=" + week + "&year=" + year, true);
                xmlhttp.send();
                alert("Employee shows strong initiative: " + <?php echo $initiative; ?> 
                + "\nEmployee works well with others in group-based projects: " 
                + <?php echo $gbProjects; ?> + "\nEmployee takes instructions and follows leaders well: " 
                + <?php echo $follows ?> + "\nEmployee shows good leadership skills: " 
                + <?php echo $leadership; ?> + "\nEmployee stays focused on tasks at hand: " 
                + <?php echo $focused; ?> + "\nEmployee knows how to prioritize tasks: " 
                + <?php echo $prioritize; ?> + "\nEmployee has good communication with coworkers: " 
                + <?php echo $workers; ?> + "\nEmployee has good communication with superiors: " 
                + <?php echo $superiors; ?> + "\nEmployee is dependable: " 
                + <?php echo $dependable; ?> + "\nEmployee gets assignments in on time: " 
                + <?php echo $punctualAss; ?> + "\nEmployee arrives on time every day: " 
                + <?php echo $punctualTime; ?> + "\nEmployee's work is of high quality: " 
                + <?php echo $quality; ?> + "\n");
            }
        </script>
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

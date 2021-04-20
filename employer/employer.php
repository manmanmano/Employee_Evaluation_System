<?php
require_once("employertable.php");
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
                <a href="userCredentials.php">User's credentials</a> 
                <a href="employerInput.php">Add new evaluation</a>
                <a href="../index.php">Log out</a>
            </nav>
        </header>
        <h1>Welcome <?php echo $_SESSION['name']; ?>!</h1>
        <form method="GET" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <label for="week">Week:</label>
            <input type="date" id="date" name="date"><br>
            <label for="name">Name:</label>
            <select id="name" name="name">
                <option value=0>Please select an employee</option>
                <?php
                require_once("../sessionstart.php");
                createNames($_SESSION['token'], $link);
                ?>
            </select><br>
            <input type="submit" name="search" value="Search"><br>
        </form><br>
        <table>
            <tr>
                <th>Name</th>
                <th>Week</th>
                <th>Year</th>
                <th>Evaluation</th>
            </tr>
            <?php
            require_once("../sessionstart.php");
            createTable($_SESSION['token']);
            ?>
        </table>
        <script>
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
            function delete() {
                var ret = confirm('Are you sure you want to continue?'));
                if (ret) {
                    location.href = "employerdelete.php;
                }
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

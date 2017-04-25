<?php
/**
 * Created by PhpStorm.
 * User: linjy0419
 * Date: 4/15/17
 * Time: 2:11 PM
 */
session_start();
$current_user = $_SESSION["current_username"];
require 'config.php';

if(isset($_GET['epr'])){
    $epr = $_GET['epr'];
}
if($epr == 'logout')
{
    $current_user = -1;
    $_SESSION["current_username"] = $current_user;
    //font-family: "Playfair Display";
}
?>

<!DOCTYPE html>
<html>
<title>My Profile</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<style>
    body {font-family: "Times New Roman", Georgia, Serif;
        background: url(images/bg-body.jpg) repeat;
        height: 100%;
    }
    h1,h2,h3,h4,h6 {
        font-family: "Comic Sans MS";
        letter-spacing: 3px;
    }
    h5{
        font-family: "Playfair Display";

    }
    a:link {
        color: indianred;
    }
</style>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-wide w3-padding-8 w3-card-2">
        <form method="post" action="myprofile.php">
        <a href="#home" class="w3-bar-item w3-button w3-margin-left">My Profile</a>
        <!-- Right-sided navbar links. Hide them on small screens -->
        <div class="w3-right w3-hide-small">
            <a href="index.php" class="w3-bar-item w3-button">Home</a>
            <a href="allrecipes.php" class="w3-bar-item w3-button">All Recipes</a>
            <?php
            echo "<a href='myprofile.php?epr=logout' class='w3-bar-item w3-button'>Logout</a>";
            ?>
        </div>
        </form>
    </div>
</div>

<!-- Page content -->
<div class="w3-content" style="max-width:1100px">

    <!-- About Section -->
    <div class="w3-row w3-padding-64" id="about">
        <form method="post" action="recipe.php" class="login-form">


            <div class="w3-col m6 w3-padding-large">
                <?php

                $query = "select * from User where username = '$current_user'";
                $query_run = mysqli_query($conn, $query);
                $row = mysqli_fetch_row($query_run);
                ?>
                <h1 class="w3-center"><?php echo "Welcome! ".$row[0]?></h1><br>
                <h3 align="left"><u>*Your basic information: </u></h3>
                <h5 align="left">Name: <?php echo $row[1] ?></h5>
                <!-- <h5 align="left">password: <?php echo $row[2] ?></h5> -->
                <h5 align="left">Email address: <?php echo $row[3] ?></h5>
                <h5 align="left">Preferred World Cuisine Type: <?php echo $row[4] ?></h5>
                <h3 align="left"><u>*Recipes you added before: </u></h3>
                    <?php
                    $query = "select * from Recipe where owner_username='$current_user' ";
                    $query_run = mysqli_query($conn, $query);
                    if(mysqli_num_rows($query_run) > 0)
                    {
                        while($row = mysqli_fetch_row($query_run))
                        {
                            echo "<h5><a href='recipe.php?epr=update&id=".$row[1]."'>".$row[0]."</a></h5>";
                        }
                    }
                    ?>

            </div>
        </form>

        <form method="post" action="allrecipes.php" class="login-form">


            <div class="w3-col m6 w3-padding-large" style="margin-top:8.5%;margin-bottom:0%;">
                <h3 align="left"><u>*Recipes you liked: </u></h3>

                <?php
                $query = "select * from Favorite,Recipe where Favorite.username='$current_user' and
                          Favorite.recipe_id = Recipe.Recipe_id";
                $query_run = mysqli_query($conn, $query);
                if(mysqli_num_rows($query_run) > 0)
                {
                    while($row = mysqli_fetch_row($query_run))
                    {
                        echo "<h5><a href='recipe.php?epr=update&id=".$row[1]."'>".$row[2]."</a></h5>";
                    }
                }
                ?>


                <h3 align="left"><u>*We can recommend some recipes to you based on the maximum calories intake you want</u></h3>
                <h5 align="left">Please enter your maximum intake of calories: </h5>
                <input id="maxCal" name="maxCal" type="text">
                <input name="maxCalrecommend" type="submit" value="Search" id="maxCalrecommend" class="btn">

            </div>
        </form>
    </div>

</div>

<hr>

<hr>

<!-- End page content -->
</div>


</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: linjy0419
 * Date: 4/10/17
 * Time: 9:37 PM
 */
session_start();
$current_user = $_SESSION["current_username"];
require 'config.php';
$remd = 0;
$tempsql = "CREATE VIEW lazy AS 
                select ViewHistory.username, 1 lazy
                from ViewHistory,Recipe
                where ViewHistory.recipe_id=Recipe.Recipe_id and (Recipe.Recipe_preptime+Recipe.Recipe_readytime)<70
                      and ViewHistory.time >= '2017-04-12 12:28:00'
                GROUP BY ViewHistory.username
                HAVING COUNT(*) >= 3";
$tempquery = mysqli_query($conn, $tempsql);
//echo '<script type="text/javascript"> alert("view ok") </script>';
$getusersql = "select * from lazy where lazy.username = '$current_user'";

$getuserquery = mysqli_query($conn, $getusersql);
//echo '<script type="text/javascript"> alert("user ok") </script>';
if(mysqli_num_rows($getuserquery) > 0){
    //echo '<script type="text/javascript"> alert("lazy section") </script>';
    $remd = 1;
    $tempsql2 = "select * from Recipe where (Recipe.Recipe_preptime+Recipe.Recipe_readytime)<70";
    $query_run2 = mysqli_query($conn, $tempsql2);

    $tempsql3 = "DROP VIEW lazy";
    if (mysqli_query($conn, $tempsql3)) {
        echo '<script type="text/javascript"> alert("drop view table successfully") </script>';
    } else {
        echo '<script type="text/javascript"> alert("Failed to drop view") </script>';
    }
}else{
    $sql = "SELECT Recipe.Recipe_cuisinetype FROM ViewHistory,Recipe 
        WHERE ViewHistory.recipe_id = Recipe.Recipe_id AND ViewHistory.username = '$current_user' 
             AND ViewHistory.time >= '2017-04-12 12:28:00'd
        GROUP BY Recipe.Recipe_cuisinetype 
        HAVING COUNT(*) >= ALL(SELECT COUNT(*) 
                               FROM ViewHistory, Recipe
                               WHERE ViewHistory.recipe_id = Recipe.Recipe_id 
                                     AND ViewHistory.username = '$current_user' 
                               GROUP BY Recipe.Recipe_cuisinetype)";
    $query_run1 = mysqli_query($conn, $sql);
    if ($query_run1) {
        $remd = 1;
        // echo '<script type="text/javascript"> alert("search remd recipe based on history successfully") </script>';
        if($row = mysqli_fetch_row($query_run1)){
            //echo '<script type="text/javascript"> alert("cuisinetyesection") </script>';
            $cuisineType = $row[0];
            $sql2 = "select * from Recipe where Recipe_cuisinetype = '$cuisineType'";
            $query_run2 = mysqli_query($conn, $sql2);
        }else {
            $sql2 = "select * from Recipe";
            $query_run2 = mysqli_query($conn, $sql2);
        }
    } else {
        echo '<script type="text/javascript"> alert("Failed to search remd recipe history.") </script>';

    }
    //drop view
    $tempsql3 = "DROP VIEW lazy";
    if (mysqli_query($conn, $tempsql3)) {
        echo '<script type="text/javascript"> alert("drop view table successfully") </script>';
    } else {
        echo '<script type="text/javascript"> alert("Failed to drop view") </script>';
    }

}



?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
    <meta charset="UTF-8">
    <title>NextGreatChef Homepage</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>

        h2{
            font-family: "Comic Sans MS";
        }

    </style>
</head>
<body>
<div class="header">
    <div>
        <a href="index.php"><img src="images/logo.png" alt="Logo" width="300" height="110"></a>
    </div>
    <form action="allrecipes.php" method="post" target="_blank">
        <input name="searchinfo" type="text" value="Entering keyword to search recipes" id="search">

        <input name="searchsth" type="submit" value="" id="searchbtn">
    </form>
</div>
<div class="body">
    <div>
        <div class="header">
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="login.php">Login</a>
                </li>
                <li>
                    <a href="myprofile.php">My Profile</a>
                </li>
                <li>
                    <a href="addrecipe.php">Add Recipe</a>
                </li>
                <li>
                    <a href="allrecipes.php">All Recipes</a>
                </li>
                <li>
                    <a href="recipe_map.php">Recipe Map</a>
                </li>
            </ul>
        </div>
        <div class="body">
            <div>
                <a href="allrecipes.php"><img src="images/desktop.png" alt="Image" width="710" height="430"></a>
            </div>
            <ul>
                <li class="current">
                    <a href="recipe.php?epr=update&id=10027"><img src="images/10027.png" alt="Image" width="60" height="60"></a>
                    <div>
                        <h2><a href="recipe.php?epr=update&id=10027">Tofu Ddukbokki</a></h2>
                        <p>
                            Popular Korean Snack
                            <?php echo $current_user ?>
                        </p>
                    </div>
                </li>
                <li>
                    <a href="recipe.php?epr=update&id=10028"><img src="images/10028.png" alt="Image" width="60" height="60"></a>
                    <div>
                        <h2><a href="recipe.php?epr=update&id=10028">Chicken Casserole</a></h2>
                        <p>
                            Signature Italian Dish
                        </p>
                    </div>
                </li>
                <li>
                    <a href="recipe.php?epr=update&id=10029"><img src="images/10029.png" alt="Image" width="60" height="60"></a>
                    <div>
                        <h2><a href="recipe.php?epr=update&id=10029">Tropical Classic Piazza</a></h2>
                        <p>
                            Yummy Italian Pizza
                        </p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div style="background-color:#eee;border: #a86417">
        <h3 align="left" style="font-family: 'Comic Sans MS';">*Here are some recipes you might be interested in: </h3>
        <?php
        if($remd == 0){
            $query = "select * from Recipe";
            $query_run = mysqli_query($conn, $query);
            if(mysqli_num_rows($query_run) > 0)
            {
                while($row = mysqli_fetch_row($query_run))
                {
                    echo "<h2 align='center'><a href='recipe.php?epr=update&id=".$row[1]."'>".$row[0]."</a></h2>";
                }
            }
        }else{
            $query_run = $query_run2;
            if(mysqli_num_rows($query_run) > 0)
            {
                while($row = mysqli_fetch_row($query_run))
                {
                    echo "<h2 align='center'><a href='recipe.php?epr=update&id=".$row[1]."'>".$row[0]."</a></h2>";
                }
            }
        }
        ?>
    </div>
</div>
</div>
<div class="footer">
    <div>
        <p>
            &copy; Copyright 2017. All rights reserved
        </p>
    </div>
</div>
</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: linjy0419
 * Date: 3/11/17
 * Time: 4:45 PM
 */
session_start();
$current_user = $_SESSION["current_username"];
require 'config.php';

$searchOn=0;
$searchIngred=0;
$remd = 0;

if(isset($_POST['searchsth'])){
    $searchOn = 1;
    $searchinfo=$_POST["searchinfo"];

    $sql = "select * from Make, Recipe where LOWER(ingredient_name) like LOWER('%$searchinfo%') AND
             Make.recipe_id = Recipe.Recipe_id";
    $query_run1 = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query_run1) > 0) {
        $searchIngred = 1;
        //echo '<script type="text/javascript"> alert("make search successfully") </script>';
        $searchResult = $query_run1;
    } else {
        //echo '<script type="text/javascript"> alert("Failed to get ingredinet.") </script>';
        $sql1 = "select * from Recipe where LOWER(Recipe_name) like LOWER('%$searchinfo%') 
            or LOWER(Recipe_cuisinetype) like LOWER('%$searchinfo%')
            or LOWER(Recipe_steps) like LOWER('%$searchinfo%')";
        $query_run1 = mysqli_query($conn, $sql1);
        if ($query_run1) {
            //echo '<script type="text/javascript"> alert("Record search successfully") </script>';
            $searchResult = $query_run1;
        } else {
            echo '<script type="text/javascript"> alert("Failed to search.") </script>';
        }
    }


    //$row = mysqli_fetch_row($query_run);
    //$recipe_id = $row[0];
}
if(isset($_POST['maxCalrecommend'])){
    $remd = 1;
    $maxCal = $_POST["maxCal"];
    $sql1 = "CREATE VIEW RecipeEachIngredient AS 
                select Make.recipe_id, Make.ingredient_name, (Ingredient.calories_per_gram * Make.quantity) eachTotal
                from Make,Ingredient
                where Make.ingredient_name = Ingredient.ingredient_name";

    $query_run1 = mysqli_query($conn, $sql1);
    if ($query_run1) {
        //echo '<script type="text/javascript"> alert("view table created successfully") </script>';
        $sql2 = "select * from Recipe where Recipe_id in
             (select recipe_id 
              from RecipeEachIngredient 
              group by recipe_id
              having sum(eachTotal) <= '$maxCal')";
        $query_run2 = mysqli_query($conn, $sql2);
        if ($query_run2) {
            //echo '<script type="text/javascript"> alert("search recipe with calories successfully") </script>';
            //store the result
            $searchResult = $query_run2;
            //drop the view
            $sql3 = "DROP VIEW RecipeEachIngredient";
            if (mysqli_query($conn, $sql3)) {
               // echo '<script type="text/javascript"> alert("drop view table successfully") </script>';
            } else {
                echo '<script type="text/javascript"> alert("Failed to drop view") </script>';
            }
        } else {
            echo '<script type="text/javascript"> alert("Failed to search recipe with cals") </script>';
        }
    } else {
        echo '<script type="text/javascript"> alert("Failed to create view.") </script>';
    }

}

?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
    <meta charset="UTF-8">
    <title>All Recipes</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="header">
    <div>
        <a href="index.php"><img src="images/logo.png" alt="Logo" width="300" height="110"></a>
    </div>
    <form action="allrecipes.php" method="post" target="_blank">
        <input name="searchinfo" type="text" value="Search from our 10,000+ Recipes around the world" id="search">

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
                    <a href="recipe_map_new.php">Favor'tMap</a>
                </li>
            </ul>
        </div>
        <div class="body">
            <div id="content">
                <div>
                    <ul>
                        <?php
                            if($searchOn == 1 || $remd == 1){
                                $temp_query  = $searchResult;
                            }else{
                                $query = "select * from Recipe";
                                $query_run = mysqli_query($conn, $query);
                                if(mysqli_num_rows($query_run) > 0)
                                {
                                    $temp_query = $query_run;
                                }
                            }

                            if($searchIngred == 0){
                              if(mysqli_num_rows($temp_query) > 0) {
                                  while ($row = mysqli_fetch_row($temp_query)) //while($row)
                                  {
                                      ?>

                                      <li>
                                          <?php
                                          echo "<a href='recipe.php?epr=update&id=" . $row[1] . "'><img src='images/" . $row[8] . "' alt='Image' width='130' height='135'></a>";
                                          ?>

                                          <div>
                                              <?php
                                              echo "<h3><a href='recipe.php?epr=update&id=" . $row[1] . "'>" . $row[0] . "</a></h3>";
                                              ?>
                                              <p>
                                                  <?php echo $row[6]; ?>
                                              </p>
                                          </div>
                                      </li>


                                      <?php
                                  }
                              }else{
                                  echo "<h3 style='text-align: center'>No recipes found.</h3>";
                              }
                            }else{
                                while($row = mysqli_fetch_row($temp_query))
                                //while($row)
                                {
                        ?>
                                    <li>
                                        <?php
                                        echo "<a href='recipe.php?epr=update&id=".$row[1]."'><img src='images/".$row[11]."' alt='Image' width='130' height='135'></a>";
                                        ?>

                                        <div>
                                            <?php
                                            echo "<h3><a href='recipe.php?epr=update&id=".$row[1]."'>".$row[3]."</a></h3>";
                                            ?>
                                            <p>

                                                <?php echo $row[9];?>

                                            </p>
                                        </div>
                                    </li>

                        <?php
                                }
                            }

                        ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="footer">
    <div>
        <p>

        </p>
    </div>
</div>
</body>
</html>
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
    $epr = '';
    $target_dir = "".$_SERVER['DOCUMENT_ROOT']."/images/";
    $target_file = "";

    if(isset($_GET['epr'])){
        $epr = $_GET['epr'];
    }
    if($epr == 'favor') {
        $recipe_id = $_GET['id'];
        if($current_user != -1 && (!empty($current_user))){
            $sql3 = "insert into Favorite (username, recipe_id) values
                                ('$current_user', '$recipe_id')";
            $query_run = mysqli_query($conn, $sql3);
            if ($query_run) {
                echo '<script type="text/javascript"> alert("Recipe added to your favorite list successfully!") </script>';
            } else {
                echo '<script type="text/javascript"> alert("This recipe is already in your favorite list!") </script>';
            }
        }else {
            echo '<script type="text/javascript"> alert("Please log in first before you add it to your favorite list!") </script>';
        }
    }
    if($epr == 'update')
    {
        $recipe_id = $_GET['id'];
        //add viewed history
        if($current_user != -1 && (!empty($current_user))){
            $sql3 = "insert into ViewHistory (username, recipe_id) values
                                ('$current_user', '$recipe_id')";
            $query_run = mysqli_query($conn, $sql3);
            if ($query_run) {
                //echo '<script type="text/javascript"> alert("New viewed history inserted successfully") </script>';
            } else {
                echo '<script type="text/javascript"> alert("Failed to insert record into history.") </script>';
            }
        }
    }
    if($epr == 'delete')
    {
        $recipe_id = $_GET['id'];
        //first try to delete the image
        $sql2 = "select image_name from Recipe where Recipe_id = '$recipe_id'";
        $query_run = mysqli_query($conn, $sql2);
        $rowinfo = mysqli_fetch_row($query_run);
        $target_file = $target_dir . $rowinfo[0];
        if(unlink($target_file)){
            //echo '<script type="text/javascript"> alert("image deleted successfully") </script>';

        }else{
            echo '<script type="text/javascript"> alert("fail to delete image.") </script>';
        }

        //now try to delete recipe in database
        $sql = "delete from Recipe where Recipe_id='$recipe_id'";

        if (mysqli_query($conn, $sql)) {
            //echo '<script type="text/javascript"> alert("Record deleted successfully") </script>';

        } else {
            echo '<script type="text/javascript"> alert("Failed to delete.") </script>';
        }
    }


?>
<!DOCTYPE html>
<html>
<title>Recipe Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<style>
body {font-family: "Times New Roman", Georgia, Serif;}
h1,h2,h3,h4,h5,h6 {
    font-family: "Playfair Display";
    letter-spacing: 5px;
}
a:link {
    color: indianred;

}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
table#t01 {
    width: 100%;
    background-color: #f1f1c1;
}
</style>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding-8 w3-card-2">
    <a href="#home" class="w3-bar-item w3-button w3-margin-left">Recipe Page</a>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="index.php" class="w3-bar-item w3-button">Home</a>
      <a href="allrecipes.php" class="w3-bar-item w3-button">All Recipes</a>
      <a href="login.php" class="w3-bar-item w3-button w3-margin-right">Login</a>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="w3-content" style="max-width:1100px">

  <!-- About Section -->
  <div class="w3-row w3-padding-64" id="about">
      <form method="post" action="recipe.php" class="login-form">
    <div class="w3-col m6 w3-padding-large w3-hide-small">
        <?php
        $query = "select * from Recipe where Recipe_id = '$recipe_id'";
        $query_run = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($query_run);
           // echo "<img src='images/".$recipe_id.".png' alt='Image' width='500' height='600'>";
        echo "<img src='images/".$row[8]."' alt='Image' width='500' height='600'>";

        //get ingredients from Make table
        $query2 = "select * from Make where recipe_id = '$recipe_id'";
        $query_run2 = mysqli_query($conn, $query2);

        ?>
        <h5 align="left">Ingredients: </h5>
        <table id="t01">
            <tr>
                <th>Ingredient</th>
                <th>Quantity(g)</th>
            </tr>
            <?php
            while($row2 = mysqli_fetch_row($query_run2)){
                echo "<tr>";
                echo "<td>".$row2[0]."</td>";
                echo "<td>".$row2[2]."</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <div class="w3-col m6 w3-padding-large">

      <h1 class="w3-center"><?php echo $row[0]?></h1><br>
      <h5 align="left">Recipe ID: <?php echo $row[1] ?></h5>
        <h5 align="left">Recipe created by: <?php echo $row[7] ?></h5>
      <h5 align="left">Cuisine Type: <?php echo $row[2] ?></h5>
      <h5 align="left">Preparation Time(minutes): <?php echo $row[3] ?></h5>
      <h5 align="left">Ready Time(minutes): <?php echo $row[4] ?></h5>
      <h5 align="left">Steps:</h5>
        <h5 align="left"><?php echo $row[6] ?></h5>
      <p class="w3-large"> </p>
        <div class="row">
            <?php
                echo "<a style='margin-left: 65%;font-size: 18px;' href='recipe.php?epr=favor&id=".$row[1]."'>*Add to Favorite*</a>";

            ?>
        </div>
        <div class="row">
                <?php
                if($current_user == $row[7]){
                    echo "<a style='margin-left: 80%;font-size: 20px;' href='recipe.php?epr=delete&id=".$row[1]."'>Delete</a>";
                }
                ?>
        </div>
        <div class="row">
                <?php
                if($current_user == $row[7]){
                    echo "<a style='margin-left: 80%;font-size: 20px;' href='updateRecipe.php?epr=update&id=".$row[1]."'>Update</a>";
                }
                ?>
        </div>
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


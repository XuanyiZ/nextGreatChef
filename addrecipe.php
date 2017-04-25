<?php
/**
 * Created by PhpStorm.
 * User: linjy0419
 * Date: 3/11/17
 * Time: 10:50 AM
 */
session_start();
$current_user = $_SESSION["current_username"];
require 'config.php';

$target_dir = "".$_SERVER['DOCUMENT_ROOT']."/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//echo "targetdir is".$target_dir. ".";
//echo "targetfile is".$target_file. ".";
//echo "imagetype is".$imageFileType. ".";
$repID = -1;
$ingred_name = "";
$quant = "";

if(isset($_POST['add_button']))
{
    //TRY TO UPLOAD IMAGE FIRST
    //
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "YOU NEED TO CHOOSE AN IMAGE TO UPLOAD!";
        $uploadOk = 0;
    }
    //echo "targetdir is".$target_dir. ".";
    //echo "targetfile is".$target_file. ".";
    //echo "imagetype is".$imageFileType. ".";
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            //AFTER SUCCESSFULLY UPLOADING IMAGE
            //Try to add information to database
            $RecipeName = $_POST['RecipeName'];
            $CuisineType = $_POST['CuisineType'];
            $PreparationTime= $_POST['PreparationTime'];
            $ReadyTime = $_POST['ReadyTime'];
            //$Calories = $_POST['Calories'];
            $CookingSteps = $_POST['CookingSteps'];
            $image_name = basename($_FILES["fileToUpload"]["name"]);
            $sql = "insert into Recipe (Recipe_name, Recipe_cuisinetype, Recipe_preptime, Recipe_readytime,
                                Recipe_steps, owner_username, image_name) values
                                ('$RecipeName', '$CuisineType', '$PreparationTime', 
                                '$ReadyTime', '$CookingSteps', '$current_user', '$image_name')";

            if (mysqli_query($conn, $sql)) {
                echo '<script type="text/javascript"> alert("New record added successfully") </script>';
                //Ingredients Example: potato,20;tomamto,10;
                $query = "select Recipe_id from Recipe where Recipe_name = '$RecipeName'";
                $query_run = mysqli_query($conn, $query);
                $query_row = mysqli_fetch_row($query_run); // query_row[0] = recipeid
                $repID = $query_row[0];
                $Ingredients = $_POST['Ingredients'];
                $myArray = explode(';', $Ingredients);

                foreach($myArray as $item){
                    $row = explode(',',$item);
                    $ingred_name = $row[0];
                    $quant = $row[1];
                    $sql2 = "insert into Make (ingredient_name, recipe_id, quantity) values 
                             ('$ingred_name', '$repID', '$quant')";
                    if (mysqli_query($conn, $sql2)) {
                        echo '<script type="text/javascript"> alert("New make record added successfully") </script>';
                    }else{
                        echo '<script type="text/javascript"> alert("Fail to add new record.") </script>';
                        //echo "sql".$repID;
                        //echo "trow1is:".$ingred_name;
                        //echo "trow2is:".$quant;
                    }

                }
            } else {
                echo '<script type="text/javascript"> alert("Fail to add new record.") </script>';
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Recipe Page</title>
    <!-- CORE CSS-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">

    <style type="text/css">
        html,
        body {
            background: url(images/bg-body.jpg) repeat;
            height: 100%;
        }
        html {
            display: table;
            margin: auto;
        }
        body {
            display: table-cell;
            vertical-align: middle;
        }
        .margin {
            margin: 0 !important;
        }
    </style>

</head>

<body class="blue">


<div id="login-page" class="row">
    <div class="col s12 z-depth-6 card-panel">
        <form method="post" action="addrecipe.php" class="login-form" enctype="multipart/form-data">
            <div class="row margin">
                <h5 style="text-align: center;">Create Your Own Recipe Here</h5>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-social-person-outline prefix"></i>
                    <input id="RecipeName" name="RecipeName" type="text" class="validate">
                    <label for="RecipeName" class="center-align">*RecipeName</label>
                </div>
            </div>

            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-action-lock-outline prefix"></i>
                    <input id="CuisineType" name="CuisineType" type="text" class="validate">
                    <label for="CuisineType">*CuisineType</label>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-action-lock-outline prefix"></i>
                    <input id="PreparationTime" name="PreparationTime" type="text" class="validate">
                    <label for="PreparationTime">*PreparationTime</label>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-social-person-outline prefix"></i>
                    <input id="ReadyTime" name="ReadyTime" type="text" class="validate">
                    <label for="ReadyTime">*ReadyTime</label>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-social-person-outline prefix"></i>
                    <input id="Ingredients" name="Ingredients" type="text" class="validate">
                    <label for="Ingredients">*Ingredients(Please use the format:"potato,20;tofu,10"[quantity based on grams]</label>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-social-person-outline prefix"></i>
                    <input id="CookingSteps" name="CookingSteps" type="text" class="validate">
                    <label for="CookingSteps">*CookingSteps</label>
                </div>
            </div>

            <div class="row margin">
               <!-- <p class="margin center medium-small sign-up">Select image to upload:</p> -->
                <h5 align="left"> Select your recipe image to upload: </h5>
                <input type="file" name="fileToUpload" id="fileToUpload">
                    <!-- <input type="submit" value="Upload Image" name="submit">-->
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input name="add_button" type="submit" value="Add Recipe" class="btn" style="margin-left:auto;margin-right:auto;display:block;margin-top:0%;margin-bottom:0%;">
                </div>
                <div class="input-field col s12">
                    <p class="margin center medium-small sign-up">Please fill out as many columns as you can.</p>
                </div>
                <div class="input-field col s12">
                    <p class="margin center medium-small sign-up"><a href="index.php">Back to Homepage</a></p>
                </div>
            </div>
        </form>


    </div>
</div>



<!-- ================================================
  Scripts
  ================================================ -->

<!-- jQuery Library -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!--materialize js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>



<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-27820211-3', 'auto');
    ga('send', 'pageview');

</script><script src="//load.sumome.com/" data-sumo-site-id="1cf2c3d548b156a57050bff06ee37284c67d0884b086bebd8e957ca1c34e99a1" async="async"></script>


<footer >
    <p align="center"> </p>
</footer>
</body>

</html>
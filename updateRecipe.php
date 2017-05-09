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
    $epr = '';
    $id= '';
    $oldIngList = "";
    $target_dir = "".$_SERVER['DOCUMENT_ROOT']."/images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $curr_image_name = "";
    //echo 'id is'.$id;
    if(isset($_GET['epr'])){
        $epr = $_GET['epr'];
    }
    if($epr == 'update')
    {
        $id = $_GET['id'];
    }
    if(isset($_POST['update_button']))
    {
        $id = $_POST['idname'];
        //if choose to modify the image: delete the old image first and then upload the new image
        if($curr_image_name != basename($_FILES["fileToUpload"]["name"])){
            //try uploading new image
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "YOU NEED TO CHOOSE AN IMAGE TO UPLOAD!";
                $uploadOk = 0;
            }

            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

        }
        if($uploadOk == 1){
            //without new image uploaded
            if($target_dir == $target_file){
                //Update the Recipe Table first
                $RecipeName = $_POST['RecipeName'];
                $CuisineType = $_POST['CuisineType'];
                $PreparationTime= $_POST['PreparationTime'];
                $ReadyTime = $_POST['ReadyTime'];
                $Ingredients = $_POST['Ingredients'];
                $CookingSteps = $_POST['CookingSteps'];
                $sql = "update Recipe set Recipe_name='$RecipeName', Recipe_cuisinetype='$CuisineType',
               Recipe_preptime='$PreparationTime', Recipe_readytime='$ReadyTime', Recipe_steps='$CookingSteps'
               where Recipe_id='$id'";
                if (mysqli_query($conn, $sql)) {
                    //echo '<script type="text/javascript"> alert("Record updated successfully") </script>';
                } else {
                    echo '<script type="text/javascript"> alert("Fail to update record.") </script>';
                    //echo "Error updating record: " . mysqli_error($conn);
                }
                //Update the Make Table
                //delete all old ingredients in Make table
                    $sql2 = "delete from Make where recipe_id='$id'";
                    if (mysqli_query($conn, $sql2)) {
                        //echo '<script type="text/javascript"> alert("delte ings first successfully") </script>';
                    }else{
                        echo '<script type="text/javascript"> alert("Failed to delete ings first.") </script>';
                    }
                //insert new ingredients in Make Tale
                $myArray = explode(';', $Ingredients);
                foreach($myArray as $item){
                    $row = explode(',',$item);
                    $ingred_name = $row[0];
                    $quant = $row[1];
                    if($ingred_name != "" && $quant != "" && !empty($ingred_name) && !empty($quant)){
                        $sql2 = "insert into Make (ingredient_name, recipe_id, quantity) values 
                             ('$ingred_name', '$id', '$quant')";
                        if (mysqli_query($conn, $sql2)) {
                            //echo '<script type="text/javascript"> alert("New make record added successfully") </script>';
                        }else{
                            echo '<script type="text/javascript"> alert("Fail to add new record.") </script>';
                        }
                    }
                }

            }else{
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    echo '<script type="text/javascript"> alert("add new image successfully") </script>';
                    //
                    //AFTER SUCCESSFULLY UPLOADING IMAGE
                    //delete the old image
                    $sql2 = "select image_name from Recipe where Recipe_id = '$id'";
                    $query_run = mysqli_query($conn, $sql2);
                    $rowinfo = mysqli_fetch_row($query_run);
                    $img_delete = $target_dir . $rowinfo[0];
                    if(unlink($img_delete)){
                        //echo '<script type="text/javascript"> alert("image deleted successfully") </script>';

                    }else{
                        echo '<script type="text/javascript"> alert("fail to delete image.") </script>';
                    }
                    //Try to update new information to database
                    $curr_image_name = basename($_FILES["fileToUpload"]["name"]);
                    $RecipeName = $_POST['RecipeName'];
                    $CuisineType = $_POST['CuisineType'];
                    $PreparationTime= $_POST['PreparationTime'];
                    $ReadyTime = $_POST['ReadyTime'];
                    $Ingredients = $_POST['Ingredients'];
                    $CookingSteps = $_POST['CookingSteps'];
                    $sql = "update Recipe set Recipe_name='$RecipeName', Recipe_cuisinetype='$CuisineType',
               Recipe_preptime='$PreparationTime', Recipe_readytime='$ReadyTime',
               Recipe_steps='$CookingSteps', image_name='$curr_image_name'
               where Recipe_id='$id'";
                    //Update the Recipe table first
                    if (mysqli_query($conn, $sql)) {
                        //echo '<script type="text/javascript"> alert("Record updated successfully") </script>';
                    } else {
                        echo '<script type="text/javascript"> alert("Fail to update record.") </script>';
                        //echo "Error updating record: " . mysqli_error($conn);
                    }
                    //Update the Make Table
                    //delete all old ingredients in Make table
                    $sql2 = "delete from Make where recipe_id='$id'";
                    if (mysqli_query($conn, $sql2)) {
                        //echo '<script type="text/javascript"> alert("delte ings first successfully") </script>';
                    }else{
                        echo '<script type="text/javascript"> alert("Failed to delete ings first.") </script>';
                    }
                    //insert new ingredients in Make Tale
                    $myArray = explode(';', $Ingredients);
                    foreach($myArray as $item){
                        $row = explode(',',$item);
                        $ingred_name = $row[0];
                        $quant = $row[1];
                        if($ingred_name != "" && $quant != "" && !empty($ingred_name) && !empty($quant)){
                            $sql2 = "insert into Make (ingredient_name, recipe_id, quantity) values 
                             ('$ingred_name', '$id', '$quant')";
                            if (mysqli_query($conn, $sql2)) {
                                //echo '<script type="text/javascript"> alert("New make record added successfully") </script>';
                            }else{
                                echo '<script type="text/javascript"> alert("Fail to add new record.") </script>';
                            }
                        }
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    //echo "target file is".$target_file;
                    //echo "target dir is".$target_dir;
                }
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
    <title>Update Recipe
        Page</title>
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
        <form method="post" action="updateRecipe.php" class="login-form" enctype="multipart/form-data">
            <div class="row margin">
                <?php
                    $query = "select * from Recipe where Recipe_id = '$id'";
                    $query_run = mysqli_query($conn, $query);
                    $row = mysqli_fetch_row($query_run);
                ?>
                <h5 style="text-align: center;">Update Your Recipe Here</h5>

            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-social-person-outline prefix"></i>
                    <input id="RecipeName" name="RecipeName" type="text" class="validate" value="<?php echo $row[0]; ?>">
                    <label for="RecipeName" class="center-align">*RecipeName</label>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-action-lock-outline prefix"></i>
                    <input id="CuisineType" name="CuisineType" type="text" class="validate" value="<?php echo $row[2]; ?>">
                    <label for="CuisineType">*CuisineType</label>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-action-lock-outline prefix"></i>
                    <input id="PreparationTime" name="PreparationTime" type="text" class="validate" value="<?php echo $row[3]; ?>">
                    <label for="PreparationTime">*PreparationTime</label>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-social-person-outline prefix"></i>
                    <input id="ReadyTime" name="ReadyTime" type="text" class="validate" value="<?php echo $row[4]; ?>">
                    <label for="ReadyTime">*ReadyTime</label>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-social-person-outline prefix"></i>
                    <?php
                        $query2 = "select * from Make where Recipe_id = '$id'";
                        $query_run2 = mysqli_query($conn, $query2);
                        while($temprow = mysqli_fetch_row($query_run2)){
                            $oldIngList = $oldIngList.$temprow[0].",".$temprow[2].";";
                        }
                    ?>
                    <input id="Ingredients" name="Ingredients" type="text" class="validate" value="<?php echo $oldIngList; ?>">
                    <label for="Ingredients">*Ingredients(format example:potato,20;tomato,20;)[quantity based on grams]</label>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-social-person-outline prefix"></i>
                    <input id="CookingSteps" name="CookingSteps" type="text" class="validate" value="<?php echo $row[6]; ?>">
                    <label for="CookingSteps">*CookingSteps</label>
                </div>
            </div>

            <div class="row margin">
                <!-- <p class="margin center medium-small sign-up">Select image to upload:</p> -->
                <h5 align="left"> Select the new image you want to replace: <?php echo $row[8]; ?></h5>
                <?php $curr_image_name = $row[8] ?>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <!-- <input type="submit" value="Upload Image" name="submit">-->
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" name="idname" value="<?php echo $id ?>">
                    <input name="update_button" type="submit" value="Update Recipe" class="btn" style="margin-left:auto;margin-right:auto;display:block;margin-top:0%;margin-bottom:0%;"></a>

                </div>
                <div class="input-field col s12">
                    <p class="margin center medium-small sign-up">Please edit the field you want to modify.</p>
                </div>
                <div class="input-field col s12">
                    <p style="color:dodgerblue;text-align:center;"><a href="index.php">Back to Homepage</a></p>
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
    <p align="center"></p>
</footer>
</body>

</html>
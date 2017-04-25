<?php
/**
 * Created by PhpStorm.
 * User: linjy0419
 * Date: 3/11/17
 * Time: 12:11 PM
 */
//include('recipe.php');
$servername = "webhost.engr.illinois.edu";
$username = "nextgreatchef_jlin73";
$password = "55950329";
//$username = "";
//$password = "";
$database = "nextgreatchef_CS411";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//mysqli_select_db($database);
//echo "Connected successfully";

?>
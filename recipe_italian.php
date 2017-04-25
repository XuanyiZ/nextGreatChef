<?php
/**
 * Created by PhpStorm.
 * User: linjy0419
 * Date: 3/11/17
 * Time: 4:45 PM
 */
require 'config.php';


?> 


<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
    background-color: #FFFACD;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
    background-color: #FFFACD;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
    session_start();
    $current_user = $_SESSION["current_username"];
    require 'config.php';

    $sql="SELECT * FROM Recipe WHERE Recipe_cuisinetype = 'Italian'";
    $result = mysqli_query($conn,$sql);

    echo "<table>
    <tr>
    <th>Recipe Name</th>
    <th>Images</th>
    </tr>";

    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . "<h3><a href='recipe.php?epr=update&id=".$row[1]."'>".$row[0]."</a></h3>" . "</td>"; 
        echo "<td>" . "<img src='images/".$row[8]."' alt='Image' width='200' height='155' >" . "</td>"; 
        echo "</tr>";
    }

    echo "</table>";
?>

</body>
</html>
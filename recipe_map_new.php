<?php
session_start();
$current_user = $_SESSION["current_username"];
require 'config.php';
//echo "<script type='text/javascript'> alert('ddsd') </script>";
//prepare xml file
// Select all the rows in the Favorite table
$query = "SELECT Recipe.Recipe_id, Recipe.Recipe_name, Recipe.Recipe_cuisinetype 
                              FROM Favorite,Recipe 
                              WHERE Favorite.username = '$current_user' and Favorite.recipe_id=Recipe.Recipe_id";
$result = mysqli_query($conn, $query);
if ($result) {
    echo '<script type="text/javascript"> alert("xml data found successfully") </script>';
} else {
    echo '<script type="text/javascript"> alert("Failed to xml data view") </script>';
}
if (mysqli_num_rows($result) > 0) {
    //echo "<script type='text/javascript'> alert('xml file 1!') </script>";
    //echo "has rows";
    header('Content-type: text/xml');
    $writer = new XMLWriter();

    $writer->openMemory();
    $writer->setIndent(true);
    $writer->startDocument();
    $writer->startElement('results');
    // Start XML file, echo parent node
    //echo "<script type='text/javascript'> alert('xml file2') </script>";
    while($row = mysqli_fetch_row($result)){
        // Add to XML document node
        $writer->startElement('favorite');

        $writer->writeElement("recipe_id", $row[0]);
        $writer->writeElement("recipe_name", $row[1]);
        $writer->writeElement("recipe_cuisinetype", $row[2]);

        $writer->endElement();

    }
    $writer->endElement();
    // End XML file
    $writer->endDocument();
    //this will overwrite the xml file
    file_put_contents('favorInfo.xml', $writer->flush(true));
    //$writer->flush();

     //echo "<script type='text/javascript'> alert('xml file created!') </script>";
}

?>

<!DOCTYPE html>
<html>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, td, th {
        border: 1px solid black;
        padding: 5px;
    }

    th {text-align: left;}
</style>

<body>

<h1 style="font-family: 'Comic Sans MS';margin-left: 25%">Favorite Recipe Map</h1>

<div id="map" style="width:1100px;height:690px;background:yellow"></div>

<script>
     // according to the official Google Map tutorial on Google's website
    function downloadUrl(url,callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                //request.onreadystatechange = doNothing;
                callback(request, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }


    function myMap() {
        var mapCanvas = document.getElementById("map");
        var mapOptions = {
            center: new google.maps.LatLng(28, 2), zoom: 2
        };
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var geoDict = {};
        //American
        geoDict["American"] = {lat:37.09, lng:-95.71};
        //Chinese
        geoDict["Chinese"] = {lat:40, lng:116.5};
        //Japanese
        geoDict["Japanese"] = {lat:35.7, lng:139.69};
        //Italian
        geoDict["Italian"] = {lat:41.87, lng:12.57};
        //Mexican
        geoDict["Mexican"] = {lat:23.63, lng:-102.55};
        //Indian
        geoDict["Indian"] = {lat: 20.59, lng:78.96};
        //Korean
        geoDict["Korean"] = {lat:35.90, lng:127.76};
        //Vietnam
        geoDict["Vietnam"] = {lat:14.05, lng:108.27};
        //Brazil
        geoDict["Brazil"] = {lat:-14.23, lng:-51.92};
        //Argentina
        geoDict["Argentina"] = {lat:-38.42, lng:-63.62};
        //Canada
        geoDict["Canada"] = {lat:56.13, lng:-106.35};
        //Russia
        geoDict["Russia"] = {lat:61.52, lng:105.32};
        //UK
        geoDict["UK"] = {lat:55.38, lng:-3.44};
        //Australia
        geoDict["Australia"] = {lat:-25.28, lng:133.78};
        //Africa
        geoDict["Africa"]= {lat:-4.04, lng:21.76};
        console.log("get here after geo");
        downloadUrl('favorInfo.xml', function(data) {
            var xml = data.responseXML;
            var result1 = xml.getElementsByTagName('recipe_id');
            var result2 = xml.getElementsByTagName('recipe_name');
            var result3 = xml.getElementsByTagName('recipe_cuisinetype');
            //console.log(result1.length);
            var i,cuisinetype,rid, name;
            var strs = Array(15).fill("");
            for (i=0;i<result1.length;i++){
                rid = result1[i].childNodes[0].nodeValue;
                name = result2[i].childNodes[0].nodeValue;
                cuisinetype = result3[i].childNodes[0].nodeValue;
                if(cuisinetype == "American"){
                    strs[0] = strs[0] + "<a href='recipe.php?epr=update&id="+rid+"'>"+ name + "</a></br>";
                }else if(cuisinetype == "Chinese"){
                    strs[1] = strs[1] + "<a href='recipe.php?epr=update&id="+rid+"'>"+ name + "</a></br>";
                }else if(cuisinetype == "Japanese"){
                    strs[2] = strs[2] + "<a href='recipe.php?epr=update&id="+rid+"'>"+ name + "</a></br>";
                }else if(cuisinetype == "Italian"){
                    strs[3] = strs[3] + "<a href='recipe.php?epr=update&id="+rid+"'>"+ name + "</a></br>";
                }else if(cuisinetype == "Mexican"){
                    strs[4] = strs[4] + "<a href='recipe.php?epr=update&id="+rid+"'>"+ name + "</a></br>";
                }else if(cuisinetype == "Indian"){
                    strs[5] = strs[5] + "<a href='recipe.php?epr=update&id="+rid+"'>"+ name + "</a></br>";
                }else if(cuisinetype == "Korean"){
                    strs[6] = strs[6] + "<a href='recipe.php?epr=update&id="+rid+"'>"+ name + "</a></br>";
                }else if(cuisinetype == "Vietnam"){
                    strs[7] = strs[7] + "<a href='recipe.php?epr=update&id="+rid+"'>"+ name + "</a></br>";
                }else if(cuisinetype == "Brazilian"){
                    strs[8] = strs[8] + "<a href='recipe.php?epr=update&id="+rid+"'>"+ name + "</a></br>";
                }else if(cuisinetype == "Argentinian"){
                    strs[9] = strs[9] + "<a href='recipe.php?epr=update&id="+rid+"'>"+ name + "</a></br>";
                }else if(cuisinetype == "Canadian"){
                    strs[10] = strs[10] + "<a href='recipe.php?epr=update&id="+rid+"'>"+ name + "</a></br>";
                }else if(cuisinetype == "Russian"){
                    strs[11] = strs[11] + "<a href='recipe.php?epr=update&id="+rid+"'>"+ name + "</a></br>";
                }else if(cuisinetype == "UK"){
                    strs[12] = strs[12] + "<a href='recipe.php?epr=update&id="+rid+"'>"+ name + "</a></br>";
                }else if(cuisinetype == "Australian"){
                    strs[13] = strs[13] + "<a href='recipe.php?epr=update&id="+rid+"'>"+ name + "</a></br>";
                }else{// if(cuisinetype == "African")
                    strs[14] = strs[14] + "<a href='recipe.php?epr=update&id="+rid+"'>"+ name + "</a></br>";
                }

                //console.log(strs);
            }
            //add marker
            var infowindow = new google.maps.InfoWindow();

            var marker,temp_content,imagePath;
            var i=0;

            for (var item in geoDict) {
                temp_content = strs[i];
                imagePath = "images/" + item.toLowerCase() + ".png";
                marker = new google.maps.Marker({
                    position: geoDict[item],
                    icon: imagePath,
                    map: map
                });

                console.log("setinfowindow");
                infowindow.setContent(temp_content);
                console.log(temp_content);

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        console.log("setinfowindow");
                        infowindow.setContent(strs[i]);
                        console.log(strs[i]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));

                i++;
            }

        });

    }

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVnUzYcMoWpPGNxhg4goRfGvTPAETY8Gg&callback=myMap"></script>


<a href="https://icons8.com">Icon pack by Icons8</a>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

</body>
</html>

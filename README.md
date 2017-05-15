# nextGreatChef
nextGreatChef is a recipe sharer website that helps our user to learn and share different recipes from all over the world. The website allows users to search recipes based on keywords and ingredients in our database. After users logging in, they can add, update and delete their own recipes. They can also add and update their recipes’s images. Users will also get recommendations for recipes created by other users based on their personal preference and their view history. In addition, users can mark any of the recipes they viewed to be “favorite”, and they can view their “favorite” recipes in their personal profile as well as on a Google Map API. Additionally, users can also view recipes based on their origin (American, Italian, etc) in our recipe map, which gives users a visual representation of recipes all around the world.
# Databases and Software Platforms/Languages
Server: CPanel
Database: MySQL
Server Side: PHP
Client Side: HTML, CSS, PHP, Javascript
# Here are two advanced functions used in the website:
# RECOMMENDATION
Our recommendation functionality has two parts:
Recipes recommendation based on the maximum intake of calories user accepts
Recipes recommendation based on the view history of the user
First part of recommendation functionality is that if user input maximum intake of calories he/she accepts, we filter out a list of recipes that satisfy the user's need. When users create their recipes, they do not know how many calories of their recipe has and so we need to first join the table MAKE and INGREDIENT and create a VIEW so that it contains the ingredient name and the total calories of that ingredient in the recipe based on quantity user entered before. After that we will sum up all ingredients of each recipe and find out what recipes have total calories smaller than the maximum intake of calories user accepts and return those recipes to the user.
Second part of the recommendation functionality is that we promote some recipes to users based on their browsing history within a certain time period. This functionality is done by join table VIEWHISTORY and RECIPE and then we filter out the rows which is current user's browsing history and the time of the history should not before two weeks ago. We use the classification algorithm of data mining to recommend recipes to users. First we will create a VIEW contains users who are lazy recently and check if the current user is in this list; if the user is lazy recently, we will recommend some recipes that take shorter time to the user. If the user is not lazy, we will join the VIEWHISTORY and Recipe table to get count the total frequency of a recipe based on recipe's cuisine type and find the most frequent cuisine type that user viewed; therefore, we use this information to promote those recipes has the same cuisine type to the current user.
# DATA VISUALIZATION
The second advanced functionality we implemented is the favorite recipe map. On our website, there's a page called FAVORITEMAP. After users add some recipes to their favorite list, they can view their favorite recipes on the Google Map. The map we created contains several icons for different country. If you click one of the icons, an information window will show up and you can view a list of recipes in your favorite list and belong to that country. Each recipe name contains a link; thus if you click on a recipe name, the website can also direct you to the single recipe page that has more specific information of that recipe. The FAVORITEMAP is considered advanced functionality because users can view the recipes they liked before based on nations on a map and we need to prepare the recipes's information before we generate the map. Each information window of the icons on the map has to contain different list of recipes based on user's favorite list. Also, if the user updates their favorite list. The updates will also be reflected on the Google Map.

-- MySQL dump 10.15  Distrib 10.0.30-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: nextgreatchef_CS411
-- ------------------------------------------------------
-- Server version	10.0.30-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Favorite`
--

DROP TABLE IF EXISTS `Favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Favorite` (
  `username` varchar(200) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  PRIMARY KEY (`username`,`recipe_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Favorite`
--

LOCK TABLES `Favorite` WRITE;
/*!40000 ALTER TABLE `Favorite` DISABLE KEYS */;
INSERT INTO `Favorite` (`username`, `recipe_id`) VALUES ('nicole1',10001),('nicole1',10003),('nicole1',10007),('nicole1',10011),('nicole1',10012),('nicole111',10002),('nicole111',10003),('nicole111',10005),('nicole111',10007),('nicole111',10010),('nicole2',10010),('nicole2',10013),('nicole8',10002),('nicole9',10001);
/*!40000 ALTER TABLE `Favorite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ingredient`
--

DROP TABLE IF EXISTS `Ingredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ingredient` (
  `ingredient_name` varchar(20) NOT NULL,
  `calories_per_gram` float NOT NULL,
  PRIMARY KEY (`ingredient_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ingredient`
--

LOCK TABLES `Ingredient` WRITE;
/*!40000 ALTER TABLE `Ingredient` DISABLE KEYS */;
INSERT INTO `Ingredient` (`ingredient_name`, `calories_per_gram`) VALUES ('cucumber',0.15),('salmon',2.4),('potato',1.09),('green pepper',0.3),('red pepper',0.3),('celery',0.14),('cauliflower',0.25),('carrot',0.6),('onion',0.4),('beef',3.13),('chicken',1.1),('vinegar',0.26),('flour',3.81),('egg',1.47),('sugar',3.87),('milk',0.6),('salt',0),('garlic',1.49),('rice',1.29),('tomato',0.18),('chili powder',2.8),('bean',0.8),('corn',0.86),('cilantro',0.23),('cumin',3.75),('black pepper',2.55),('oil',9),('mushroom',0.18),('ginger',0.8),('sour cream',1.8),('tofu',0.72),('soy sauce',0.1),('panko crumb',3.3),('avocado',1.6),('water',0),('sesame oil',8.84),('noodle',1.37),('green onion',0.27),('broccoli',0.3),('hoisin sauce',1.2),('cheese',4),('sausage',4),('hash brown',3),('fish',1.2),('jalapeno',0.2),('cinnamon',0.1),('raisins',2.99),('ketchup',0.97),('sake',1),('shrimp',1.06),('curry paste',1.24),('bamboo shoots',0.2),('coconut milk',1.97),('pork',1.2),('cornstarch',3.81),('baking powder',1.25),('canola oil',8.84),('yeast ',2.95),('vegetable oil',1.2),('red chili paste',3.33),('saffron',3),('olive oil',9),('lime juice ',0.248);
/*!40000 ALTER TABLE `Ingredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Make`
--

DROP TABLE IF EXISTS `Make`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Make` (
  `ingredient_name` varchar(200) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `quantity` varchar(200) NOT NULL,
  PRIMARY KEY (`ingredient_name`,`recipe_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Make`
--

LOCK TABLES `Make` WRITE;
/*!40000 ALTER TABLE `Make` DISABLE KEYS */;
INSERT INTO `Make` (`ingredient_name`, `recipe_id`, `quantity`) VALUES ('soy sauce',10051,'10'),('tomato',10051,'30'),('salmon',10051,'100'),('green pepper',10001,'200'),('red pepper',10001,'100'),('jalapeno',10001,'50'),('celery',10001,'150'),('carrot',10001,'150'),('onion',10001,'50'),('chicken',10010,'100'),('salt',10010,'5'),('egg',10010,'20'),('panko crumbs',10010,'10'),('black pepper',10010,'5'),('oil',10010,'10'),('flour',10010,'5'),('cauliflower',10001,'2'),('garlic',10001,'4'),('olive',10001,'6'),('vinegar',10001,'5'),('avocado',10011,'50'),('chicken',10011,'100'),('onion',10011,'50'),('cilantro',10011,'10'),('vinegar',10011,'5'),('water',10001,'400'),('salt',10001,'8'),('tofu',10012,'200'),('soy sauce',10012,'10'),('sugar',10012,'10'),('water',10012,'10'),('green onion',10012,'10'),('ginger',10012,'8'),('red pepper',10002,'70'),('green pepper',10002,'100'),('jalapeno',10002,'50'),('green onion',10013,'10'),('soy sauce',10013,'10'),('sugar',10013,'5'),('garlic',10013,'5'),('beef',10013,'150'),('ginger',10013,'5'),('black pepper',10013,'10'),('beef',10002,'1000'),('onion',10002,'100'),('salt',10002,'15'),('noodle',10014,'100'),('soy sauce',10014,'10'),('water',10014,'30'),('oil',10014,'15'),('black pepper ',10002,'100'),('soy sauce',10003,'10'),('sesame oil',10003,'10'),('sugar',10015,'5'),('beef',10015,'100'),('cinnamon',10015,'10'),('salt',10015,'5'),('green onion',10015,'10'),('oil',10015,'8'),('flour',10003,'20'),('cornstarch',10003,'40'),('water',10003,'30'),('baking powder',10003,'20'),('canola oil',10003,'20'),('salt',10016,'5'),('soy sauce',10016,'5'),('broccoli',10016,'80'),('sesame oil',10016,'10'),('hoisin sauce',10016,'10'),('ginger',10016,'5'),('garlic',10016,'6'),('chicken',10003,'600'),('vinegar',10003,'15'),('sugar',10003,'15'),('red chili paste',10003,'30'),('cheese',10017,'20'),('sausage',10017,'20'),('hash brown',10017,'30'),('salt',10017,'5'),('black pepper',10017,'5'),('egg',10017,'40'),('milk',10017,'50'),('yeast',10004,'15'),('water',10004,'60'),('sugar',10004,'10'),('milk',10004,'100'),('egg',10004,'50'),('flour',10004,'150'),('salt',10004,'20'),('fish',10018,'200'),('oil',10018,'20'),('onion',10018,'20'),('garlic',10018,'5'),('ginger',10018,'5'),('sugar',10018,'5'),('salt',10018,'5'),('curry paste',10018,'15'),('garlic',10004,'40'),('vegetable oil ',10005,'20'),('onion',10005,'20'),('rice',10005,'300'),('jalapeno',10019,'15'),('tomato',10019,'20'),('garlic',10019,'10'),('onion',10019,'16'),('oil',10019,'10'),('rice',10019,'80'),('green pepper',10005,'70'),('chili powder',10005,'10'),('cumin',10005,'3'),('tomato',10005,'60'),('garlic',10005,'10'),('salt',10005,'7'),('carrot',10020,'30'),('ginger',10020,'10'),('cinnamon',10020,'20'),('water',10020,'30'),('raisins',10020,'30'),('salt',10020,'10'),('saffron',10005,'35'),('water',10005,'450'),('bean',10006,'250'),('green pepper',10006,'150'),('corn',10006,'150'),('onion',10006,'60'),('olive oil',10006,'15'),('vinegar',10006,'15'),('sugar',10006,'5'),('lime juice',10006,'20'),('soy sauce',10021,'10'),('pork',10021,'100'),('sake',10021,'20'),('vinegar',10021,'15'),('ketchup',10021,'10'),('sugar',10021,'8'),('hoisin sauce',10021,'15'),('water',10021,'80'),('garlic',10006,'40'),('black pepper',10006,'30'),('chili',10006,'10'),('celery',10007,'50'),('onion',10007,'15'),('shrimp',10022,'120'),('ketchup',10022,'30'),('soy sauce',10022,'10'),('red pepper',10022,'30'),('garlic',10022,'10'),('onion',10022,'10'),('salt',10022,'5'),('carrot',10007,'50'),('ginger',10007,'10'),('garlic ',10007,'10'),('mushroom',10007,'150'),('chicken',10007,'250'),('chicken',10023,'100'),('curry paste',10023,'50'),('coconut milk',10023,'100'),('bamboo shoots',10023,'25'),('sugar',10023,'5'),('salt',10023,'5'),('green pepper',10023,'20'),('red pepper',10023,'25'),('beef',10007,'250'),('water',10007,'600'),('cucumber',10008,'500'),('vinegar',10008,'15'),('sugar',10008,'10'),('fish',10024,'80'),('salt',10024,'5'),('jalapeno',10024,'15'),('corn',10024,'20'),('cumin',10024,'8'),('oil',10024,'12'),('flour',10024,'9'),('salt',10008,'8'),('ginger ',10008,'7'),('beef',10009,'450'),('salt',10009,'8'),('pepper',10009,'5'),('mushroom',10009,'75'),('water',10009,'150'),('garlic',10009,'30'),('wine',10009,'35'),('flour',10009,'130'),('milk',10052,'100'),('sugar',10052,'30'),('water',10052,'20'),('potato',10051,'20'),('salt',10051,'5'),('chili powder',10053,'5'),('salt',10053,'5'),('coconut milk',10053,'30'),('bean',10053,'50'),('soy sauce',10054,'5'),('sugar',10054,'10'),('pork',10054,'10');
/*!40000 ALTER TABLE `Make` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Recipe`
--

DROP TABLE IF EXISTS `Recipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Recipe` (
  `Recipe_name` varchar(50) DEFAULT NULL,
  `Recipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `Recipe_cuisinetype` varchar(20) DEFAULT NULL,
  `Recipe_preptime` varchar(15) DEFAULT NULL,
  `Recipe_readytime` varchar(15) DEFAULT NULL,
  `Recipe_calories` int(11) DEFAULT NULL,
  `Recipe_steps` varchar(2000) DEFAULT NULL,
  `owner_username` varchar(20) NOT NULL DEFAULT '-1',
  `image_name` varchar(60) NOT NULL,
  PRIMARY KEY (`Recipe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10055 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Recipe`
--

LOCK TABLES `Recipe` WRITE;
/*!40000 ALTER TABLE `Recipe` DISABLE KEYS */;
INSERT INTO `Recipe` (`Recipe_name`, `Recipe_id`, `Recipe_cuisinetype`, `Recipe_preptime`, `Recipe_readytime`, `Recipe_calories`, `Recipe_steps`, `owner_username`, `image_name`) VALUES ('Salmon',10051,'American','20m','30m',NULL,'1.dfsfsd 2.done','nicole1','salmon.jpeg'),('Hot Italian Giardiniera',10001,'Italian','45m','2d 2h 45m',233,'1)Place into a bowl the green and red peppers, jalapenos, celery, carrots, onion, and cauliflower. Stir in salt, and fill with enough cold water to cover. Place plastic wrap or aluminum foil over the bowl, and refrigerate overnight.2)The next day, drain salty water, and rinse vegetables. In a bowl, mix together garlic, oregano, red pepper flakes, black pepper, and olives. Pour in vinegar and olive oil, and mix well. Combine with vegetable mixture, cover, and refrigerate for 2 days before using.','nicole1','10001.png'),('Italian Roast Beef',10002,'Italian','15m','4h 45m',618,'1)Place beef chuck roast into a slow cooker and scatter onion quarters around the meat. Pour the beef broth over the meat and sprinkle the au jus mix, Italian salad dressing mix, salt, and black pepper over the roast.\r\n2)Cover cooker, set on Low, and cook until meat is very tender, 6 to 8 hours.','nicole2','10002.png'),('Addictive Sesame Chicken',10003,'Chinese','30m','50m',740,'1)Combine the 2 tablespoons soy sauce, the dry sherry, dash of sesame oil, flour, 2 tablespoons cornstarch, 2 tablespoons water, baking powder, baking soda, and canola oil in a large bowl. Mix well; stir in the chicken. Cover and refrigerate for 20 minutes. 2)Heat oil in a deep-fryer or large saucepan to 375 degrees F (190 degrees C). 3)Combine the 1/2 cup water, chicken broth, vinegar, 1/4 cup cornstarch, sugar, 2 tablespoons soy sauce, 2 tablespoons sesame oil, red chili paste, and garlic in a small saucepan. Bring to a boil, stirring constantly. Turn heat to low and keep warm, stirring occasionally. 4)Fry the marinated chicken in batches until cooked through and golden brown, 3 to 5 minutes. Drain on paper towels. 5)Transfer the chicken to a large platter, top with sauce, and sprinkle with sesame seeds.','nicole2','10003.png'),('Naan',10004,'Indian','30m','3h',211,'1)In a large bowl, dissolve yeast in warm water. Let stand about 10 minutes, until frothy. Stir in sugar, milk, egg, salt, and enough flour to make a soft dough. Knead for 6 to 8 minutes on a lightly floured surface, or until smooth. Place dough in a well oiled bowl, cover with a damp cloth, and set aside to rise. Let it rise 1 hour, until the dough has doubled in volume. 2)Punch down dough, and knead in garlic. Pinch off small handfuls of dough about the size of a golf ball. Roll into balls, and place on a tray. Cover with a towel, and allow to rise until doubled in size, about 30 minutes. 3)During the second rising, preheat grill to high heat. 4)At grill side, roll one ball of dough out into a thin circle. Lightly oil grill. Place dough on grill, and cook for 2 to 3 minutes, or until puffy and lightly browned. Brush uncooked side with butter, and turn over. Brush cooked side with butter, and cook until browned, another 2 to 4 minutes. Remove from grill, and continue the process until all the naan has been prepared.','nicole1','10004.png'),('Mexican Rice',10005,'Mexican','20m','50m',233,'1)In a large saucepan, heat vegetable oil over a medium-low heat. Place the onions in the pan, and saute until golden. 2)Add rice to pan, and stir to coat grains with oil. Mix in green bell pepper, cumin, chili powder, tomato sauce, salt, garlic, saffron, and water. Cover, bring to a boil, and then reduce heat to simmer. Cook for 30 to 40 minutes, or until rice is tender. Stir occasionally.','john','10005.png'),('Mexican Bean Salad',10006,'Mexican','15m','1h 15m',334,'1)In a large bowl, combine beans, bell peppers, frozen corn, and red onion. 2)In a small bowl, whisk together olive oil, red wine vinegar, lime juice, lemon juice, sugar, salt, garlic, cilantro, cumin, and black pepper. Season to taste with hot sauce and chili powder. 3)Pour olive oil dressing over vegetables; mix well. Chill thoroughly, and serve cold.','nicole2','10006.png'),('Japanese Onion Soup',10007,'Japanese','15m','1h',25,'1)In a large saucepan or stockpot, combine the celery, onion, carrot, ginger, garlic, and a few of the mushrooms. Add chicken stock, beef bouillon, and water. Place the pot over high heat, and bring to a rolling boil. When the mixture reaches boiling, cover, reduce heat to medium, and cook for 45 minutes. 2)Place all of the remaining mushrooms into a separate pot. When the boiling mixture is done, place a strainer over the pot with the mushrooms in it. Strain the cooked soup into the pot with the mushrooms. Discard strained materials. 3)Serve the broth with mushrooms in small porcelain bowls, and sprinkle fresh chives over the top. Use Asian soup spoons for an elegant effect.','sam','10007.png'),('Cucumber Sunomono',10008,'Japanese','15m','1h 15m',27,'1)Cut cucumbers in half lengthwise and scoop out any large seeds. Slice crosswise into very thin slices. 2)In a small bowl combine vinegar, sugar, salt and ginger. Mix well. Place cucumbers inside of the bowl, stir so that cucumbers are coated with the mixture. Refrigerate the bowl of cucumbers for at least 1 hour before serving.','steve','10008.png'),('Daria\'s Slow Cooker Beef Stroganoff',10009,'American','15m','8h15m',403,'1)Place the beef in the bottom of a slow cooker, and season with salt and pepper to taste. Place onion on top of beef, and then add mushroom soup, mushrooms, and water. Season with chives, garlic, Worcestershire sauce, and bouillon. 2)In a small bowl, mix together the wine with the flour. Pour over the beef. 3)Cover, and cook on Low for 6 to 7 hours. Stir in the sour cream and parsley, and continue cooking for 1 hour.','sam123','10009.png'),('Chicken Katsu',10010,'Japanese','10m','20m',297,'1)Season the chicken breasts on both sides with salt and pepper. Place the flour, egg and panko crumbs into separate shallow dishes. Coat the chicken breasts in flour, shaking off any excess. Dip them into the egg, and then press into the panko crumbs until well coated on both sides. 2)Heat 1/4 inch of oil in a large skillet over medium-high heat. Place chicken in the hot oil, and cook 3 or 4 minutes per side, or until golden brown.','sam321','10010.png'),('Chicken Avocado Salad',10011,'Japanese','8m','20m',252,'1)In a medium bowl, combine the avocados, chicken, onion and cilantro. Pour the balsamic vinaigrette over everything, and toss lightly to coa','steve','10011.png'),('Tofu Hiyayakko',10012,'Japanese','10m','10m',100,'1)Mix the soy sauce, sugar, dashi granules, and water together in small bowl until sugar dissolves. Place the tofu on a small plate and top with ginger, green onion, and bonito shavings. Drizzle the soy mixture on top, and sprinkle with sesame seeds.','john','10012.png'),('Easy Bulgogi',10013,'Korean','10m','1h 15m',226,'1)Combine yellow onion, white and light green parts of green onions, soy sauce, sugar, sesame seeds, garlic, sesame oil, red pepper flakes, ginger, and black pepper in a bowl until marinade is well mixed. Add steak slices to marinade; cover and refrigerate, 1 hour to 1 day. 2)Heat a skillet over medium heat. Working in batches, cook and stir steak and marinade together in the hot skillet, adding honey to caramelize the steak, until steak is cooked through, about 5 minutes. Garnish bulgogi with green parts of green onions.','john','10013.png'),('Yummy Korean Glass Noodles',10014,'Korean','15m','20m',363,'1)Break the vermicelli into small pieces and place in a deep-sided dish. Cover with hot tap water and soak for ten minutes; drain. 2)Whisk together the soy sauce, brown sugar, and boiling water; pour over the drained noodles; allow to soak 2 minutes. 3)Pour the vegetable oil into a skillet and place over medium heat. Add the noodles and soy sauce mixture to the skillet and cook and stir until hot, about 5 minutes. Sprinkle sesame seeds over the noodles just before serving.','sam','10014.png'),('Beef Pho',10015,'Vietnam','30m','6h 30m',430,'1)Place the beef knuckle in a very large (9 quart or more) pot. Season with salt, and fill pot with 2 gallons of water. Bring to a boil, and cook for about 2 hours. 2)Skim fat from the surface of the soup, and add the oxtail, radish and onions. Tie the anise pods, cinnamon stick, cloves, peppercorns and ginger in a cheesecloth or place in a spice bag; add to the soup. Stir in sugar, salt and fish sauce. Simmer over medium-low heat for at least 4 more hours (the longer, the better). At the end of cooking, taste, and add salt as needed. Strain broth, and return to the pot to keep at a simmer. Discard spices and bones. Reserve meat from the beef knuckle for other uses if desired. 3)Bring a large pot of lightly salted water to a boil. Soak the rice noodles in water for about 20 minutes, then cook in boiling water until soft, but not mushy, about 5 minutes. Slice the frozen beef paper thin. The meat must be thin enough to cook instantly. 4)Place some noodles into each bowl, and top with a few raw beef slices. Ladle boiling broth over the beef and noodles in the bowl. Serve with hoisin sauce and Sriracha sauce on the side. Set onion, cilantro, bean sprouts, basil, green onions, and lime out at the table for individuals to add toppings to their liking.','nicole3','10015.png'),('Chinese Broccoli',10016,'Chinese','10m','20m',130,'1)Bring a large pot of lightly salted water to a boil. Add the Chinese broccoli and cook uncovered until just tender, about 4 minutes. Drain and set aside. 2)Meanwhile, whisk the sugar, cornstarch, soy sauce, vinegar, sesame oil, hoisin sauce, ginger, and garlic together in a small saucepan over medium heat until thickened and no longer cloudy, 5 to 7 minutes. Toss the broccoli in the sauce and serve.','nicole1','10016.png'),('Sausage Hash Brown Breakfast Casserole',10017,'American','5m','1h',573,'1)Preheat oven to 350 degrees F (175 degrees C). Grease a half-casserole baking dish or deep-dish pie plate. 2)Heat a large skillet over medium-high heat. Cook and stir sausage in the hot skillet until browned and crumbly, 5 to 7 minutes; drain and discard grease. 3)Stir hash browns, cooked sausage, Cheddar cheese, 1/2 teaspoon salt, and black pepper together in a large bowl. Whisk milk, eggs, and remaining salt together in another bowl. Pour hash brown mixture into prepared baking dish; pour egg mixture evenly over hash brown mixture. 4)Bake in the preheated oven until bubbling and golden, about 45 minutes.','nicole3','10017.png'),('Indian Fish Curry',10018,'Indian','20m','1h 25m',338,'1)Mix the mustard, pepper, 1/2 teaspoon salt, and 2 tablespoons of canola oil in a shallow bowl. Add the fish fillets, turning to coat. Marinate the fish in the refrigerator for 30 minutes. 2)Combine the onion, garlic, ginger, and cashews in a blender or food processor and pulse until the mixture forms a paste. 3)Preheat an oven to 350 degrees F. 4)Heat 1 tablespoon of canola oil in a skillet over medium-low heat. Stir in the prepared paste; cook and stir for a minute or two. Add the cayenne pepper, turmeric, cumin, coriander, 1 teaspoon salt, and sugar. Cook and stir for an additional five minutes. Stir in the chopped tomato and vegetable broth. 5)Arrange the fish fillets in a baking dish, discarding any extra marinade. Top the fish with the sauce, cover the baking dish, and bake in the preheated oven until the fish flakes easily with a fork, about 30 minutes. Garnish with chopped cilantro.','sam','10018.png'),('Mexican Quinoa',10019,'Mexican','20m','40m',244,'1)Heat olive oil in a large skillet over medium heat; cook and stir quinoa and onion in the hot oil until onion is translucent, about 5 minutes. Add garlic and jalapeno pepper to quinoa mixture and cook until garlic is fragrant and slightly softened, 1 or 2 more minutes. 2)Mix undrained can of diced tomatoes with green chiles, taco seasoning mix, and chicken broth into quinoa mixture. Bring to a boil, reduce heat to medium-low, and simmer until liquid has been absorbed, 15 to 20 minutes. Stir in cilantro.','sam321','10019.png'),('Carrot Cake Oatmeal',10020,'American','15m','55m',287,'1)Bring water to a boil in a heavy, large saucepan, and stir in the oats. Reduce heat to a simmer, and cook oats until they begin to thicken, about 10 minutes; mix in the apple, carrot, raisins, cinnamon, nutmeg, ginger, and salt. Let the oats simmer until tender, about 20 more minutes. 2)While the oats are simmering, melt butter in a skillet over medium-low heat, and stir in the pecans. Toast the nuts until fragrant and lightly browned, 2 to 5 minutes, then sprinkle with brown sugar and stir until sugar has melted and coated the pecans. 3)Serve in bowls, each topped with about 2 tablespoons of the pecan mixture and a dollop of yogurt.','sam123','10020.png'),('Chinese Spareribs',10021,'Chinese','5m','45m',504,'1)In a shallow glass dish, mix together the hoisin sauce, ketchup, honey, soy sauce, sake, rice vinegar, lemon juice, ginger, garlic and five-spice powder. Place the ribs in the dish, and turn to coat. Cover and marinate in the refrigerator for 2 hours, or as long as overnight. 2)Preheat the oven to 325 degrees F (165 degrees C). Fill a broiler tray with enough water to cover the bottom. Place the grate or rack over the tray. Arrange the ribs on the grate. 3)Place the broiler rack in the center of the oven. Cook for 40 minutes, turning and brushing with the marinade every 10 minutes. Let the marinade cook on for the final 10 minutes to make a glaze. Finish under the broiler if desired. Discard any remaining marinade.','john','10021.png'),('Szechwan Shrimp',10022,'Chinese','10m','20m',142,'1)In a bowl, stir together water, ketchup, soy sauce, cornstarch, honey, crushed red pepper, and ground ginger. Set aside. 2)Heat oil in a large skillet over medium-high heat. Stir in green onions and garlic; cook 30 seconds. Stir in shrimp, and toss to coat with oil. Stir in sauce. Cook and stir until sauce is bubbly and thickened.','0w0','10022.png'),('Thai Pineapple Chicken Curry',10023,'Indian','15m','50m',623,'1)Bring rice and water to a boil in a pot. Reduce heat to low, cover, and simmer 25 minutes. 2)In a bowl, whisk together curry paste and 1 can coconut milk. Transfer to a wok, and mix in remaining coconut milk, chicken, fish sauce, sugar, and bamboo shoots. Bring to a boil, and cook 15 minutes, until chicken juices run clear. 3)Mix the red bell pepper, green bell pepper, and onion into the wok. Continue cooking 10 minutes, until chicken juices run clear and peppers are tender. Remove from heat, and stir in pineapple. Serve over the cooked rice.','nicole3','10023.png'),('Fish Tacos',10024,'Mexican','40m','1h',409,'1)To make beer batter: In a large bowl, combine flour, cornstarch, baking powder, and salt. Blend egg and beer, then quickly stir into the flour mixture (don\'t worry about a few lumps). 2)To make white sauce: In a medium bowl, mix together yogurt and mayonnaise. Gradually stir in fresh lime juice until consistency is slightly runny. Season with jalapeno, capers, oregano, cumin, dill, and cayenne. 3)Heat oil in deep-fryer to 375 degrees F (190 degrees C). 4)Dust fish pieces lightly with flour. Dip into beer batter, and fry until crisp and golden brown. Drain on paper towels. Lightly fry tortillas; not too crisp. To serve, place fried fish in a tortilla, and top with shredded cabbage, and white sauce.','nicole2','10024.png'),('Nasi Goreng',10026,'Brazilian','10','30',500,'1)Heat 1 tbsp of oil in a pre-heated wok. Beat the eggs, coriander and seasoning in a bowl then pour into the wok and cook until set like an omelette. Slice into pieces and leave to one side to cool.\r\n2)To the pre-heated wok add the remaining oil, then toss in the spring onion, red pepper, garlic, Sambal Oelek and the garlic and ginger sauce and cook over a high heat for 2 minutes.\r\n3)Add the prawns, if using and stir fry for 1 minute. Add the marinated tofu pieces and stir fry for 2 minutes.\r\n4)Mix in the pre-cooked rice and the soy sauce and stir fry for a further 3 minutes.\r\n5) To serve, remove from the wok to a serving plate, and garnish with the omelette, cut into fine strips. Squeeze over the lime wedges to taste','nicole1','10026.png'),('Tofu Ddukbokki',10027,'Korean','30','25',760,'1)Place the cornflour, sesame seeds, salt and black pepper in a plastic bag and shake well.\r\n\r\n2)Add the tofu and shake gently to evenly coat it.\r\n\r\n3) Heat 1 tbsp sesame oil and 1 tbsp vegetable oil in a large pan and fry the coated tofu until golden. Remove the tofu from the heat and keep warm.\r\n\r\n4)Fry the onions and mushrooms for 2 minutes then add the vegetable stock, mirin, maple syrup and gochujang. Bring to the boil then cook on a medium/high for 10 minutes to reduce the volume by 1/3, stirring occasionally.\r\n\r\n5)Add the cornflour to the sauce stirring continuously until thickened. Add the courgette and carrot. Season to taste, pour the vegetables on to the serving dish and place the tofu on top. Sprinkle with the remaining sesame seeds.','nicole1','10027.png'),('Italian chicken casserole',10028,'Italian','20m','40m',552,'1)Preheat oven to 180°C. Butter a casserole or lasagne dish (20 x 30cm) with the teaspoon of butter and set aside  2)Over a medium heat, sauté onions, and garlic for one minute in the olive oil, then add chicken to the same pan. Brown the chicken on all sides and cook halfway through.3)Add a large pinch of salt and pepper to taste. Add chicken mixture to a large mixing bowl and then mix in tomatoes, rice, beans, broth, ricotta and basil.4)Pour into the casserole dish and sprinkle with mozzarella. Place on a baking sheet and put in the oven for 25 minutes or until golden and bubbling.\r\n','sam','10028.png'),('tropical classic piazza',10029,'Italian','15m','30m',432,'1)makes 2 (12 inch) pizzas. Divide dough in half, and spread onto pizza pans. Cover with sauce, and desired toppings. Bake at 400 degrees for 20 minutes, or until crust is golden brown.','sam','10029.png'),('Kulfi',10052,'Indian','20','8h20m',NULL,'1.Combine evaporated milk, condensed milk and whipped topping in a blender and blend in pieces of bread until smooth. 2. Pour mixture into a 9x13 inch baking dish or two plastic ice cube trays, sprinkle with cardamom and freeze for 8 hours or overnight.','nicole6','kulfi.jpg'),('Thai Hummus',10053,'Thailand','15m','30m',NULL,'1.Heat coconut oil in a skillet over medium heat; cook and stir garlic until fragrant and lightly browned, 30 seconds to 1 minute. Pour mixture into a ramekin or small bowl and cool. Blend cooled garlic-oil mixture, garbanzo beans, lime juice, peanut butter, coconut milk, chili sauce, lemon grass, basil, ginger, curry paste, jalapeno pepper, salt, cayenne pepper, and chili powder together in a blender until smooth.','nicole8','thaihummus.jpg');
/*!40000 ALTER TABLE `Recipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `username` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `worldcuisinetype` varchar(200) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` (`username`, `name`, `password`, `email`, `worldcuisinetype`) VALUES ('nicole1','nicole','123','nicole1@hotmail.com','Chinese'),('nicole2','nicolee','666','linjy@hotmail.com','Italian'),('nicole3','nicole3','666','nicole3@gmail.com','American'),('john','john','123','john@illinois.edu','Japanese'),('sam','sam','111','sam@gmail.com','Korean'),('steve','steve','111','steve@hotmail.com','Vietnam'),('0w0','tracy','654321','tracy@hotmail.com','Mexican'),('hahah','tracy','654321','tracy@hotmail.com','Mexican'),('owoengineer','emily','111222333','emily1994@gmail.com','American'),('emily4321','emily','111222333','emily1994@gmail.com','American'),('sam123','sam','24715436745','sam1996@163.com','Italian'),('sam321','sam','24715436745','sam1996@163.com','Italian'),('nicole6','Nicole','123','lin666@gmail.com','Asian,Indian'),('nicole8','Nicole','123','nicole@gmail.com','American,Italian'),('nicoleee1','nICOLE','666','NSDF@hotmail.com','Chinese,Japanese'),('nicole9','nicole','123','lin@gmail.com','Asian'),('nicole111','nicole','123','nicole@gmail.com','Italian');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ViewHistory`
--

DROP TABLE IF EXISTS `ViewHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ViewHistory` (
  `username` varchar(200) NOT NULL DEFAULT '',
  `recipe_id` int(11) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`username`,`recipe_id`,`time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ViewHistory`
--

LOCK TABLES `ViewHistory` WRITE;
/*!40000 ALTER TABLE `ViewHistory` DISABLE KEYS */;
INSERT INTO `ViewHistory` (`username`, `recipe_id`, `time`) VALUES ('nicole1',10001,'2017-04-24 17:05:15.296032'),('nicole1',10001,'2017-04-24 17:17:00.934831'),('nicole1',10001,'2017-04-25 01:10:05.269446'),('nicole1',10002,'2017-04-23 16:39:50.525325'),('nicole1',10003,'2017-04-23 16:43:00.197702'),('nicole1',10003,'2017-04-24 03:55:35.511807'),('nicole1',10003,'2017-04-24 16:57:50.345917'),('nicole1',10003,'2017-04-24 17:02:25.904732'),('nicole1',10003,'2017-04-24 17:02:48.509872'),('nicole1',10003,'2017-04-25 01:26:39.610664'),('nicole1',10007,'2017-04-24 17:03:00.961276'),('nicole1',10007,'2017-04-24 17:05:03.957172'),('nicole1',10007,'2017-04-25 01:09:13.815286'),('nicole1',10009,'2017-04-24 16:45:27.283416'),('nicole1',10009,'2017-04-24 17:50:19.089769'),('nicole1',10010,'2017-04-23 21:08:38.115206'),('nicole1',10011,'2017-04-23 16:41:08.178111'),('nicole1',10011,'2017-04-25 01:10:13.414470'),('nicole1',10012,'2017-04-23 21:15:23.530277'),('nicole1',10012,'2017-04-24 16:56:14.053098'),('nicole1',10012,'2017-04-25 01:10:21.422986'),('nicole1',10013,'2017-04-23 21:17:58.629709'),('nicole1',10013,'2017-04-24 04:33:46.130820'),('nicole1',10013,'2017-04-24 04:38:39.766038'),('nicole1',10014,'2017-04-24 13:43:48.133546'),('nicole1',10015,'2017-04-23 16:42:36.247668'),('nicole1',10017,'2017-04-24 17:55:18.091981'),('nicole1',10021,'2017-04-24 03:12:32.799841'),('nicole1',10022,'2017-04-24 03:12:11.911925'),('nicole1',10024,'2017-04-24 21:31:47.920912'),('nicole1',10026,'2017-04-24 03:32:06.401170'),('nicole1',10027,'2017-04-24 03:39:29.770078'),('nicole1',10027,'2017-04-24 04:38:05.881947'),('nicole1',10028,'2017-04-24 03:58:28.108231'),('nicole1',10028,'2017-04-24 03:59:14.979888'),('nicole1',10029,'2017-04-24 03:58:33.990212'),('nicole1',10029,'2017-04-24 03:59:18.803757'),('nicole1',10029,'2017-04-24 04:05:52.061660'),('nicole1',10051,'2017-04-24 16:47:48.663456'),('nicole1',10051,'2017-04-24 17:26:15.107047'),('nicole1',10051,'2017-04-24 17:26:42.837808'),('nicole1',10051,'2017-04-24 17:31:33.474430'),('nicole1',10051,'2017-04-24 17:31:41.007345'),('nicole1',10051,'2017-04-24 17:35:51.767820'),('nicole1',10051,'2017-04-24 17:36:26.809233'),('nicole1',10051,'2017-04-24 17:37:45.181245'),('nicole1',10051,'2017-04-24 17:41:53.009023'),('nicole1',10051,'2017-04-24 17:43:09.156388'),('nicole1',10051,'2017-04-24 17:43:48.045658'),('nicole1',10051,'2017-04-24 17:47:19.095344'),('nicole1',10051,'2017-04-24 17:48:11.864760'),('nicole1',10052,'2017-04-24 16:42:07.134317'),('nicole111',10002,'2017-04-25 15:23:29.342353'),('nicole111',10003,'2017-04-25 15:19:57.450796'),('nicole111',10003,'2017-04-25 15:20:23.026128'),('nicole111',10003,'2017-04-25 15:26:25.943266'),('nicole111',10005,'2017-04-25 15:23:20.680382'),('nicole111',10007,'2017-04-25 15:23:47.493005'),('nicole111',10010,'2017-04-25 15:23:37.997322'),('nicole111',10014,'2017-04-25 15:26:57.891783'),('nicole111',10015,'2017-04-25 15:25:25.522534'),('nicole111',10015,'2017-04-25 15:25:32.256154'),('nicole111',10054,'2017-04-25 15:21:39.727592'),('nicole111',10054,'2017-04-25 15:22:07.025213'),('nicole111',10054,'2017-04-25 15:22:58.633149'),('nicole2',10010,'2017-04-23 16:45:26.879028'),('nicole2',10010,'2017-04-24 20:31:55.131834'),('nicole2',10012,'2017-04-23 16:44:31.369188'),('nicole2',10013,'2017-04-23 16:44:25.040998'),('nicole2',10013,'2017-04-24 20:31:06.296829'),('nicole6',10002,'2017-04-24 16:34:59.462384'),('nicole6',10007,'2017-04-24 16:35:21.073075'),('nicole6',10007,'2017-04-24 16:35:41.806125'),('nicole6',10008,'2017-04-24 16:35:12.972241'),('nicole6',10011,'2017-04-24 16:35:31.760454'),('nicole6',10052,'2017-04-24 16:38:50.509313'),('nicole6',10052,'2017-04-24 16:39:14.591358'),('nicole8',10001,'2017-04-25 12:55:34.397299'),('nicole8',10001,'2017-04-25 12:55:44.944142'),('nicole8',10002,'2017-04-25 06:01:41.924897'),('nicole8',10002,'2017-04-25 12:55:30.042987'),('nicole8',10002,'2017-04-25 12:55:41.338596'),('nicole8',10051,'2017-04-25 06:05:39.282565'),('nicole8',10053,'2017-04-25 06:20:52.661443'),('nicole8',10053,'2017-04-25 12:31:46.123514'),('nicole9',10001,'2017-04-25 15:07:04.416135'),('nicole9',10001,'2017-04-25 15:07:33.615981');
/*!40000 ALTER TABLE `ViewHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'nextgreatchef_CS411'
--

--
-- Dumping routines for database 'nextgreatchef_CS411'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-25 10:50:34

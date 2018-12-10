<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Pokemon Details</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<div id="wrapper">
<p style="text-align:left;">
<a href="./PokedexHome.php"> << Return to the Pokedex</a>
<span style="float:right;">
<a href="./CreatePokemon.php"> Create a new Pokemon</a> <br>
<a href="./ReleasePokemon.php"> Release another Pokemon</a> 
</span>
</p>
</div>

<?php
session_start(); 
$errors = 0;

// Sets up database connection
$con = mysqli_connect("localhost", "admin", "password", "pokedex");

// Checks connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//Load session variable
$selected_id = $_SESSION['selected_id'];

//Get selected pokemon info
$single_result = mysqli_query($con,"SELECT * FROM pokemon p 
JOIN pokemonStats ps ON ps.pokemon_id = p.pokemon_id
JOIN pokemonTypes pt ON pt.pokemon_id = p.pokemon_id
JOIN pokemonDescriptions pd ON pd.pokemon_id = p.pokemon_id
WHERE p.pokemon_id=$selected_id") or die(mysql_error());

$pokemon = mysqli_fetch_assoc($single_result);
	
#Delete pokemon by ID
$SQLstring = "DELETE FROM pokemon WHERE pokemon_id = " . $selected_id;
$QueryResult = @mysqli_query($con, $SQLstring);
if ($QueryResult === FALSE) {
	echo "<p>Unable to release your pokemon " 
		. " Error code " 
		. mysqli_errno($con) . ": " 
		. mysqli_error($con) . "</p>\n";
	++$errors;
}

#Delete pokemonStats by ID
$SQLstring = "DELETE FROM pokemonStats WHERE pokemon_id = " . $selected_id;
$QueryResult = @mysqli_query($con, $SQLstring);
if ($QueryResult === FALSE) {
	echo "<p>Unable to release your pokemon " 
		. " Error code " 
		. mysqli_errno($con) . ": " 
		. mysqli_error($con) . "</p>\n";
	++$errors;
}

#Delete pokemonDescriptions by ID
$SQLstring = "DELETE FROM pokemonDescriptions WHERE pokemon_id = " . $selected_id;
$QueryResult = @mysqli_query($con, $SQLstring);
if ($QueryResult === FALSE) {
	echo "<p>Unable to release your pokemon " 
		. " Error code " 
		. mysqli_errno($con) . ": " 
		. mysqli_error($con) . "</p>\n";
	++$errors;
}

#Delete pokemonTypes by ID
$SQLstring = "DELETE FROM pokemonTypes WHERE pokemon_id = " . $selected_id;
$QueryResult = @mysqli_query($con, $SQLstring);
if ($QueryResult === FALSE) {
	echo "<p>Unable to release your pokemon " 
		. " Error code " 
		. mysqli_errno($con) . ": " 
		. mysqli_error($con) . "</p>\n";
	++$errors;
}


// If errors aren't found, display release message
if ($errors == 0) {
echo "Pokemon " . $pokemon["name"] . " has been released into the wild. ";
}
else 
{
echo "Releasing pokemon failed.";
}


//Closes db connection
mysqli_close($con);
?>


</body>
</html>



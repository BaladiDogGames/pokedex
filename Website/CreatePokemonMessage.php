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
<a href="./CreatePokemon.php"> Create another new Pokemon</a> <br>
<a href="./ReleasePokemon.php"> Release a Pokemon</a> 
</span>
</p>
</div>

<?php
session_start(); 

// Sets up database connection
$con = mysqli_connect("localhost", "admin", "password", "pokedex");

// Checks connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}





// BEGIN INPUT VERIFICATION //
if (empty($_POST['name'])) {
	++$errors;
	echo "<p>You need to enter a Pokemon name.</p>\n";
	$name = "";
}
if (empty($_POST['type1'])) {
	++$errors;
	echo "<p>You need to enter at least 1 type.</p>\n";
	$type1 = " ";
}
if (empty($_POST['weight'])) {
	++$errors;
	echo "<p>You need to enter a weight.</p>\n";
	$weight = " ";
}
if (empty($_POST['height'])) {
	++$errors;
	echo "<p>You need to enter a height.</p>\n";
	$height = " ";
}
if (empty($_POST['hp'])) {
	++$errors;
	echo "<p>You need to enter a value for HP.</p>\n";
	$hp = " ";
}
if (empty($_POST['attack'])) {
	++$errors;
	echo "<p>You need to enter a value for Attack.</p>\n";
	$attack = " ";
}
if (empty($_POST['defense'])) {
	++$errors;
	echo "<p>You need to enter a value for Defense.</p>\n";
	$defense = " ";
}
if (empty($_POST['spatk'])) {
	++$errors;
	echo "<p>You need to enter a value for Sp. Atk.</p>\n";
	$spatk = " ";
}
if (empty($_POST['spdef'])) {
	++$errors;
	echo "<p>You need to enter a value for Sp. Def.</p>\n";
	$spdef = " ";
}
if (empty($_POST['speed'])) {
	++$errors;
	echo "<p>You need to enter a value for Speed.</p>\n";
	$speed = " ";
}

// Get Pokemon table info
$result = @mysqli_query($con, "    SHOW TABLE STATUS LIKE 'pokemon'   ");
$data = mysqli_fetch_assoc($result);

// If no errors found, continue inputting data to database
if ($errors == 0) {
	$pokemon_id = $data['Auto_increment'];
	$name = stripslashes($_POST['name']);
	$type1 = stripslashes($_POST['type1']);
	$type2 = stripslashes($_POST['type2']);
	$weight = stripslashes($_POST['weight']);
	$height = stripslashes($_POST['height']);
	$hp = stripslashes($_POST['hp']);
	$attack = stripslashes($_POST['attack']);
	$defense = stripslashes($_POST['defense']);
	$spatk = stripslashes($_POST['spatk']);
	$spdef = stripslashes($_POST['spdef']);
	$speed = stripslashes($_POST['speed']);
	
	//Pokemon table
	$SQLstring = "INSERT INTO pokemon " . " (name) " . 
	" VALUES( '$name')";
	$QueryResult = @mysqli_query($con, $SQLstring);
	if ($QueryResult === FALSE) {
	echo "<p>Unable to create your pokemon " . " information. Error code " .
			mysqli_errno($con) . ": " .
			mysqli_error($con) . "</p>\n";
	++$errors;
	}

	//PokemonDescriptions table
	$SQLstring = "INSERT INTO pokemonDescriptions " . " ( pokemon_id, height, weight) " . 
	" VALUES( '$pokemon_id', '$height', '$weight')";
	$QueryResult = @mysqli_query($con, $SQLstring);
	if ($QueryResult === FALSE) {
	echo "<p>Unable to create your pokemon " . " information. Error code " .
			mysqli_errno($con) . ": " .
			mysqli_error($con) . "</p>\n";
	++$errors;
	}

	//PokemonStats table
	$SQLstring = "INSERT INTO pokemonStats " . " ( pokemon_id, hp, attack, defense, 
	sp_atk, sp_def, speed) " . 
	" VALUES( '$pokemon_id', '$hp', '$attack', '$defense', '$spatk', '$spdef', '$speed')";
	$QueryResult = @mysqli_query($con, $SQLstring);
	if ($QueryResult === FALSE) {
	echo "<p>Unable to create your pokemon " . " information. Error code " .
			mysqli_errno($con) . ": " .
			mysqli_error($con) . "</p>\n";
	++$errors;
	}

	//PokemonTypes table
	$SQLstring = "INSERT INTO pokemonTypes " . " (pokemon_id, type1, type2) " . 
	" VALUES( '$pokemon_id', '$type1', '$type2')";
	$QueryResult = @mysqli_query($con, $SQLstring);
	if ($QueryResult === FALSE) {
	echo "<p>Unable to create your pokemon " . " information. Error code " .
			mysqli_errno($con) . ": " .
			mysqli_error($con) . "</p>\n";
	++$errors;
	}

	// If errors aren't found, display release message
	if ($errors == 0) {
		echo "New Pokemon " . $_POST['name'] . " has been created successfully! Please return to the 				Pokedex	homepage to see your new creation. ";
	}
	else 
	{
	echo "Creating pokemon failed.";
	}
}

mysqli_close($DBConnect);
?>
</body>
</html>

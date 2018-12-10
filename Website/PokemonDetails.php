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

//Load session variable
$selected_id = $_SESSION['selected_id'];

// Get pokemon info by ID from mysql tables
$single_result = mysqli_query($con,"SELECT * FROM pokemon p 
JOIN pokemonStats ps ON ps.pokemon_id = p.pokemon_id
JOIN pokemonTypes pt ON pt.pokemon_id = p.pokemon_id
JOIN pokemonDescriptions pd ON pd.pokemon_id = p.pokemon_id
WHERE p.pokemon_id=$selected_id") or die(mysql_error());
$pokemon = mysqli_fetch_assoc($single_result);

// Displays pokemon name
echo '<h1>' . $pokemon["name"] . '</h1>';

//Sets up html table
echo "<table border='1' id='table_details'>
<tr>
<td class='customTD'><img src='./images/whos_that_pikachu.jpeg' height='175' width='175'></td>

<td class='customTD2'>
<h3>POKEMON DATA</h3>

<table id='table_home'>
<tr>
<td> Number: </td> <td>" . $pokemon['pokemon_id'] . "</td>
</tr>
<tr>
<td> Type: </td> <td>" . $pokemon['type1']; 

// Formatting if a second type exists
if (!empty($pokemon['type2'])){
         echo ", " . $pokemon['type2'];
}

echo "</td>";
echo "
</table>

</td>
</tr>

<tr>
<td>
<table id='table_home'>
<h3>POKEMON DESCRIPTION</h3>
<tr>
<td> Height: </td> <td>" . $pokemon['height'] . "'</td>
</tr>
<tr>
<td> Weight: </td> <td>" . $pokemon['weight'] . " lbs</td>
</tr>
</table>
</td>

<td>
<table id='table_home'>
<h3>POKEMON STATS</h3>
<tr>
<td> HP: </td> <td>" . $pokemon['hp'] . "</td>
</tr>
<tr>
<td> Attack: </td> <td>" . $pokemon['attack'] . "</td>
</tr>
<tr>
<td> Defense: </td> <td>" . $pokemon['defense'] . "</td>
</tr>
<tr>
<td> Sp. Atk: </td> <td>" . $pokemon['sp_atk'] . "</td>
</tr>
<tr>
<td> Sp. Def: </td> <td>" . $pokemon['sp_def'] . "</td>
</tr>
<tr>
<td> Speed: </td> <td>" . $pokemon['speed'] . "</td>
</tr>
</table>
<br>
</td>
</tr>
</table>";

//Closes db connection
mysqli_close($con);
?>

</body>
</html>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Create A Pokemon</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<div id="wrapper">
<p style="text-align:left;">
<a href="./PokedexHome.php"> << Return to the Pokedex</a>
<span style="float:right;">
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

#Get pokemon count + 1
$result = @mysqli_query($con, "    SHOW TABLE STATUS LIKE 'pokemon'   ");
$data = mysqli_fetch_assoc($result);
$pokemon_id = $data['Auto_increment'];

#Create Pokemon Form
echo '<hr />
<form method="post" action="CreatePokemonMessage.php">

<table id="table_home">
<tr>
<td align=right>
<p>ID: <input type="text" name="pokemon_id" value=' . $pokemon_id . ' disabled></p>

<p>Pokemon Name: 
<input type="text" name="name" /></p>

<p>Type(s): 
<select name="type1">
  <option value="">Select a type...</option>
  <option value="Bug">Bug</option>
  <option value="Dragon">Dragon</option>
  <option value="Ice">Ice</option>
  <option value="Fighting">Fighting</option>
  <option value="Fire">Fire</option>
  <option value="Flying">Flying</option>
  <option value="Grass">Grass</option>
  <option value="Ghost">Ghost</option>
  <option value="Ground">Ground</option>
  <option value="Electric">Electric</option>
  <option value="Normal">Normal</option>
  <option value="Poison">Poison</option>
  <option value="Psychic">Psychic</option>
  <option value="Rock">Rock</option>
  <option value="Water">Water</option>
</select>

<select name="type2">
  <option value="">Select a type...</option>
  <option value="Bug">Bug</option>
  <option value="Dragon">Dragon</option>
  <option value="Ice">Ice</option>
  <option value="Fighting">Fighting</option>
  <option value="Fire">Fire</option>
  <option value="Flying">Flying</option>
  <option value="Grass">Grass</option>
  <option value="Ghost">Ghost</option>
  <option value="Ground">Ground</option>
  <option value="Electric">Electric</option>
  <option value="Normal">Normal</option>
  <option value="Poison">Poison</option>
  <option value="Psychic">Psychic</option>
  <option value="Rock">Rock</option>
  <option value="Water">Water</option>
</select>
</p>

<p>Height: <input type="text" name="height" /></p>

<p>Weight: <input type="text" name="weight" /></p>

</td>

<td align=right >
<p>HP: <input type="text" name="hp" /></p>
<p>Attack: <input type="text" name="attack" /></p>
<p>Defense: <input type="text" name="defense" /></p>
<p>Sp. Atk: <input type="text" name="spatk" /></p>
<p>Sp. Def: <input type="text" name="spdef" /></p>
<p>Speed: <input type="text" name="speed" /></p>
</td>

</table>

<div id="selected_pokemon">
<input type="submit" name="create_pokemon" value="Create Pokemon" /></br></br>

<input type="reset" name="reset"
value="Start Over" /></br></br>
</div>

</form>
<hr />';

?>


</body>
</html>



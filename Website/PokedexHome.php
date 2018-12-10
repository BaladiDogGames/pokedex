<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Pokedex</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<div id="wrapper">
<p style="text-align:left;">
<span style="float:right;">
<a href="./CreatePokemon.php"> Create a new Pokemon</a> <br>
<a href="./ReleasePokemon.php"> Release a Pokemon</a> 
</span>
</p>
</div>

<br>

<h1>POKEDEX</h1>

<?php
session_start(); 

// Sets up database connection
$con = mysqli_connect("localhost", "admin", "password", "pokedex");

// Checks connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Queries pokemon table
$result = mysqli_query($con,"SELECT * FROM pokemon");


// If Pokemon Selected via Button, get selected pokemon data
if (isset($_POST['action'])) {	
	$_SESSION['selected_id'] = $_POST['submit'];
	$result2 = mysqli_query($con,"SELECT * FROM pokemon WHERE pokemon_id=" . $_SESSION['selected_id']);
	$row = mysqli_fetch_array($result2);
	echo '<div id="selected_pokemon">You have selected ' . $row["name"] . ' (# ' 
		. $_SESSION['selected_id'] . ') <br>'
		. '<a href="./PokemonDetails.php">Click Here to learn more about ' 
		. $row["name"] . ' >></a> </div> <br>';	
}


//Sets up html table
echo "<table border='1' id='table_home'>
<tr>
<th>#</th>
<th>Name</th>
</tr>";

//Sets up form
echo "<form method='post' action=''>";
echo '<input type="hidden" name="action" value="submit" />';

//Loops through table rows and populates with mysql data
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . '<input type="submit" name="submit" value=' . $row["pokemon_id"] . ' style="display:table-cell; width:100%">' . "</td>" ;
echo "<td>" . $row['name'] . "</td>";
echo "</tr>";
}
  
echo "</form>";
echo "</table>";

//Closes db connection
mysqli_close($con);
?>

</body>
</html>



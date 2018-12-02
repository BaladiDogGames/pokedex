<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Pokedex</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<h1>Pokemon Details</h1>

<?php
session_start(); 

// Sets up database connection
$con = mysqli_connect("localhost", "bivins", "password", "pokedex");

// Checks connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

echo '<a href="./PokedexHome.php"> << Return to the Pokedex</a>';

//On page 2
$selected_id = $_SESSION['selected_id'];


// Queries pokemon table
$result = mysqli_query($con,"SELECT * FROM pokemon WHERE id=$selected_id" );

//Sets up html table
echo "<table border='1' id='table_home'>
<tr>
<th>ID</th>
<th>Name</th>
<th>test2</th>
</tr>";

//Sets up form
echo "<form method='post' action='PokemonDetails.php'>";

//Loops through table rows
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" ;
echo 'test';
echo "</td>";
echo "</tr>";
}

echo "</form>";
echo "</table>";

//Closes db connection
mysqli_close($con);
?>


</body>
</html>



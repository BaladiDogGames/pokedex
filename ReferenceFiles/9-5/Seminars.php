<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Professional Conference</title>
</head>
<body>
<h1>Professional Conference</h1>
<h2>Seminars</h2>

<?php
$errors = 0;

// BEGIN INPUT VERIFICATION //
if (empty($_POST['phone'])) {
	++$errors;
	echo "<p>You need to enter a phone number.</p>\n";
	$phone = "";
}
else
	$phone = stripslashes($_POST['phone']);
if (empty($_POST['company'])) {
	++$errors;
	echo "<p>You need to enter a company name.</p>\n";
	$company = " ";
}
else {
	$company = stripslashes($_POST['company']);
}
if (empty($_POST['address'])) {
	++$errors;
	echo "<p>You need to enter an address.</p>\n";
	$address = " ";
}
else {
	$address = stripslashes($_POST['address']);
}
if (empty($_POST['city'])) {
	++$errors;
	echo "<p>You need to enter a city.</p>\n";
	$city = " ";
}
else {
	$city = stripslashes($_POST['city']);
}
if (empty($_POST['state'])) {
	++$errors;
	echo "<p>You need to enter a state.</p>\n";
	$state = " ";
}
else {
	$state = stripslashes($_POST['state']);
}
if (empty($_POST['zip'])) {
	++$errors;
	echo "<p>You need to enter a zip.</p>\n";
	$zip = " ";
}
else {
	$zip = stripslashes($_POST['zip']);
}
// END INPUT VERIFICATION //


// BEGIN DATABASE & TABLE CREATION //

$DBConnect = FALSE;
if ($errors == 0) {
	$DBConnect = @mysqli_connect("localhost", "admin","password");
	if ($DBConnect === FALSE) {
		echo "<p>Unable to connect to the database server. " .
		"Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>\n";
	}

	else {
//instead of creating db and table, only create table
		$DBName = "conference_registrations"; 
		$TableName = "company_info";
		mysqli_select_db($DBConnect, $DBName);
		$SQLstring = "SHOW TABLES LIKE '$TableName'"; 
		$QueryResult= @mysqli_query($DBConnect, $SQLstring); 
		if (mysqli_num_rows($QueryResult) == 0) { 
			$SQLString2 = "CREATE TABLE $TableName
				(companyID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				employeeID SMALLINT,
				FOREIGN KEY (employeeID) REFERENCES personal_info(employeeID),
				company VARCHAR(40), address VARCHAR(40), city VARCHAR(40), state VARCHAR(30), 
				zip VARCHAR(10), phone VARCHAR(10))";
				$QueryResult2= @mysqli_query($DBConnect, $SQLString2);
				if ($QueryResult2 === FALSE) {
					echo "<p>Unable to create the table. " . "Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>\n";
				}	
		} 
	}
} 
// END DATABASE & TABLE CREATION //

//If errors are found, provide instructions for returning to previous page
if ($errors > 0) {
	echo "<p>Please use your browser's BACK button to return" . " to the form and fix the errors indicated.</p>\n";
}

// If errors aren't found, input values into personal_info table
if ($errors == 0) {
 	$company = stripslashes($_POST['company']);
	$address = stripslashes($_POST['address']);
	$city = stripslashes($_POST['city']);
	$state = stripslashes($_POST['state']);
	$zip = stripslashes($_POST['zip']);
	$phone = stripslashes($_POST['phone']);
	$SQLstring = "INSERT INTO $TableName " . " (company, address, city, state, zip, phone) " . 
	" VALUES( '$company', '$address', '$city', '$state', '$zip', '$phone')";
	$QueryResult = @mysqli_query($DBConnect, $SQLstring);
	if ($QueryResult === FALSE) {
	echo "<p>Unable to save your registration " . " information. Error code " .
			mysqli_errno($DBConnect) . ": " .
			mysqli_error($DBConnect) . "</p>\n";
	++$errors;
	}
	else {
		$InternID = mysqli_insert_id($DBConnect);
	}
	mysqli_close($DBConnect);
}

if ($errors == 0) {

echo '<hr />
<form method="get" action="Summary.php">
  <input type="checkbox" name="javascript" value="yes" > JavaScript<br>
  <input type="checkbox" name="php" value="yes" > PHP<br>
  <input type="checkbox" name="mysql" value="yes" > MySQL<br>
  <input type="checkbox" name="apache" value="yes" > Apache<br>
  <input type="checkbox" name="webservices" value="yes" > Web Services<br><br>
  
<input type="submit" name="register_seminars"
value="Next" /></br></br>

<input type="button" onclick="history.back();" value="Back"></br></br>

<input type="reset" name="reset"
value="Start Over" /></br></br>
</form>
<hr />';

}
?>
</body>
</html>

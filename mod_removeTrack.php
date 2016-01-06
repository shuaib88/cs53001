<?php

// Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'ahmed1';
$password = '1660Mvemjbu9';
$database = $username . 'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
print 'Connected successfully!<br>';

// Assign input variables

$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
$trackID = $_REQUEST["trackID"];

// check the password

$passwordCheckQuery = "SELECT personName 
FROM person
WHERE password = '$password' ";

$checkedUsername = mysqli_query($dbcon, $passwordCheckQuery)
  or die('Query failed: ' . mysqli_error($dbcon));

$tuple = mysqli_fetch_row($checkedUsername);

// update the database if username and password agree

if ($username = '$tuple[0]'){
	$query = "DELETE FROM track
		WHERE trackID = $trackID ";

	mysqli_query($dbcon, $query)
  		or die('Query failed: ' . mysqli_error($dbcon));

	echo "<br> Your track has been deleted";

	echo" <hr><b> back to tracks page: </b> <a href=http://cgi-cspp.cs.uchicago.edu/~ahmed1/cs53001/Tracks.html> Tracks Page </a>" ; 
}

else {
	echo "<br> Sorry you might have entered the wrong password or username";
}

// Free result
mysqli_free_result($checkedUsername);

// Closing connection
mysqli_close($dbcon);
?> 
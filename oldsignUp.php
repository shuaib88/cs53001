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
$passwordAttempt = $_REQUEST["password"];

// check the password

$passwordCheckQuery = "SELECT personName 
FROM person
WHERE personName = '$username' ";

$checkedUsername = mysqli_query($dbcon, $passwordCheckQuery)
  or die('Query failed: ' . mysqli_error($dbcon));

$tuple = mysqli_fetch_row($checkedUsername);

// update the database if username and password agree

if ( $tuple[0] != $username ){
	$query = "INSERT INTO person(likeNum, proStatus, personName, password)
		VALUES (0, 'false', '$username', '$passwordAttempt') ";

	mysqli_query($dbcon, $query)
  		or die('Query failed: ' . mysqli_error($dbcon));

	echo "<br> Welcome to SoundCloud!, your userName is: '$username' ";

	echo" <hr><b> back to people page: </b> <a href=http://cgi-cspp.cs.uchicago.edu/~ahmed1/cs53001/Person.html> People Page </a>" ; 
}

else {
	echo "<br> Sorry someone may have that username, try again";

	echo" <hr><b> try again </b> <a href=http://cgi-cspp.cs.uchicago.edu/~ahmed1/cs53001/signUp.html> Sign Up Page </a>" ;
}

// Free result
mysqli_free_result($checkedUsername);

// Closing connection
mysqli_close($dbcon);
?> 
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

// Assign input variable

$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
$playlistName = $_REQUEST["playlistName"];

// check the password

$passwordCheckQuery = "SELECT personName 
FROM person
WHERE password = '$password' and personName = '$username' ";

$checkedUsername = mysqli_query($dbcon, $passwordCheckQuery)
  or die('Query failed: ' . mysqli_error($dbcon));

$tuple = mysqli_fetch_row($checkedUsername);

// get the personID

$personIDquery = "SELECT personID FROM person WHERE personName = '$tuple[0]' ";

$personID = mysqli_query($dbcon, $personIDquery)
  or die('Query failed: ' . mysqli_error($dbcon));

$personIDTuple = mysqli_fetch_row($personID);

// update the database if username and password agree

if ($username = $tuple[0]){
	$query = "INSERT INTO playlist(playlistName, numLikes, numReposts, personID)
		VALUES ('$playlistName', 0, 0, '$personIDTuple[0]' ) ";

	mysqli_query($dbcon, $query)
  		or die('Query failed: ' . mysqli_error($dbcon));

	echo "<br> Your playlist has been posted it's called $playlistName";

	echo" <hr><b> back to playlist page: </b> <a href=http://cgi-cspp.cs.uchicago.edu/~ahmed1/cs53001/playlist.html> Playlist Page </a>" ; 
}

else {
	echo "<br> Sorry you might have entered the wrong password or username";

	echo" <hr><b> try Again: </b> <a href=http://cgi-cspp.cs.uchicago.edu/~ahmed1/cs53001/playlist.html> Playlist Page </a>" ;
}

// Free result
mysqli_free_result($personID);
mysqli_free_result($checkedUsername);

// Closing connection
mysqli_close($dbcon);
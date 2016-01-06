<?php

//referencing connection parameters
require('config.php');

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
print 'Connected successfully!<br>';

// Get the the names of all users
$query = "SELECT personID, personName FROM person";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

// Printing user attributes in HTML

print '<ul>';  
print "<li><b><u> userID" . ", " . "personName</b></u>";
while ($tuple = mysqli_fetch_row($result)) {
   print "<li>$tuple[0]" . ", " . "$tuple[1]";
}
print '</ul>';

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 
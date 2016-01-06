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

// Assign serach variable

$searchTerm = $_REQUEST["searchTerm"];


// Get the the top ten tracks
$query = "SELECT A.trackName, A.trackID, A.numLikes, A.shares, B.personName
FROM track A
JOIN person B
ON A.personID = B.personID
WHERE A.trackName LIKE '%" . $searchTerm . "%' " ;

$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

// Printing user attributes in HTML

print '<ul>';  
print "<li><b><u> Track Name, Track ID, Number of Likes , Number of Shares, Track Publisher </b></u>";
while ($tuple = mysqli_fetch_row($result)) {
   print "<li>$tuple[0]" . ", " . "$tuple[1]" . ", " . "$tuple[2]" . ", " . "$tuple[3]" . ", " . "$tuple[4]";
}
print '</ul>';



// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 
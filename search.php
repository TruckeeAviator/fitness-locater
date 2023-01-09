<?php
// Connect to the MySQL database
$host = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the user-provided location
$location = $_POST["location"];

// Split the location on the comma character
$parts = explode(",", $location);

// Trim any leading/trailing white space from the parts
$city = trim($parts[0]);
$state = trim($parts[1]);

// Construct the SELECT statement
$sql = "SELECT * FROM people WHERE city='$city' AND state='$state'";

// Execute the SELECT statement
$result = mysqli_query($conn, $sql);

// Check for error
if (!$result) {
  die("Error executing SELECT statement: " . mysqli_error($conn));
}

// Fetch the results as an associative array
$people = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free the result set
mysqli_free

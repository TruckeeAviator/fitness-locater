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

// Get the user-provided location criteria
$city = $_POST["city"];
$state = $_POST["state"];

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
mysqli_free_result($result);

// Close the connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Search Results</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1>Search Results</h1>

<?php
// Check if any people were found
if (count($people) > 0) {
  // Display the results in an HTML table
  echo "<table>";
  echo "<tr><th>Name</th><th>Address</th><th>City</th><th>State</th><th>Zip Code</th></tr>";
  foreach ($people as $person) {
    echo "<tr>";
    echo "<td>" . $person["name"] . "</td>";
    echo "<td>" . $person["address"] . "</td>";
    echo "<td>" . $person["city"] . "</td>";
    echo "<td>" . $person["state"] . "</td>";
    echo "<td>" . $person["zip_code"] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  // No people were found
  echo "<p>No people were found for the specified location.</p>";
}
?>

</body>
</html>

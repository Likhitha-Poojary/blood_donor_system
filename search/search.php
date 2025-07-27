<!DOCTYPE html>
<html>
<head>
  <title>Donor Search Results</title>
  <link rel="stylesheet" href="search.css">
</head>
<body>


<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "blood_donation";

$conn = new mysqli($host,$user,$password,$database);

if ($conn->connect_error){
    die("Connection failed:".$conn->connect_error);
}

$city=$_POST['city'] ?? '';
$blood_group = $_POST['blood_group'] ?? '';



$sql="SELECT name, age, gender, city, blood_group, last_donation FROM donors WHERE  city = '$city' AND blood_group = '$blood_group' " ;
$result = $conn->query($sql);



echo "<h2>Search Results</h2>";
if($result->num_rows>0){
    echo "<table>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>City</th>
                <th>Blood_group</th>
                <th>last Donation</th>
            </tr>";
        

    while($row=$result->fetch_assoc()){
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['age']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['city']}</td>
                <td>{$row['blood_group']}</td>
                <td>{$row['last_donation']}</td>
            </tr>";
    }
    echo "</table>";
        
       
} else {
    echo "<p >No donors found .Try again with different filters.</p>";
}

    


$conn->close();
?>

</body>
</html>
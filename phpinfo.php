<!DOCTYPE html>
<html>
<body>
<?php

$con = mysqli_connect('cs4750.cs.virginia.edu','rm4mp','Niw6ogha','rm4mp');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"rm4mp");
$sql="SELECT * FROM BuildingLocations";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result)) {
    echo $row['roomN'].'<br/>';
}
mysqli_close($con);
?>

</body>
</html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="header.css">
</head>
<body>
<?php
include_once 'includes/header.php';
include 'includes/selectShoot.php';
// Connect to Photo Database
$con = mysqli_connect("127.0.0.1", "root", "teresa", "PhotoAccess");

// Check connection
if (mysqli_connect_errno()){echo "Failed to connect to MySQL: " . mysqli_connect_error();}

// Show Photo by id
if (isset($_POST['photo_id'])) {
    $id = $_POST['photo_id'];
    $result = mysqli_query($con, "SELECT * FROM Photos WHERE id = '" . $id . "'" );
    $loc = mysqli_fetch_array($result);

    if (isset($loc)) {
        $a = $loc[1];
        $b = $loc[2];
        echo "<img src='Shoots/" . $b . "/" . $a . "'>";
    }
    else {
        echo "image " . $id . " does not exist";
    }
}
// Show photos by shoot
if (isset($_POST['shoot_id'])) {
    $shoot_id = $_POST['shoot_id'];
    $result = mysqli_query($con, "SELECT * FROM Photos WHERE `Shoot id` = '" . $shoot_id . "'" );

    while ($row = mysqli_fetch_array($result)) {
        echo "<img src='Shoots/" . $row[2] . "/" . $row[1] . "'><br>";
    }
}

?>

<p>Enter the photo id:<br>
<form action='getPhoto.php' method='post'>
Id #: <input type='Integer' name='photo_id'><br>
<input type='submit'></p>
</form>

<br>
<p>Or select a photo shoot:</p>
<form action="getPhoto.php" method="post" name="shootForm">
<?php selectShoot($con, "shootForm"); ?>
<input type="submit" name="submit" value="submit">
</form>

</body>
</html>


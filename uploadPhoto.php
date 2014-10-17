<?php
include_once 'includes/header.php';
$con = mysqli_connect("localhost", "root", "teresa", "PhotoAccess");
if (mysqli_connect_errno()) {
    echo "Connection failed";
}

if (isset($_POST['submit'])) {
    echo ("FILE SUBMITTED maybe!! actually no promises <br>");


    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);
    $shoot_id = $_POST["shoot"];
    if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/png"))
        && in_array($extension, $allowedExts))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
        }
        else
        {
            echo "Upload: " . $_FILES["file"]["name"] . "<br>";
            echo "Type: " . $_FILES["file"]["type"] . "<br>";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

            if (file_exists("Shoots/" . $shoot_id ."/". $_FILES["file"]["name"]))
            {
                echo $_FILES["file"]["name"] . " already exists. ";
            }
            else
            {
                move_uploaded_file($_FILES["file"]["tmp_name"],
                    "Shoots/". $shoot_id . "/" . $_FILES["file"]["name"]);
                echo "Stored in: " . "Shoots/" . $shoot_id . $_FILES["file"]["name"];
                $filename = $_FILES["file"]["name"];
                mysqli_query($con, "INSERT INTO Photos VALUES ('NULL', '" . $filename . "', '" . $shoot_id . "')");
            }
        }
    }
    else
    {
        echo "Invalid file";
    }
}
?>

<form id="uploadForm" action="uploadPhoto.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file" id="file"><br>
</form>

<select form="uploadForm" name="shoot">

<?php

$result = mysqli_query($con, "SELECT * FROM Shoots");

while ($row = mysqli_fetch_array($result)) {
    echo "<option value=" . $row['id'] . ">" . $row['name'], "</option>";
}
?>

</select><br><br>
<input type="submit" name="submit" value="Submit" form="uploadForm">

</body>
</html>

<?php include_once('includes/footer.php');
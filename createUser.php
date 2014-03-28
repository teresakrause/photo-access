<html>
    <body>
        <?php
        if(isset($_POST['submit'])){
            if(empty($_POST['Username'])){
                echo "Please Enter a Username";
                include("includes/userForm.php");
            }
            elseif(empty($_POST['Password'])){
                echo "Please Enter a Password";
                include("includes/userForm.php");
            }
            elseif(empty($_POST['Firstname'])){
                echo "Please Enter Your First Name";
                include("includes/userForm.php");
            }
            elseif(empty($_POST['Lastname'])){
                echo "Please Enter Your Last Name";
                include("includes/userForm.php");
            }
            else{
                include('includes/db.php');

                $result = mysqli_query($con,"SELECT COUNT(username) FROM Users WHERE username='" . $_POST['Username'] . "'");
                $row = mysqli_fetch_array($result);
                if($row[0] != 0){
                    echo "Username is taken. Please try again.";
                    include("includes/userForm.php");
                }
                else{
                    mysqli_query($con,"INSERT INTO Users VALUES ('Null', '" . $_POST['Username'] . "', '" . md5($_POST['Password']) . "', '" . $_POST['Firstname'] . "', '" . $_POST['Lastname'] . "')");
                    echo "User has been created!";
                }

                mysqli_close($con);
            }
        }
        else{
            include("includes/userForm.php");
        } ?>
    </body>
</html>

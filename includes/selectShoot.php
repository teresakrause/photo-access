<?php

function selectShoot($con) {
    $result = mysqli_query($con, "SELECT * FROM Shoots");
    echo "<select name='shoot_id'>";
    while ($row = mysqli_fetch_array($result)) {
        echo "\n<option value='" . $row['id'] . "'>" . $row['name'], "</option>";
    }
    echo "</select>";
}

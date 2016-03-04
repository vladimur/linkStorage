<div>
    <p>Hello, this is the edit link page of linkStorage. Here you can edit your link.</p>
</div>

<?php

echo "<table>";

    foreach ($link as $key => $value) {

    echo "<tr>";

        if ($key != 'status' && $key != 'id') {
        echo "<td>" . $key . "</td><td>&nbsp;&nbsp;&nbsp;</td><td><input type='text' value ='" . $value, "' ></td>";
        }

        echo "</tr>";

    }

    echo "<td rowspan='2'>" . '<br><a href="">Save</a>' . "</td>";

    echo "<br>";

    echo "</table>";

?>
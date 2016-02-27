<div>
    <p>Hello, this is the main page of linkStorage. Here you can see all links, that was not signed as "private".</p>

    <?php

    foreach($links as $link) {

        echo "<table>";

        foreach( $link as $key => $value) {

            echo "<tr>";

            if ($key != 'status' && $key != 'id') {
                echo "<td>" . $key . "</td><td>&nbsp;&nbsp;&nbsp;</td><td>" .  $value, "</td>";
            }

            echo "</tr>";

        }
        echo "<br>";

        echo "</table>";

    }

    ?>

</div>

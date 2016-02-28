<div>
    <p>Hello, this is the you own page of linkStorage. Here you can see all your links.</p>

    <?php

    echo "-------------------------------------------";

    foreach($links as $link) {

        echo "<table>";

        foreach( $link as $key => $value) {

            echo "<tr>";

            if ($key != 'status' && $key != 'id') {
                echo "<td>" . $key . "</td><td>&nbsp;&nbsp;&nbsp;</td><td>" .  $value, "</td>";
            }

            echo "</tr>";

        }

        echo "<td rowspan='2'>" . '<a href="/user/edit_links">edit</a>' . "</td>";

        echo "<br>";

        echo "</table>";

        echo "-------------------------------------------";

    }

    ?>

</div>

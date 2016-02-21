<div>
    <p>Hello, this is the main page of linkStorage. Here you can see all links, that was not signed as "private".</p>

    <?php

        foreach($links as $link) {

            echo "<table>";

            foreach( $link as $key => $value) {

                echo "<tr>";

                if ($key != 'status' && $key != 'link_id') {
                    echo "<td>" . $key . "</td><td>&nbsp;&nbsp;&nbsp;</td><td>" .  $value, "</td>";
                }

                echo "</tr>";

            }
            echo "<br>";

            echo "</table>";

        }

    ?>

    <p>You also may <a href="/anon/registration">registration</a> or <a href="">login</a></p>

</div>

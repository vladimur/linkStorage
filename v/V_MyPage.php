<div>
    <p>Hello, this is the you own page of linkStorage. Here you can see all your links.</p>

    <?php

    if (empty($links)) {

        echo "You have no links, yet :(" . '<br>' . "To add you first links click " . '<a href="/user/add_links">here</a>';

    } else {

        echo "-------------------------------------------";

        foreach ($links as $link) {

            echo "<table>";

            foreach ($link as $key => $value) {

                echo "<tr>";

                if ($key != 'status' && $key != 'id') {
                    echo "<td>" . $key . "</td><td>&nbsp;&nbsp;&nbsp;</td><td>" . $value, "</td>";
                }

                echo "</tr>";

            }

            echo "<td rowspan='2'>" . '<a href="/user/edit_links/' . $link['id'] . '">edit</a>' . "</td>";

            echo "<br>";

            echo "</table>";

            echo "-------------------------------------------";

        }
    }
    ?>

</div>

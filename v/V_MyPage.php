<div>
    <p>Hello, this is the you own page of linkStorage. Here you can see all your links.</p>

    <a href="/user/add_links/">Add link</a>    <a href="/user/my_profile/">View my profile</a><br>

    <?php

    if ( empty( $links ) ) {

        echo "You have no links, yet :(" . '<br>' . "To add you first links click " . '<a href="/user/add_links">here</a>';

    } else {

        echo "-------------------------------------------";

        foreach ( $links as $link ) {

            echo "<table>";

            foreach ( $link as $key => $value ) {

                echo "<tr>";

                if ( $key == 'name' ) {
                    echo "<td>" . $key . "</td><td>&nbsp;&nbsp;&nbsp;</td><td><a class = 'name_link' href = '/user/view_links/" . $link['id'] . "'>" . $value, "</a></td>";
                }
                if ( $key != 'id' && $key != 'name' ) {

                    echo "<td>" . $key . "</td><td>&nbsp;&nbsp;&nbsp;</td><td>" . $value, "</td>";
                }

                echo "</tr>";

            }

            echo "<td rowspan='3'>" . '<a href="/user/edit_links/' . $link['id'] . '">edit</a>&nbsp;<a href="/user/delete_links/' . $link['id'] . '">delete</a>' . "</td>";

            echo "<br>";

            echo "</table>";

            echo "-------------------------------------------";

        }
    }
    ?>

</div>

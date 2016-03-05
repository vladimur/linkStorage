<div id = "v_profile">
    <p>Hello, this is the you profile page of linkStorage. Here you can see you profile.</p>

    <?php

        echo "<table>";

        foreach ( $user as $key => $value) {

                echo "<tr>";

                if ( !in_array( $key, array('id', 'status', 'password') ) ) {
                    echo "<td>" . $key . "</td><td>&nbsp;&nbsp;&nbsp;</td><td>" . $value, "</td>";
                }

                echo "</tr>";

        }

        echo "<td rowspan='3'>" . '<a href="/user/edit_my_profile/' . $user['id'] . '">edit</a></td>';

        echo "<br>";

        echo "</table>";

    ?>

</div>

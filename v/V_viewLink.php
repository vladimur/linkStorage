<div id = "v_viewLinks">
    <p>Hello, this is the view link page of linkStorage. Here you can see detail of your link.</p>

<?php

    echo "<table>";

        foreach ( $link as $key => $value ) {

        echo "<tr>";

            if ( $key == 'name' ) {
            echo "<td>" . $key . "</td><td>&nbsp;&nbsp;&nbsp;</td><td><a class = 'name_link' href = '/user/view_links'>" . $value, "</a></td>";
            }
            if ( $key != 'id' && $key != 'name') {
            echo "<td>" . $key . "</td><td>&nbsp;&nbsp;&nbsp;</td><td>" . $value, "</td>";
            }

            echo "</tr>";

        }

        echo "<td rowspan='3'>" . '<a href="/user/edit_links/' . $link['id'] . '">edit</a>&nbsp;<a href="/user/delete_links/' . $link['id'] . '">delete</a>' . "</td>";

        echo "<br>";

        echo "</table>";

?>

</div>

<div id = "v_addLinks">
    <p>Hello, this is the add link page of linkStorage. Here you can add your link.</p>

    <?php
    if ( isset( $_SESSION['link_add_success'] ) && $_SESSION['link_add_success'] ) {
        echo '<p>Your link was added</p>';
        unset($_SESSION['link_add_success']);
    }
    ?>

    <form id = "editLink" name = "editLink" method="post">

        <div><div class = "editLink_name">Name</div>       <div class = "reg_form_input"><input    name = "name"        placeholder = "Введите название ссылки" type="text" required></div></div>
        <div><div class = "editLink_name">Address</div>    <div class = "reg_form_input"><input    name = "address"     placeholder = "Введите адрес ссылки"    type="text" required></div></div>
        <div><div class = "editLink_name">Description</div><div class = "reg_form_input"><textarea name = "description" placeholder = "Введите описание ссылки"          ></textarea></div></div>

        <div>
            <div class = "editLink_name crutch">Status</div>

            <div class = "reg_form_input">

                <input type="radio" id = "private" name="status" value="private" > <label for="private">private</label>
                <input type="radio" id = "public"  name="status" value="public"  > <label for="public" >public </label>

            </div>
        </div>


        <div id = "button"><button type="submit">Save</button></div>

    </form>
</div>

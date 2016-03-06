<div id = "v_editLinks">
    <p>Hello, this is the edit link page of linkStorage. Here you can edit your link.</p>

    <?php
        if ( isset( $success ) && $success ) {
            echo '<p>Your change was saved</p>';
            unset( $_SESSION['link_edit_success'] );
        }
    ?>

    <form id = "editLink" name = "editLink" method="post">

        <div><div class = "editLink_name">Name</div>   <div class = "reg_form_input"><input name = "name"    placeholder = "Введите название ссылки" value="<?=$link['name']?>"    type="text" required></div></div>
        <div><div class = "editLink_name">Address</div><div class = "reg_form_input"><input name = "address" placeholder = "Введите адрес ссылки"    value="<?=$link['address']?>" type="text" required></div></div>

        <div>
            <div class = "editLink_name">Description</div>
            <div class = "reg_form_input">
                <textarea name = "description" placeholder = "Введите описание ссылки"><?=$link['description']?></textarea>
            </div>
        </div>

        <div>
            <div class = "editLink_name" id = "crutch">Status</div>

            <div class = "reg_form_input">

                <input type="radio" id = "private" name="status" value="private" <?php if ( $link['status'] == 'private' ) {echo 'checked'; } ?> > <label for="private">private</label>
                <input type="radio" id = "public"  name="status" value="public"  <?php if ( $link['status'] == 'public' )  {echo 'checked'; } ?> > <label for="public">public</label>

            </div>
        </div>


        <div id = "button"><button type="submit">Save</button></div>

    </form>
</div>

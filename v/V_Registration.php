<?php

    var_dump($_POST);

?>


<div id = "v_registration">
    <p>Hello, this is the registration page of linkStorage. Here you can sign up.</p>

    <form id = "registr_form" method="post">

        <div>
            <div class = "reg_form_item_name">Имя *</div>
            <div class = "reg_form_item_input"><input name = "first_name" type="text" required></div>
        </div>

        <div>
            <div class = "reg_form_item_name">Фамилия</div>
            <div class = "reg_form_item_input"><input name = "last_name" type="text"></div>
        </div>

        <div>
            <div class = "reg_form_item_name">E-mail *</div>
            <div class = "reg_form_item_input"><input name = "e-mail" type="email" required></div>
        </div>

        <div>
            <div class = "reg_form_item_name">Логин *</div>
            <div class = "reg_form_item_input"><input name = "login" type="text" required></div>
        </div>

        <div>
            <div class = "reg_form_item_name">Пароль *</div>
            <div class = "reg_form_item_input"><input name = "password" type="password" required  id = "password1"></div>
        </div>

        <div>
            <div class = "reg_form_item_name">Подтвердите пароль *</div>
            <div class = "reg_form_item_input"><input name = "re-password" type="password" required  id = "password2"></div>
        </div>

        <div id = "error_pass"></div>

        <div id = "button"><button id = "submit_form" onclick="checkPass()">Зарегистрироваться</button></div>

    </form>



</div>

<?php

    if (!$error)
    {
         
    }

?>

<div id = "v_registration">
    <p>Hello, this is the registration page of linkStorage. Here you can sign up.</p>

    <form id = "registr_form" name = "registration" method="post">

        <div><div class = "reg_form_name">Имя *</div>               <div class = "reg_form_input"><input name = "first_name"  placeholder = "Введите своё имя" type="text" required></div></div>
        <div><div class = "reg_form_name">Фамилия</div>             <div class = "reg_form_input"><input name = "last_name"   placeholder = "Введите свою фамилию" type="text"></div></div>
        <div><div class = "reg_form_name">E-mail *</div>            <div class = "reg_form_input"><input name = "e-mail"      placeholder = "Введите свой e-mail" type="email" required></div></div>
        <div><div class = "reg_form_name">Логин *</div>             <div class = "reg_form_input"><input name = "login"       placeholder = "Введите логин" type="text" required></div></div>
        <div><div class = "reg_form_name">Пароль *</div>            <div class = "reg_form_input"><input name = "password"    placeholder = "Введите пароль" type="password" required id = "password1"></div></div>
        <div><div class = "reg_form_name">Подтвердите пароль *</div><div class = "reg_form_input"><input name = "re-password" placeholder = "Подтвердите пароль" type="password" required id = "password2"></div></div>

        <div id = "error_pass"></div>

        <div id = "button"><button id = "submit_form" onclick="checkPass()">Зарегистрироваться</button></div>

    </form>
</div>

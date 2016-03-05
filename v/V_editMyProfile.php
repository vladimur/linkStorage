<div id = "v_editMyProfile">
    <p>Hello, this is the edit link page of linkStorage. Here you can edit your link.</p>

    <form id = "registr_form" name = "editLink" method="post">

        <div><div class = "editLink_name">First Name</div><div class = "reg_form_input"><input name = "first_name" placeholder = "Введите имя"     value="<?=$user['first_name']?>" type="text"  ></div></div>
        <div><div class = "editLink_name">Last Name</div> <div class = "reg_form_input"><input name = "last_name"  placeholder = "Введите фамилию" value="<?=$user['last_name']?>"  type="text"  ></div></div>
        <div><div class = "editLink_name">Login</div>     <div class = "reg_form_input"><input name = "login"      placeholder = "Введите логин"   value="<?=$user['login']?>"      type="text"  ></div></div>
        <div><div class = "editLink_name">E-mail</div>    <div class = "reg_form_input"><input name = "e_mail"     placeholder = "Введите e-mail"  value="<?=$user['e_mail']?>"     type="email" ></div></div>

        <div><div class = "reg_form_name">Пароль</div>            <div class = "reg_form_input"><input name = "password"    placeholder = "Введите пароль"     type="password" id = "password1"></div></div>
        <div><div class = "reg_form_name">Подтвердите пароль</div><div class = "reg_form_input"><input name = "re-password" placeholder = "Подтвердите пароль" type="password" id = "password2"></div></div>

        <div id = "error_pass"></div>

        <div id = "button"><button id = "submit_form" onclick="checkPass()">Save</button></div>

    </form>
</div>

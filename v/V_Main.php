<!DOCTYPE html>
<html>
<head>
    <title>linkStorage</title>
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>style.css" />
    <script src="/js/registratino.js"></script>
    <script src="/js/jquery.js"></script>
</head>

<body>

<nav>

    <a href="/">Main Page</a>

    <?php
    if ($_SESSION['sid']) {
    ?>
        <a href="/user/own_page">My Page</a>
        <a href="/user/logout">Log out</a>
    <?php
    } else {
    ?>
        <a href="/anon/login">Login</a>
        <a href="/anon/registration">Registration</a>
    <?php
    }
    ?>


</nav>

<div id = "content">
    <?=$content;?>
</div>

</body>
</html>
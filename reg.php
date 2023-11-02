<?
session_start();

if(!empty($_SESSION['login']))
{
    echo 'Hello '.$_SESSION['login'];
}

if ($_POST['auth']) {

    $login = $_POST['login'];
    $pass = $_POST['pass'];

    if (!empty($login) and !empty($pass)) {
        $db = @new mysqli('localhost', 'root', '', 'shop');
        if ($db->connection_errno) {
            echo "error: " . $db->connection_errno;
        } else {

            $query = $db->query("SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass' ");

            $row = $query->fetch_assoc();
            var_dump($row);
        }
    }

}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>
        Регистрация
    </h1>

    <?if($_SESSION['auth'] != true){?>
    <form method="post">

        <input type="text" name="login" required>
        <input type="password" name="pass" required>
        <input type="submit" value="Войти" name="auth">
    </form>
    <?}?>
    <a href=""></a>

</body>

</html>
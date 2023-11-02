<?
session_start();

if(!empty($_SESSION['login']))
{
    echo 'Hello '.$_SESSION['login'];
}

if ($_POST['auth']) {
    $anim = $_POST['new_animal'];

    $login = $_POST['login'];
    $pass = $_POST['pass'];

    if (!empty($login) and !empty($pass)) {
        $db = @new mysqli('localhost', 'root', '', 'shop');
        if ($db->connection_errno) {
            echo "error: " . $db->connection_errno;
        } else {

            $query = $db->query("SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass' ");
            //INSERT INTO `users`(`id`, `login`, `pass`, `email`, `name`) 
            //VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')
            $query = $db->query("INSERT INTO `zoo`(`animal`) VALUES ('$anim')");
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

        <input type="text" name="n_login" placeholder='логин' required >
        <input type="password" name="n_pass" placeholder='пароль' required>
        <input type="email" name="n_email" placeholder='email' required >
        <input type="name" name="n_name" placeholder='имя' required >
        <input type="submit" value="Зарегестрироваться" name="auth">
    </form>
    <?}?>
    <a href=""></a>

</body>

</html>
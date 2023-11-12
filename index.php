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
            $pass=md5($pass);
            $query = $db->query("SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass' ");
            if($query->num_rows > 0){
                $row = $query->fetch_assoc();
                $_SESSION['auth'] = true;
                $_SESSION['login'] = $login;
                $_SESSION['role'] = $row['role'];
                header('Location: /tovar.php');
            } else{
                echo 'неверные данные';
            }
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

    <form method="post">

        <input type="text" name="login" placeholder='логин' required>
        <input type="password" name="pass" placeholder='пароль' required>
        <input type="submit" value="Войти" name="auth">
    </form>

    <a href="reg.php">Регистрация</a>

    <?if($_SESSION['auth'] == true){?>
    <a href="desroy.php">Выход</a>
    <?}?>


</body>

</html>
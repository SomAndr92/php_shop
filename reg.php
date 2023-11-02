<?
session_start();

if(!empty($_SESSION['login']))
{
    echo 'Hello '.$_SESSION['login'];
}

if ($_POST['auth']) {

    $new_login = $_POST['n_login'];
    $new_pass = $_POST['n_pass'];
    $new_email = $_POST['n_email'];
    $new_name = $_POST['n_name'];

    if (!empty($new_login) and !empty($new_pass) and !empty($new_email) and !empty($new_name)) {
        $db = @new mysqli('localhost', 'root', '', 'shop');
        if ($db->connection_errno) {
            echo "error: " . $db->connection_errno;
        } else {
            echo ("aaa");

            //$query = $db->query("SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass' ");
            //INSERT INTO  
            //VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')
            $query = $db->query("INSERT INTO `users`(`login`, `pass`, `email`, `name`) 
            VALUES ('$new_login', '$new_pass', '$new_email', '$new_name')");          
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
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
        <input type="submit" value="Зарегистрироваться" name="auth">
    </form>
    <?}?>

</body>

</html>
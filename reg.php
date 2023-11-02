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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <div class="col-md-4 mx-auto">
    <h1>
        Регистрация
    </h1>

    <?if($_SESSION['auth'] != true){?>
    <form method="post" class="">

        <input type="text" class="form-control" name="n_login" placeholder='логин' required >
        <input type="password" class="form-control" name="n_pass" placeholder='пароль' required>
        <input type="email" class="form-control" name="n_email" placeholder='email' required >
        <input type="name" class="form-control" name="n_name" placeholder='имя' required >
        <input type="submit" class="btn btn-success mx-auto" value="Зарегистрироваться" name="auth">
    </form>
    <?}?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>
<?
session_start();

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
if ($_POST['reg']) {
    header('Location: /reg.php');
}

if ($_POST['exit']) {
    if($_SESSION['auth'] == true){    
    header('Location: /desroy.php');
}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Стартовая страница</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body style="background-color:#c7c7c7;">
<nav class="navbar bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand">ЛОГО</a>
   <? if(!empty($_SESSION['login'])){?>
   
    <form method="post" class="d-flex" role="search">
      <div class="me-2 gy-1">
      <i class="fa-solid fa-user fa-lg" style="color: #404a40;"></i>
        <?  echo $_SESSION['login'];
      ?></div>
      <input class="btn btn-outline-warning" type="submit" name="exit" value="Выход">
    </form><?
}?>
  </div>
</nav>
<div class="container">
<div  class="row justify-content-md-center fs-2"> Добро пожаловать в наш магазин</div>
    <div class="col-md-4 mx-auto">
    
        <form method="post" class="row justify-content-md-center col-md-auto gy-1">

        <input type="text" class="form-control" name="login" placeholder='логин' required>
        <input type="password" class="form-control" name="pass" placeholder='пароль' required>
        <input type="submit" class="col-md-auto btn btn-outline-success" value="Войти" name="auth">
        <input type="submit" class="col-md-auto btn btn-outline-primary" value="Регистрация" name="reg">
    </form>

    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>
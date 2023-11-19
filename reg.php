<?
session_start();
include 'dbconnect.php';
if ($_POST['auth']) {

    $new_login = $_POST['n_login'];
    $new_pass = $_POST['n_pass'];
    $new_email = $_POST['n_email'];
    $new_name = $_POST['n_name'];

    if (!empty($new_login) and !empty($new_pass) and !empty($new_email) and !empty($new_name)) {
        $db = dbconn();
            $new_pass=md5($new_pass);
            $query = $db->query("INSERT INTO `users`(`login`, `pass`, `email`, `name`) 
            VALUES ('$new_login', '$new_pass', '$new_email', '$new_name')");  
            //проверка на не совпадение логинов
            if($query) 
            {
                header("location: /");
            } else{
                echo 'логин уже существует';
            }      
        }
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
    <title>Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body >
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
    <div class="col-md-4 mx-auto">
        <div  class="row justify-content-md-center fs-2"> Регистрация</div>
        
    

    <?if($_SESSION['auth'] != true){?>
    <form method="post" class="row justify-content-md-center gy-1">

        <input type="text" class="form-control" name="n_login" placeholder='логин' required >
        <input type="password" class="form-control" name="n_pass" placeholder='пароль' required>
        <input type="email" class="form-control" name="n_email" placeholder='email' required >
        <input type="name" class="form-control" name="n_name" placeholder='имя' required >
        <input type="submit" class="btn btn-primary col-md-auto" value="Зарегистрироваться" name="auth">
    </form>
    <?}?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>
<?
session_start();

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
    <title>Товары</title>
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
   
    <form method="post" class="d-flex" >
    
      <div class="me-2">
      <i class="fa-solid fa-user fa-lg" style="color: #404a40;"></i>
        <?  echo $_SESSION['login'];
      ?></div>
      
      <input class="btn btn-outline-warning" type="submit" name="exit" value="Выход">
    </form><?
}?>
  </div>
</nav>  
<div class="container"> 
<div class="row">

<?php

        $db = @new mysqli('localhost', 'root', '', 'shop');
        if ($db->connection_errno) {
            echo "error: " . $db->connection_errno;
        } else {
            
            $query = $db->query("SELECT * FROM `товары`");
            while($row=$query->fetch_assoc())
            {
            ?>
            <div class="col-md-3">
                <?=$row['Наименование']?>
                <br>
            <a href ="user.php?id=<?=$row['id']?>" class="btn btn-primary">Подробнее</a>
            </div>
            <?
            }
            if($_SESSION['role'] == 'admin'){?>
                <a href ="new_prod.php?id=<?=$row['id']?>" class="btn btn-outline-success col-md-2 ">Добавить новый товар</a> <?
             }
        }
?>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>

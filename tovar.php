<?
session_start();
?>
<?if($_SESSION['role'] == 'admin'){
    
       echo 'You admin';   
    }
    else{
        echo 'hello user';
    }?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="box">

<?php

        $db = @new mysqli('localhost', 'root', '', 'shop');
        if ($db->connection_errno) {
            echo "error: " . $db->connection_errno;
        } else {
            
            $query = $db->query("SELECT * FROM `товары`");
            while($row=$query->fetch_assoc())
            {
            ?>
            <div class="tovar">
                <?=$row['Наименование']?>
                <br>
            <a href ="user.php?id=<?=$row['id']?>">Подробнее</a>
            </div>
            <?
            }
            if($_SESSION['role'] == 'admin'){?>
    
                <a href ="new_prod.php?id=<?=$row['id']?>">Добавить новый товар</a> <?
             }
        }
?>
</div>


</body>
</html>

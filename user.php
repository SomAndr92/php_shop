<?php

if($_GET)
{
        $id = $_GET['id'];
        $db = @new mysqli('localhost', 'root', '', 'shop');
        if ($db->connection_errno) {
            echo "error: " . $db->connection_errno;
        } else {
            $query = $db->query("SELECT * FROM `товары` WHERE `id`='$id'");
            while($row=$query->fetch_assoc())
            {
            
                echo $row['Наименование'].'<br>';
                echo $row['Цена'].'<br>';
                echo $row['Характеристики'].'<br>';
                echo $row['Описание'].'<br>';
                ?><img src="<?=$row['фото']?>" alt="">
                <?
            }
        }
    }
?>



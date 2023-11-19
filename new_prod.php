<?
session_start();
include 'dbconnect.php';
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
    <title>Добавление нового товара</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
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
 <div  class="row justify-content-md-center fs-2"> Добавление нового товара</div>
<form method="post" class="row  gy-1" enctype="multipart/form-data">
<div class="col-md-4">
<input type="text" class="form-control col-md-4" name="name" placeholder='Наименование' required>
</div>
<div class="col-md-4">
<input type="text" class="form-control col-md-4" name="price" placeholder='Цена' required>
</div>
<div class="col-md-4">
<input type="text" class="form-control col-md-4" name="characteristics" placeholder='Характеристики' required>
</div>
<div class="col-md-12">
<textarea type="text" class="form-control" name="description" aria-label="Имя" rows="5" required> </textarea>
</div>
<div class="col-md-12">   
<input type="file" class="form-control" name="photo" required>
</div>
<div class="col-md-4">
<input type="submit" class="btn btn-outline-primary" value="Добавить" name="auth">
</div>
</form>

<?
if ($_POST['auth']) {

$name = $_POST['name'];
$price = $_POST['price'];
$characteristics = $_POST['characteristics'];
$description = $_POST['description'];

if (!empty($name) and !empty($price) and !empty($characteristics) and !empty($description)) {
    $db = dbconn();
        $uploaddir = 'files/';
    $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
        echo 'ok';
      } else {
          echo "ne ok";
      }
        $query = $db->query("INSERT INTO `товары`(`Наименование`, `Цена`, `Характеристики`, `Описание`, `Фото`) 
        VALUES ('$name','$price','$characteristics','$description','$uploadfile')");  
        //проверка на не совпадение товаров
        if($query) 
        {
            echo 'Товар добавлен';
        } else{
            echo 'Такой товар уже существует';
        }      
    }
}


?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>

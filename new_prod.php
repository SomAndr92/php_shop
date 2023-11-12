<?
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <link rel="stylesheet" href="style.css">
</head>
<body style="background-color:#c7c7c7;">
    
<form method="post" enctype="multipart/form-data">

<input type="text" name="name" placeholder='Наименование' required>
<input type="text" name="price" placeholder='Цена' required>
<input type="text" name="characteristics" placeholder='Характеристики' required>
<input type="text" name="description" placeholder='Описание' required>
<input type="file" name="photo" required>
<input type="submit" value="Добавить" name="auth">
</form>
<?
if ($_POST['auth']) {

$name = $_POST['name'];
$price = $_POST['price'];
$characteristics = $_POST['characteristics'];
$description = $_POST['description'];

if (!empty($name) and !empty($price) and !empty($characteristics) and !empty($description)) {
    $db = @new mysqli('localhost', 'root', '', 'shop');
    if ($db->connection_errno) {
        echo "error: " . $db->connection_errno;
    } else {
        $uploaddir = 'files/';
    $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
        echo 'ok';
      } else {
          echo "ne ok";
      }
        $query = $db->query("INSERT INTO `товары`(`Наименование`, `Цена`, `Характеристики`, `Описание`, `Фото`) 
        VALUES ('$name','$price','$characteristics','$description','$uploaddir')");  
        //проверка на не совпадение товаров
        if($query) 
        {
            echo 'Товар добавлен';
        } else{
            echo 'Такой товар уже существует';
        }      
    }
}
}


?>
</div>


</body>
</html>

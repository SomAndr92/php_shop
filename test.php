<?
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" id="TextForm">
        <input type="text" name="addText" id="addText">
    </form>
    <button id="add">Тыцк</button>

    <?if($_SESSION['role'] == 'admin'){?>
    <div>
        You admin
    </div>
    <?}
    else{
        echo 'hello user';
    }?>
    <script>
        let btn = document.getElementById("add");

        btn.addEventListener("click", () => {
            let form =document.getElementById("TextForm")
            let formData = new FormData(form);
            fetch('/Update.php', {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data =>{
                console.log(data);
            })
        })
    </script>
</body>
</html>


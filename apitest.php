<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<input type="text" name="login" id="login" placeholder="login">
<input type="text" name="pass" id="pass" placeholder="pass">
<input type="text" name="email" id="email" placeholder="email">
<input type="text" name="name" id="name" placeholder="name">

<button id="btn">Клин</button>

<script>
    let btn=document.getElementById("btn");

    btn.addEventListener("click",()=>{
        let login = document.getElementById("login").value;
        let pass = document.getElementById("pass").value;
        let email = document.getElementById("email").value;
        let name = document.getElementById("name").value;
        let json = JSON.stringify({
            "action":"reg",
            "payload":{
                "login":login,
                "pass":pass,
                "name":name,
                "email":email,
            }
        });
        console.log(json);
        fetch("http://localhost/apishop.php", {
            method: 'POST',
            body: json,
        })
        .then(response => response.json())
        .then(data => {

            //console.log(data);
          alert("Успешная регистрация")
        })
        .catch(error =>{
            console.log(error);
        })
    })
</script>

</body>
</html>
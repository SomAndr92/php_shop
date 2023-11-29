<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container"> 
 <div class="row" id="users">


 </div> 
 </div> 
<script>
let json = JSON.stringify({

"action":"getStuff",
        "payload":{
            
        }
    });
    
  
    console.log(json);
    fetch("http://localhost/apishop.php", {
        method: 'POST',
        body: json,
    })
    .then(response => response.json())
    .then(data => {
        let users = document.getElementById("users");
        
        data.forEach(element => {
            console.log(element['фото']);
            users.innerHTML += 
                                    "<div class='col gy-2 '>"+
                                     "<div class='name mb-3'>"+element['Наименование']+"</div>" + 
                                     "<div class='box1'>"+"<img class='jpgr' src='"+ element['фото']+"'</div>"+
                                     "<div class='small_box'>"+ 
                                     "<div>"+ element['Цена']+"</div>"+
                                     "</div>"+
                                     
                                     "</div>"; //верстку сюда
        });

       
    })
    .catch(error =>{
        console.log(error);
    })

</script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"  media="screen"/>
    <title>CRUD tenis</title>
</head>
<body>
    <form action="Cliente.php" method="post">
    <h1>Acciones posibles:</h1>
    <h3>
    1.Agregar tenis<br>
    2.Modificar tenis<br>
    3.Eliminar tenis<br>
    4.Ver tenis<br>
    </h3>
            <h4>Accion: </h4>  
            <input type="text" name="accion"><br>
            <h4>id_tenis:</h4>
            <input type="text" name="id_tenis"><br>
            <h4>modelo:  </h4>  
            <input type="text" name="modelo"><br>
            <h4>color: </h4>    
            <input type="text" name="color"><br>
            <h4>existencia:</h4>
            <input type="text" name="existencia"><br>
            

            <input type="submit" name="Enviar">
</body>
</html>
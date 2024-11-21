
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/loaderpag.css">
    <link rel="shortcut icon" href="img/logox.ico" type="x-icon">
    <link rel="preload" href="img/fondoN.jpg" as="image">
</head>
<body>
<script src="js/load.js"></script> <!--SCRIPT DEL LOADER -->  
<div id="loading">
        <div class="loader">
            <h1>Jeser Etiquetas</h1>
        </div>
    </div><!--DIV DEL LOADER-->
    <div class="container container-xs tamañologin">
    <div class="card w-80 colorfondologin ">
        <img src="img/logojeser.png" alt="Logo" class="card-img-top">
            <div class="card-body"> 
                <form method="POST" action="php/login.php"> 
                    <div class="form-group">
                       <label for="usuario" class="textocampos">Usuario:</label>    
                       <input type="text" class="form-control" id="usuario" name="usuario" required>
                    </div>
                    <div class="form-group">    
                       <label for="contrasena" class="textocampos">Contraseña:</label>   
                       <input type="password" class="form-control" id="contrasena" name="contrasena" required>  
                    </div>
                    <button type="submit" class="btn btn-primary submit textocampos" style="margin-top: 5px;">Iniciar sesión</button>
                </form>
                <div class="card-footer colorfooter">
                   <p class="card-text textocampos">¿Olvidaste la contraseña? <a href="" class="card-link link">Recuperar</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
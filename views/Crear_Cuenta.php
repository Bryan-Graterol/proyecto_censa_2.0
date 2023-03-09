<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/crear_cuenta.css">
    <title>Login</title>
</head>
<body>
    <div class="Crear-container">
        <div class="Crear-info-container">
            <h1 class="title">Crear cuenta</h1>
            <form class="inputs-container" action="" method="post">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="">
                <label for="apellido">apellido</label>
                <input type="text" name="apellido" id="">
                <label for="gmail">Gmail</label>
                <input type="email" name="gmail" id="" required>
                <label for="ti">Documento</label>
                <input type="number" name="ti" id="" required>
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="" required>
                <?php 
                    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {               
                        echo "<h4>".$_SESSION['error']."</h4>";
                        unset($_SESSION['error']);
                    }
                ?>
                <button class="btn">Crear</button>
            </form>
        </div>
        <img class="image-container" src="views/img/login.svg" alt="">
    </div>
</body>
</html>
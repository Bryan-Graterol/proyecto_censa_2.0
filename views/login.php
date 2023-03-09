<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="views/css/iniciar_session.css">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <div class="login-info-container">
            <h1 class="title">Login</h1>    
            <form class="inputs-container" action="" method="post">
                <?php 
                    if (isset($_SESSION['errorLogin']) && !empty($_SESSION['errorLogin'])) {               
                        echo "<h4>".$_SESSION['errorLogin']."</h4>";
                        unset($_SESSION['errorLogin']);
                    }
                ?>
                <input class="input" type="text" placeholder="Username" name="username">
                <input class="input" type="password" placeholder="Password" name="password">
                <button class="btn">login</button>
            </form>
        </div>
        <img class="image-container" src="views/img/login.svg" alt="">
    </div>
</body>
</html>
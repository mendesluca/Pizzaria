<?php

    @include 'config.php';

    if(isset($_POST['submit'])){

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = md5($_POST['password']);
        $cpass = md5($_POST['cpassword']);

        $select = " SELECT * FROM user_form WHERE email = '$email'";
        
        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0){
            $error[] = 'Usuário Já Existe!';

        }else{
            if ($pass != $cpass) {
                $error[] = 'As senhas não coincidem';
            }else{
                $insert = "INSERT INTO user_form(name, email, password) VALUES('$name','$email','$pass')";
                mysqli_query($conn, $insert);
                header('location:login_form.php');
            }
        }
        
};

?>

<!DOCTYPE html>
<html>

<head>
    <title>Pizzaria Delícia</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Complatible" content="IE=edge">

    <!-- -----------CSS------------ -->
    <link rel=" stylesheet" href="../css/form.css">
    <!-- -----------CSS------------ -->

</head>

<body>

    <div class="form-container">
        <form action="" method="post">
            <h3>Faça seu Cadastro</h3>
            <?php
            
                if(isset($error)){
                    foreach ($error as $error ) {
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
            ?>

            <input type="text" name="name" required placeholder="Ex: João Pedro">
            <input type="email" name="email" required placeholder="Ex:pizzaria@gmail.com">
            <input type="password" name="password" required placeholder="Insira sua senha">
            <input type="password" name="cpassword" required placeholder="Insira sua senha">
            <input type="submit" name="submit" value="registrar" class="form-btn">
            <p>Já tem uma conta? <a href="login_form.php">Faça seu Login</a></p>
        </form>

    </div>
</body>

</html>
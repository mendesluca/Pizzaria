<?php

    @include 'config.php';

    session_start();

    if(isset($_POST['submit'])){

        
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = md5($_POST['password']);
        
        $select = " SELECT * FROM user_form WHERE email = '$email' && password ='$pass'  ";

        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);

            if ($row['user_type'] == 'admin') {
                $_SESSION['admin_name'] = $row['name'];
                header('location:admin_page.php');
            }elseif($row['user_type'] == 'user') {
                $_SESSION['user_name'] = $row['name'];
                header('location:index.php');
            }
        }else {
            $error[] = 'Email ou Senha Incorretos';
        }
        
        
};

?>

<!DOCTYPE html>
<html>

<head>
    <title>Pizzaria Delícia</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- -----------CSS------------ -->
    <link rel="stylesheet" href="../css/form.css">
    <!-- -----------CSS------------ -->

</head>

<body>

    <div class="form-container">
        <form action="" method="post">
            <h3>Faça seu Login</h3>
            <?php
            
            if(isset($error)){
                foreach ($error as $error ) {
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>
            <input type="email" name="email" required placeholder="Ex:pizzaria@gmail.com">
            <input type="password" name="password" required placeholder="Insira sua senha">

            <input type="submit" name="submit" value="Entrar" class="form-btn">
            <p>Não tem uma conta? <a href="cadastro_form.php">Faça seu Cadastro</a></p>
        </form>

    </div>
</body>

</html>
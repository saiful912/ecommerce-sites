
<?php
session_start();
$message=null;
$type='success';
if (isset($_POST['loggin'])){
    $email=strtolower(trim($_POST['email']));
    $password=trim($_POST['password']);
require_once 'database/connection.php';
$query='SELECT first_name,last_name,username,email,password,photo,email_verification_token,email_verified_at,active,role FROM users WHERE email=:email';
$stmt=$connection->prepare($query);
$stmt->bindParam(':email',$email);
$stmt->execute();
$user=$stmt->fetch();
if ($user){
    if (password_verify($password,$user['password'])===true){
        $_SESSION['id']=$user['id'];
        $_SESSION['email']=$user['email'];
        $message='User logged in .';
        header('Location: index.php');
    }else{
        $message='Invailed credentials';
        $type='danger';
    }
}else{
    $message='User not found';
    $type='danger';
}

}

?>


<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Loggin From</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php if (isset($message)):?>
        <div class="alert alert-<?php echo $type;?>">
            <?php echo $message ?>
        </div>
    <?php endif; ?>
    <form class="form-signin" action="" method="post" enctype="multipart/form-data">
        <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Logg In</h1>
        <label for="inputEmail" class="sr-only ">Email address</label>
        <input type="email" id="inputEmail" class="form-control " name="email" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control mt-3" name="password" placeholder="Password" required >
        <button class="btn btn-lg btn-primary btn-block mt-5 " type="submit" name="loggin">Loggin</button>
        <p class="mt-5 mb-3 text-muted">@2019-2021</p>
    </form>
</div>
</body>
</html>
<?php
session_start();
require_once 'database/connection.php';
?>
<?php require_once '_header.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php if (isset($_SESSION['type'], $_SESSION['message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?>">
            <?php echo $_SESSION['message']; ?>
        </div>
        <?php unset($_SESSION['type'], $_SESSION['message']); ?>
    <?php endif; ?>

    <form class="form-signin" action="user_register.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-6">
                <p class="text-center font-weight-bolder"><h4>Create an account</h4></p>
            </div>
        </div>

        <h1 class="h3 mb-3 font-weight-normal">Register</h1>
        <label for="inputFirstName" class="sr-only">First Name</label>
        <input type="text" id="inputFirstName" class="form-control w-50" name="first_name" placeholder="First Name"
               required>

        <label for="inputLastName" class="sr-only">Last Name</label>
        <input type="text" id="inputLastName" class="form-control mt-2  w-50" name="last_name" placeholder="Last Name"
               required>

        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="inputUsername" class="form-control mt-2  w-50" name="username" placeholder="Username"
               required>

        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control mt-2  w-50" name="email" placeholder="Email address"
               required>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control mt-2  w-50" name="password" placeholder="Password"
               required>

        <label for="inputPhoto" class="sr-only">Photo</label>
        <input type="file" name="photo" class="form-control mt-2  w-50" required>

        <button class="btn btn-lg btn-primary btn-block mt-2  w-50" type="submit" name="register">Register</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
    </form>
</div>
</body>
<?php require_once '_footer.php'; ?>
</html>
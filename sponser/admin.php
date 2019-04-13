<?php
$title="register";
require_once "../database/connection.php";
$message=false;
if(isset($_POST['register'])){
    $username = trim($_POST['username']);
    $email = trim(strtolower($_POST['email']));
    $password = trim($_POST['password']);
    $password = password_hash($password, PASSWORD_BCRYPT);
    if(!empty($_FILES['files']['tmp_name'])){
        $name=$_FILES['files']['name'];
        $file_parts=explode('.',$name);
        $last_parts=end($file_parts);
        $new_file_name = uniqid('pp_',true).time().'.'.$last_parts;
        move_uploaded_file($_FILES['files']['tmp_name'],'uploads/profile_photo/'.$new_file_name);
    }
    $sql = 'INSERT INTO admin (`username`,`email`,`password`,`files`) VALUES (:username,:email,:password,:files)';
    $stmt=$connection->prepare($sql);
    $stmt->bindParam(':username',$username);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':password',$password);
    $stmt->bindParam(':files',$new_file_name);
    $response=$stmt->execute();
    if($response){
        $message="success";
    }else{
        $message='unsucess';
    }
}
require_once 'partials/__header.php'; ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 ">
            <div class="card mt-lg-5 mb-lg-5">
                <div class="card-body">
                    <?php if ($message): ?>
                        <div class="alert alert-success">

                            <?php echo $message; ?>
                        </div>
                    <?php endif ; ?>
                    <form class="form-signin" method="post" enctype="multipart/form-data">
                        <h1 class="h3 mb-3 font-weight-normal text-center">Admin Register</h1>
                        <label for="username" class="lead">Username</label>
                        <input type="text" id="username" class="form-control" placeholder="Username" name="username" required autofocus>
                        <label for="inputEmail" class="lead">Email address :</label>
                        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
                        <label for="inputPassword" class="lead">Password :</label>
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                        <label for="uploadFile" class="lead">Upload file :</label>
                        <input type="file" id="uploadFile" class="form-control" name="files" required>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Register</button>
                        <p class="mt-2 mb-2 text-muted">&copy; 2017-2019</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'partials/__footer.php' ?>

<?php
session_start();
if (isset($_SESSION['auth'])) {
    header('location:index.php');
    die;
}
$error = '';
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $users = json_decode(file_get_contents('data/users.json'), true);
    $user = $users[0];
    if ($user['email'] == $email && $user['password'] == sha1($password)) {
        $_SESSION['auth'] = true;
        header("location:index.php");
        die;
    } else {
        $error = "not correct email or password";
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TASKATO - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto">
                <form action="login.php" method="post" class="form mt-5 border p-2">
                <?php if ($error): ?>
                    <div class="alert alert-danger  text-center">
                        <div class=" p-1 "><?php echo $error; ?></div>
                    </div>
                <?php endif;?>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <input type="submit"  class="form-control bg-info text-center text-bold" value="Login" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>

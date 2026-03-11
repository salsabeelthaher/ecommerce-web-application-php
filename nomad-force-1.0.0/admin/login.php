<!DOCTYPE html>
<?php
session_start();
require_once '../config2.php';

if (isset($_POST['s'])) {
    global $conn;

    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    $q = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $results = mysqli_query($conn, $q);

    if (mysqli_num_rows($results) > 0) {

        $row = mysqli_fetch_assoc($results);

      
        $_SESSION['user'] = $row['email']; 

    
        if (!isset($_SESSION['logged_once'])) {
            logTask("A user logged in");
            $_SESSION['logged_once'] = true;
        }

   
        if ($row['isadmin'] == 0) {
            header('Location: index.php');
        } else {
            header('Location: ../index.php');
        }
        exit;

    } else {
        header('Location: login.php?errormsg=1');
        exit;
    }
}
?>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login</title>
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        body { background-color: #ffffff !important; }
        .card { border: 1px solid #e2e2e2; border-radius: 10px; }
        .card-header { background: #ffffff; border-bottom: 1px solid #e2e2e2; }
        .btn-primary { background-color: #f4b400 !important; border-color: #f4b400 !important; color: #000 !important; font-weight: bold; }
        .btn-primary:hover { background-color: #d99a00 !important; border-color: #d99a00 !important; }
    </style>
</head>
<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-sm border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                    <?php if(isset($_GET['errormsg'])): ?>
                                        <center><p style="color:red;font-weight:bold;">Wrong email or password</p></center>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="inputEmail" type="email" placeholder="name@example.com" />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" name="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Forgot Password?</a>
                                            <input type="submit" name="s" class="btn btn-primary" value="Login"/>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright © 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a> &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>

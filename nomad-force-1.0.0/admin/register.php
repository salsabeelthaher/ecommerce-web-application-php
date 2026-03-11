<!DOCTYPE html>
<?php
include('..\config2.php');
$flag = false;

if(isset($_POST['c'])){
    global $conn;

    $firstname = $_POST['inputFirstName'];
    $lastname = $_POST['inputLastName'];
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];
    $nickname = $firstname . $lastname;

    $q =  "INSERT INTO users (email, password, firstname, lastname, nickname, phone, lastlogin, isadmin)
           VALUES ('$email', '$password', '$firstname', '$lastname', '$nickname', '079000000', '', '1')";

    $results = mysqli_query($conn, $q);

    if(mysqli_affected_rows($conn) > 0){
        header('Location: login.php');
        exit;
    } else {
        header('Location: register.php?errormsg=1');
        exit;
    }
}
?>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Register</title>

    <link href="css/styles.css" rel="stylesheet" />

    <style>
        body {
            background-color: #ffffff !important; 
        }

        .card {
            border: 1px solid #e2e2e2;
            border-radius: 10px;
        }

        .card-header {
            background: #ffffff;
            border-bottom: 1px solid #e2e2e2;
        }

        .btn-primary {
            background-color: #f4b400 !important; 
            border-color: #f4b400 !important;
            color: #000 !important;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #d99a00 !important;
            border-color: #d99a00 !important;
        }
    </style>

</head>

<body>
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-sm border-0 rounded-lg mt-5">

                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Create Account</h3>

                                <?php if(isset($_GET['errormsg'])): ?>
                                    <center><p style="color:red;font-weight:bold;">Failed to create account</p></center>
                                <?php endif; ?>
                            </div>

                            <div class="card-body">
                                <form method="post" action="">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="inputFirstName" name="inputFirstName" type="text" placeholder="Enter your first name" required />
                                                <label for="inputFirstName">First name</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" id="inputLastName" name="inputLastName" type="text" placeholder="Enter your last name" required />
                                                <label for="inputLastName">Last name</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" name="inputEmail" type="email" placeholder="name@example.com" required />
                                        <label for="inputEmail">Email address</label>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="inputPassword" name="inputPassword" type="password" placeholder="Create a password" required />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="inputPasswordConfirm" name="inputPasswordConfirm" type="password" placeholder="Confirm password" required />
                                                <label for="inputPasswordConfirm">Confirm Password</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <input type="submit" class="btn btn-primary btn-block" name="c" value="Create Account" />
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="login.php">Have an account? Go to login</a></div>
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
                    <div class="text-muted">&copy; 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

</body>
</html>

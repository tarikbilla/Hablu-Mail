<?php require('includes/config.php');?>

<?php 

//check user login
 if( $user->is_logged_in() ){ header('Location: index.php'); exit(); }

//process login form if submitted
if(isset($_POST['login'])){

    if (!isset($_POST['username'])) $error[] = "Please fill out all fields";
    if (!isset($_POST['password'])) $error[] = "Please fill out all fields";

    $username = $_POST['username'];
    if ( $user->isValidUsername($username)){
        if (!isset($_POST['password'])){
            $error[] = 'A password must be entered';
        }
        $password = $_POST['password'];

        if($user->login($username,$password)){
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit;

        } else {
            $error[] = 'Wrong username or password.';
        }
    }else{
        $error[] = 'Usernames are required to be Alphanumeric, and between 3-16 characters long';
    }



}//end if submit
 ?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - HabluMail</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <?php 
                                        //check for any errors
                                            if(isset($error)){
                                                foreach($error as $error){
                                                echo ' <div class="alert alert-danger">'.$error.'</div>';
                                                }
                                            }

                                            //if action is joined show sucess
                                            if(isset($_GET['action']) && $_GET['action'] == 'joined'){
                                                echo "<div class='alert alert-success'>Registration successful!! please login your account.</div>";
                                            } ?>
                                        <form action="" method="post">
                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">UserName</label><input class="form-control py-4" name="username" id="inputEmailAddress" type="text" placeholder="Enter email address" /></div>
                                            <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Enter password" /></div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox"><input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" /><label class="custom-control-label" for="rememberPasswordCheck">Remember password</label></div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><a class="small" href="password.html">Forgot Password?</a><input type="submit" class="btn btn-primary" name="login" value="Login"></div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>

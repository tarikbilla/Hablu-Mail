<?php require('includes/config.php')?>; 
<?php
//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); exit(); }

//if form has been submitted process it
if(isset($_POST['reg'])){
    if (!isset($_POST['email'])) $error[] = "Please fill out all fields";
    if (!isset($_POST['password'])) $error[] = "Please fill out all fields";

    $username = $_POST['email'];

    //very basic validation
    if(!$user->isValidUsername($username)){
        $error[] = 'Usernames must be at least 3 Alphanumeric characters';
    } else {
        $stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
        $stmt->execute(array(':username' => $username));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($row['username'])){
            $error[] = 'Username provided is already in use.';
        }

    }

    if(strlen($_POST['password']) < 3){
        $error[] = 'Password is too short.';
    }

    if(strlen($_POST['passwordConfirm']) < 3){
        $error[] = 'Confirm password is too short.';
    }

    if($_POST['password'] != $_POST['passwordConfirm']){
        $error[] = 'Passwords do not match.';
    }

    //email validation
    $email = $_POST['email']."@hublumail.com";
    $email = htmlspecialchars_decode($email, ENT_QUOTES);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error[] = 'Please enter a valid email address';
    } else {
        $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
        $stmt->execute(array(':email' => $email));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($row['email'])){
            $error[] = 'Email provided is already in use.';
        }

    }


    //if no errors have been created carry on
    if(!isset($error)){

        //hash the password
        $hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

        //create the activasion code
        $activasion = md5(uniqid(rand(),true));

        try {

            //insert into database with a prepared statement
            $stmt = $db->prepare('INSERT INTO members (first_name,last_name,username,password,email,active) VALUES (:first_name,:last_name,:username, :password, :email, :active)');
            $stmt->execute(array(
                ':first_name' => $_POST['f_name'],
                ':last_name' => $_POST['l_name'],
                ':username' => $username,
                ':password' => $hashedpassword,
                ':email' => $email,
                ':active' => "Yes"
            ));
            $id = $db->lastInsertId('memberID');

            //send email
            $to = $_POST['email'];
            $subject = "Registration Confirmation";
            $body = "<p>Thank you for registering at demo site.</p>
            <p>To activate your account, please click on this link: <a href='".DIR."activate.php?x=$id&y=$activasion'>".DIR."activate.php?x=$id&y=$activasion</a></p>
            <p>Regards Site Admin</p>";

            $mail = new Mail();
            $mail->setFrom(SITEEMAIL);
            $mail->addAddress($to);
            $mail->subject($subject);
            $mail->body($body);
            $mail->send();

            //redirect to index page
            header('Location: login.php?action=joined');
            exit;

        //else catch the exception and show the error.
        } catch(PDOException $e) {
            $error[] = $e->getMessage();
        }

    }

}
?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Signup - HabluMail</title>
        <link href="css/styles.css" rel="stylesheet" />
         <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <?php
                                            //check for any errors
                                            if(isset($error)){
                                                foreach($error as $error){
                                                echo ' <div class="alert alert-danger">'.$error.'</div>';
                                                }
                                            }
                                            ?>
                                        <form action="" method="post">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputFirstName">First Name</label><input class="form-control py-4" name="f_name" id="inputFirstName" type="text" placeholder="Enter first name" /></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputLastName">Last Name</label><input class="form-control py-4" name="l_name" id="inputLastName" type="text" placeholder="Enter last name" /></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                                <div class="input-group mb-3">
                                                  <input type="text" class="form-control" name="email" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                  <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">@hublumail.com</span>
                                                  </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Enter password" required /></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Confirm Password</label><input class="form-control py-4" name="passwordConfirm" id="inputConfirmPassword" type="password" placeholder="Confirm password" required /></div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                                <input type="submit" name="reg" class="btn btn-primary btn-block" value="Create Account">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.html">Have an account? Go to login</a></div>
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

<?php $title="Profile";?>
<?php require_once('includes/config.php'); ?>
<?php require_once('header.php'); ?>
<?php require_once('left-side.php'); ?>

<?php 
// get profile informations
    $row = $user->get_profile_info();

    $user_f_name = $row['first_name'];
    $user_l_name = $row['last_name'];
    $user_username = $row['username'];
    $user_email = $row['email'];
    $user_address = $row['address'];
    $user_gender = $row['gender'];

 ?>

 <?php 
    // update Profile
 if (isset($_POST['update_profile_info'])) {
     $f_name = $_POST['f_name'];
     $l_name = $_POST['l_name'];
     $address = $_POST['address'];
     $gender = $_POST['gender'];

     $sta =hablu_update_profile($db, $f_name, $l_name, $address, $gender);
     if ($sta == true ) {
         $msg = '<div class="alert alert-success"> Profile Update Successfull!</div>';
         // header('location: ?action=edit');
         header("Refresh:2; url=?action=edit");
     }else{
         $msg = '<div class="alert alert-danger"> Profile Update Faild!</div>';
     }
 }
  ?>
    
	<div class="h3">profile</div> 
	<hr>
    <div class="row">
        <div class="col">
            <?php if (isset($msg)) {
                echo $msg;
            } ?>
        </div>
    </div>
	 <div class="row">
        <div class="col-3">
            <div class="profile_pic">
                <img src="assets/images/user_profile.jpg" alt="profile image-thumn" class="img-fluid rounded-circle shadow">
                <a href="?action=change_pic" class="btn btn-light px-3 shadow">Edit</a>
            </div>
			<br>
            <a href="?action=edit" class="btn btn-sm-light btn-block mt-2 border">Edit Profile</a>
            <a href="?action=change_pass" class="btn btn-sm-light btn-block border">Change Password</a>
        </div>

        <div class="col-9">

             <?php 
                if (isset($_GET['action'])) {
                    $action = $_GET['action'];
                    switch ($action) {
                        case 'edit':?>
                            <div class="my-2">
                            <form action="" method="post">
                                 <div class="text-muted ">First Name *</div>
                                 <h5><input  class="form-control" type="text" name="f_name" value="<?php echo $user_f_name;?>" required></h5>
                                 <hr>
                                 <div class="text-muted ">Last Name *</div>
                                 <h5><input class="form-control" type="text" name="l_name" value="<?php echo $user_l_name;?>" required></h5>
                                 <hr>
                                 <div class="text-muted ">Gender</div>
                                 <h5>
                                    <input type="radio" name="gender" value="Female" required <?php if($user_gender == 'Female' ) {echo "checked";} ?>>Female
                                    <input type="radio" name="gender" value="Male" required <?php if($user_gender == 'Male' ) {echo "checked";} ?>>Male
                                    <input type="radio" name="gender" value="Other" required <?php if($user_gender == 'Other' ) {echo "checked";} ?>>Other
                                </h5>
                                 <hr>
                                 <div class="text-muted ">Address</div>
                                 <h5><input class="form-control" type="text" name="address" value="<?php echo $user_address;?>" required></h5>
                                 <hr>
                                 <div class="row">
                                     <div class="col-6">
                                         <input type="submit" class="btn btn-primary border" name="update_profile_info" value="Update">
                                     </div>
                                     <div class="col-6 text-right">
                                         <a href="profile.php" class="btn btn-light border ">Back To Profile</a>
                                         
                                     </div>
                                 </div>


                             </form>
                         </div>
                        <?php    
                        break;

                        case 'change_pass':?>
                                <form action="" method="post">
                                 <div class="text-muted ">Old Password</div>
                                 <h5><input  class="form-control" type="password" name="old_pass"></h5>
                                 <hr>
                                 <div class="text-muted ">New Password</div>
                                 <h5><input  class="form-control" type="password" name="new_pass"></h5>
                                 <hr>
                                 <div class="text-muted ">Confirm New Password</div>
                                 <h5><input  class="form-control" type="password" name="conf_pass"></h5>
                                 <hr>
                                 <div class="row">
                                     <div class="col-6">
                                         <input type="submit" class="btn btn-primary border" name="update_pass" value="Change Password">
                                     </div>
                                     <div class="col-6 text-right">
                                         <a href="profile.php" class="btn btn-light border ">Back To Profile</a>
                                         
                                     </div>
                                 </div>


                             </form>

                        <?php    
                        break;
                    }
                }else{

             ?>

            <h2 class=" mb-4"><?php echo $user_f_name." ".$user_l_name; ?></h2>
            <hr>
            <div class="my-2">
                 <div class="text-muted ">UserName</div>
                 <h5><?php echo $user_username; ?></h5>
                 <hr>
                 <div class="text-muted ">Email</div>
                 <h5><?php echo $user_email; ?></h5>
                 <hr>
                 <div class="text-muted ">Address</div>
                 <h5><?php echo $user_address; ?></h5>
                 <hr>
                 <div class="text-muted ">Gender</div>
                 <h5><?php echo $user_gender; ?></h5>
                 <hr>
             </div>
         <?php } ?>
        </div>
    </div>


			
<?php require_once('footer.php'); ?>
			
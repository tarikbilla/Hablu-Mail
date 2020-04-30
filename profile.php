<?php $title="Profile";?>
<?php require_once('includes/config.php'); ?>
<?php require_once('header.php'); ?>
<?php require_once('left-side.php'); ?>

	<div class="h3">profile</div>

	<?php $user_data=$user->user_data_from_db();?>

	<?php echo $user_data['email']."<hr>" ?>
	<?php echo $user_data['first_name']."<hr>" ?>
	<?php echo $user_data['last_name']."<hr>" ?>


			
<?php require_once('footer.php'); ?>
			
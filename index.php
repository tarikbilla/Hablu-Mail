<?php $title="inbox"; ?>
<?php require_once('includes/config.php'); ?>
<?php require_once('header.php'); ?>
<?php require_once('left-side.php'); ?>
<?php define('MEMBER_ID', $_SESSION['memberID']);
 ?>
	<div class="h3">Inbox</div>
	<?php foreach ($db->query("SELECT * FROM mail WHERE reciver_id =".MEMBER_ID." AND mail_status = 'inbox' order by id desc") as $row){?>
				<?php $member_details = hablu_gate_user_info($db, $row['sender_id']);?>
				<!-- single inbox mail -->
				<a href="single.php?mid=<?php echo $row['id'];?>" class="msg">
					<span class="sender"><?php echo $member_details['first_name']." ".$member_details['last_name'];  ?></span>
					<span class="subject"><?php echo $row['mail_subject']; ?> </span>
					<span class="close"><?php echo $row['mail_date']." / ".$row['mail_time']; ?></span>
				</a>
	<?php } ?>
<?php require_once('footer.php'); ?>
			
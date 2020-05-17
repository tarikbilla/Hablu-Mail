<?php require_once('header.php'); ?>
<?php require_once('left-side.php'); ?>
<?php define('MEMBER_ID', $_SESSION['memberID']);?>
<div class="h3">Draft</div>


	<?php foreach ($db->query("SELECT * FROM mail WHERE sender_id =".MEMBER_ID." AND mail_status = 'draft' order by id desc") as $row){?>
				<!-- single inbox mail -->
				<a href="new-mail.php?mid=<?php echo $row['id'];?>&ref=draft" class="msg">
					<span class="sender"><?php  ?></span>
					<span class="subject"><?php echo $row['mail_subject']; ?> </span>
					<span class="close"><?php echo $row['mail_date']." / ".$row['mail_time']; ?></span>
				</a>
	<?php } ?>

<?php require_once('footer.php'); ?>
			
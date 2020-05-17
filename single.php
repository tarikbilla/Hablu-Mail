<?php require_once('header.php'); ?>
<?php require_once('left-side.php'); ?>
<!-- your code here -->

<?php 
/* mid = mail ID*/
	if (isset($_GET['mid']) && !empty($_GET['mid'])) {
		$m_id = $_GET['mid'];
		// update if mail seen 
		hablu_mail_seen_update($db, $m_id);

	foreach ($db->query("SELECT * FROM mail WHERE id =$m_id and (reciver_id = ".$_SESSION['memberID']." OR sender_id = ".$_SESSION['memberID'].") LIMIT 1") as $row){
		$mail_id = $row['id'];
		$sender_id = $row['sender_id'];
		$m_sub = $row['mail_subject'];
		$sender_mail = $row['sender_mail'];
		$m_date = $row['mail_date'];
		$m_time = $row['mail_time'];
		$m_content = $row['mail_content'];

	}
	?>

	<?php 
	// get referance from url
		if(isset($_GET['ref'])){
			switch ($_GET['ref']) {
				case 'trash':
					$ref_trash = true;
					break;
				case 'send':
					$ref_send = true;
					break;
				
				default:
					# code...
					break;
			}
		}

	 ?>

			
		<?php if(isset($m_sub) && isset($sender_mail) && isset($m_date) && isset($m_time) && isset($m_content)){?>
			<div class="h3 pt-2"><?php echo $m_sub; ?></div>
			<div class="h6 pb-1"><?php echo $sender_mail; ?></div>
			<div class="h6 pb-2 border-bottom" style="font-size: 12px;"><?php echo $m_date." / ".$m_time; ?></div>
			<p>
				<?php echo $m_content; ?>
			</p>
			<!-- show button -->
			<div class="action">
				<?php if(isset($ref_trash)){?>
				<a href="?id=<?php echo $mail_id;?>&action=restore" class="btn btn-success px-3">Restore</a>
				<a href="?id=<?php echo $mail_id;?>&action=delper" class="btn btn-danger px-3">Delete Parmanently</a>

				<?php }else if(isset($ref_send)){?>

				<a href="new-mail.php?mid=<?php echo $mail_id;?>&ref=forword" class="btn btn-secondary px-3">Forword</a>
				<a href="?id=<?php echo $mail_id;?>&action=del" class="btn btn-danger px-3">Delete</a>
				
				<?php }else{ ?>

				<a href="mail_replay.php?mid=<?php echo $mail_id;?>" class="btn btn-success px-3">Replay</a>
				<a href="new-mail.php?mid=<?php echo $mail_id;?>&ref=forword" class="btn btn-secondary px-3">Forword</a>
				<a href="?id=<?php echo $mail_id;?>&action=del" class="btn btn-danger px-3">Delete</a>
				<a href="?uid=<?php echo $sender_id;?>&action=spam" class="btn btn-warning px-3">Spam</a>
				
				<?php } ?>

			</div>
		<?php }else{
			header('location:index.php');
		} 

	}else if(isset($_GET['action']) && !empty($_GET['action'])){
		switch ($_GET['action']) {


			case 'del':
				// delete from inbox and send draft
				$m_id = $_GET['id'];
				$del_sta = hablu_delete_mail($db,$m_id);
				if ($del_sta == true) {
					header('location:index.php');
				}else{
					$msg ='<div class="alert alert-danger">Faild! please Try again.</div>';
				}
				break;


			case 'delper':
				// delete permanently
				$m_id = $_GET['id'];
				$del_sta = hablu_delete_permanently_mail($db,$m_id);
				if ($del_sta == true) {
					header('location:trash.php');
				}else{
					$msg ='<div class="alert alert-danger">Faild! please Try again.</div>';
				}
				break;

			case 'spam':
				// spam mail Address
				$spam_user_id = $_GET['uid'];
				$spam_sta = hablu_spam_mail($db,$spam_user_id);
				if($spam_sta==true){
					header('location:index.php');
				}

				break;

			case 'restore':
				// restore mail from trash
				$m_id = $_GET['id'];
				$del_sta = hablu_delete_restore_mail($db,$m_id);
				if ($del_sta == true) {
					header('location:index.php');
				}else{
					$msg ='<div class="alert alert-danger">Faild! please Try again.</div>';
				}
				break;
			
			default:
				# code...
				break;
		}
		
	}else{
		header('location:index.php');
	}
?>


			
<?php require_once('footer.php'); ?>
			
<?php require_once('header.php'); ?>
<?php require_once('left-side.php'); ?>
<!-- your code here -->

<?php 
	if (isset($_GET['mid']) && !empty($_GET['mid'])) {
		$m_id = $_GET['mid'];

	foreach ($db->query("SELECT * FROM mail WHERE id =$m_id and reciver_id = ".$_SESSION['memberID']." LIMIT 1") as $row){
		$m_sub = $row['mail_subject'];
		$sender_mail = $row['sender_mail'];
		$m_date = $row['mail_date'];
		$m_time = $row['mail_time'];
		$m_content = $row['mail_content'];

		}?>
			
		<?php if(isset($m_sub) && isset($sender_mail) && isset($m_date) && isset($m_time) && isset($m_content)){?>
			<div class="h3 pt-2"><?php echo $m_sub; ?></div>
			<div class="h6 pb-1"><?php echo $sender_mail; ?></div>
			<div class="h6 pb-2 border-bottom" style="font-size: 12px;"><?php echo $m_date."  ".$m_time; ?></div>
			<p>
				<?php echo $m_content; ?>
			</p>

			<div class="action">
				<div class="btn btn-success px-3">Replay</div>
				<div class="btn btn-secondary px-3">Forword</div>
				<div class="btn btn-danger px-3">Delete</div>
			</div>
		<?php }else{
			header('location:index.php');
		} 

	}else{
		header('location:index.php');
	}
?>


			
<?php require_once('footer.php'); ?>
			
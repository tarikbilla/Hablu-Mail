<?php require_once('header.php'); ?>
<?php require_once('left-side.php'); ?>

<?php 
//send mail
if (isset($_POST['send'])) {
    $to = $_POST['mail_to'];
    $subject = $_POST['mail_subject'];
    $mail_body = $_POST['mail_body'];

    if (isset($_GET['mid']) && !empty($_GET['mid'])) {

      $mv_sta = hablu_check_mail_valid($db, $to);
      if ($mv_sta == true) {
        //get reciver id from DB
          $reciver_id =hablu_check_reciver_id($db, $to);
          $m_id = $_GET['mid'];
          $sta = hablu_send_draft_mail($db,$to, $subject ,$mail_body, $reciver_id, $m_id);
          if ($sta == true) {
            $msg = '<div class="alert alert-success">Mail Send Successfull!</div>';
            
          }else{
             $msg = '<div class="alert alert-danger">Faild! plsease Try Again.</div>';
          }
      }else{
        $msg = '<div class="alert alert-danger">Invalid Mail Adddress. Please Check mail Address.</div>';
        $mail_invalid="yes";
      }

    }else{

      $mv_sta = hablu_check_mail_valid($db, $to);
      if ($mv_sta == true) {
        //get reciver id from DB
          $reciver_id =hablu_check_reciver_id($db, $to);
          $sta = hablu_send_new_mail($db,$to, $subject ,$mail_body, $reciver_id);
          if ($sta == true) {
            $msg = '<div class="alert alert-success">Mail Send Successfull!</div>';
            
          }else{
             $msg = '<div class="alert alert-danger">Faild! plsease Try Again.</div>';
          }
      }else{
        $msg = '<div class="alert alert-danger">Invalid Mail Adddress. Please Check mail Address.</div>';
        $mail_invalid="yes";
      }
    }

} ?>

<?php 
// save draft
if (isset($_POST['save'])) {
    $to = $_POST['mail_to'];
    $subject = $_POST['mail_subject'];
    $mail_body = $_POST['mail_body'];

    if (isset($_GET['mid']) && !empty($_GET['mid'])) {
        $m_id = $_GET['mid'];
        $save_draft_sta = hablu_update_draft_mail($db,$to, $subject ,$mail_body,$m_id);
        if ($save_draft_sta == true) { 
          $msg = '<div class="alert alert-success">Mail save Successfull!</div>';
        }else{
          $msg = '<div class="alert alert-danger">Faild! plsease Try Again.</div>';
        }
    }else{
      $sta = hablu_save_draft_mail($db,$to, $subject ,$mail_body);
      if ($sta == true) { 
        $msg = '<div class="alert alert-success">Mail save Successfull!</div>';
      }else{
        $msg = '<div class="alert alert-danger">Faild! plsease Try Again.</div>';
      }
    }

} ?>

<?php 
// load draft data
  if (isset($_GET['mid'])) {
    // check empty
    if (empty($_GET['mid'])) {
      header('location:new-mail.php');
    }

    $m_id = $_GET['mid'];

  foreach ($db->query("SELECT * FROM mail WHERE id =$m_id and sender_id = ".$_SESSION['memberID']." LIMIT 1") as $row){
    $m_to = $row['reciver_mail'];
    $m_sub = $row['mail_subject'];
    $m_content = $row['mail_content'];

    }

    // if mail id wrong 
    if (!isset($m_to) || !isset($m_sub) || !isset($m_content)) {
      header('location:new-mail.php');
    }
}


 ?>


<!-- your code here -->
<div class="h3 border-bottom">Send New Mail</div>
<div class="row">
  <div class="col">
    <?php if (isset($msg)) {
      echo $msg;
    } ?>
  </div>
</div>
<form action="" method="post">
  <div class="form-group">
    <label for="">To</label>
    <input type="email" class="form-control " name="mail_to" id="" placeholder="name@hablumail.com" required <?php if(isset($mail_invalid)){ echo 'style=" border:1px solid #f00;"';} ?>  value="<?php if(isset($m_to)) echo $m_to;?>">
  </div>
  <div class="form-group">
    <label for="">Subject</label>
    <input type="text" class="form-control" name="mail_subject" id="" placeholder="" required value="<?php if(isset($m_sub)) echo $m_sub;?>">
  </div>

  <div class="form-group">
    <label for="">Body</label>
    <textarea class="form-control" name="mail_body" id="" rows="3" required> <?php if(isset($m_content)) echo $m_content;?></textarea>
  </div>
    <div class="row">
    	<div class="col-6">
    		<button type="submit" class="btn btn-primary mb-2" name="save">Save to Draft</button>
    	</div>
    	<div class="col-6 text-right">
    		<button type="submit" class="btn btn-success mb-2" name="send">Send Mail</button>
    	</div>
    </div>

</form>
			
<?php require_once('footer.php'); ?>
			
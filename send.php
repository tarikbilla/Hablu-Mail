<?php require_once('header.php'); ?>
<?php require_once('left-side.php'); ?>
<!-- your code here -->
<div class="h3 border-bottom">Send New Mail</div>
<form>
  <div class="form-group">
    <label for="">To</label>
    <input type="email" class="form-control" name="mail_to" id="" placeholder="name@hablumail.com">
  </div>
  <div class="form-group">
    <label for="">Subject</label>
    <input type="text" class="form-control" name="mail_subject" id="" placeholder="">
  </div>

  <div class="form-group">
    <label for="">Body</label>
    <textarea class="form-control" name="mail_body" id="" rows="3"></textarea>
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
			
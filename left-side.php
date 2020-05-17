
	<div class="container content">
		<div class="row">
			<div class="col-3 border-right left-side">
				<nav class="nav flex-column">
					<a class="btn btn-sm btn-outline-info" href="new-mail.php">
				  		Create New Mail
				  	</a>
				 	<a class="nav-link active" href="index.php">
				  		Inbox <span class="badge badge-pill badge-primary"><?php print(hamlu_mail_unseen_counter($db,'inbox')); ?></span>
				  	</a>
				  	<a class="nav-link" href="send.php">
				  		Send <span class="badge badge-pill badge-primary"><?php print(hamlu_mail_counter_for_sender($db,'inbox')); ?></span>
				  	</a>
				  	<a class="nav-link" href="draft.php">
				  		Draft <span class="badge badge-pill badge-primary"><?php print(hamlu_mail_counter_for_sender($db,'draft')); ?></span>
				  	</a>
				  	<a class="nav-link" href="spam.php">
				  		Spam <span class="badge badge-pill badge-primary"><?php print(hamlu_mail_counter($db,'spam')); ?></span>
				  	</a>
				  	<a class="nav-link" href="trash.php">
				  		Trash <span class="badge badge-pill badge-primary"><?php print(hamlu_mail_counter($db,'trash')); ?></span>
				  	</a>
				</nav>
			</div>
			<div class="col-9 msg-list">
<?php 

	function hablu_update_profile($db, $f_name, $l_name, $address, $gender){
		try {
			$stmt = $db->prepare("UPDATE members SET first_name=:f_name,last_name=:l_name,address=:address,gender=:gender WHERE memberID = :memberID");
			$stmt->execute(array(
				':f_name' => $f_name,
				':l_name' => $l_name,
				':address' =>$address,
				':gender' => $gender,
				':memberID' => $_SESSION['memberID']
			));
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}


	function hablu_check_profile_pic($db){
		$username = $_SESSION['username'];
		foreach ($db->query("SELECT * FROM members WHERE username = '$username'") as $row){
			return $row['profile_pic_url'];
		}
	}

	function profile_pic_url_update($db,$url){
		try {
			$stmt = $db->prepare("UPDATE members SET profile_pic_url=:profile_pic_url WHERE memberID = :memberID");
			$stmt->execute(array(
				':profile_pic_url' => $url,
				':memberID' => $_SESSION['memberID']
			));
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}



	function hablu_change_password($db, $pass){
		try {
			$stmt = $db->prepare("UPDATE members SET password=:password WHERE memberID = :memberID");
			$stmt->execute(array(
				':password' => $pass,
				':memberID' => $_SESSION['memberID']
			));
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}


	function hablu_check_mail_valid($db, $h_mail){
		foreach ($db->query("SELECT * FROM members WHERE email = '$h_mail'") as $row){
			$col = $row['email'];
			if (!empty($col)) {
				return true;
			}else{
				return false;
			}
		}
	}

	function hablu_check_reciver_id($db, $h_mail){
		foreach ($db->query("SELECT * FROM members WHERE email = '$h_mail'") as $row){
			$col = $row['memberID'];
			if (!empty($col)) {
				return $col;
			}
		}
	}


	function hablu_send_new_mail($db,$mail_to, $mail_sub ,$mail_body, $reciver_id){

		try {
			$stmt = $db->prepare("INSERT INTO mail(sender_id, reciver_id, sender_mail, reciver_mail, mail_subject, mail_content, mail_date, mail_time, mail_status) VALUES (:sender_id, :reciver_id, :sender_mail, :reciver_mail, :mail_subject, :mail_content, :mail_date, :mail_time, :mail_status)");
			$stmt->execute(array(
				':sender_id' => $_SESSION['memberID'],
				':reciver_id' => $reciver_id,
				':sender_mail' => $_SESSION['username']."@hablumail.com",
				':reciver_mail' => $mail_to,
				':mail_subject' => $mail_sub,
				':mail_content' => $mail_body,
				':mail_date' => date("d-m-Y"),
				':mail_time' => date("h:i:s"),
				':mail_status' => "inbox"
			));
			return true;
		} catch (PDOException $e) {
			echo "$e";
			return false;
		}
	}

	function hablu_send_draft_mail($db,$mail_to, $mail_sub ,$mail_body, $reciver_id, $m_id){
		$sender_id= $_SESSION['memberID'];
		$reciver_id= $reciver_id;
		$sender_mail= $_SESSION['username']."@hablumail.com";
		$reciver_mail= $mail_to;
		$mail_subject= $mail_sub;
		$mail_content= $mail_body;
		$mail_date= date("d-m-Y");
		$mail_time= date("h:i:s");
		$mail_status= "inbox";
		$mail_id = $m_id;

		try {
			$stmt = $db->prepare("UPDATE mail SET sender_id=?, reciver_id=?, sender_mail=?, reciver_mail=?, mail_subject=?, mail_content=?, mail_date=?, mail_time=?, mail_status=? WHERE id = ?");
			$stmt->execute(array(
				$sender_id,
				$reciver_id,
				$sender_mail,
				$reciver_mail,
				$mail_subject,
				$mail_content,
				$mail_date,
				$mail_time,
				$mail_status,
				$mail_id
			));
			return true;
		} catch (PDOException $e) {
			echo "$e";
			return false;
		}
	}

	function hablu_save_draft_mail($db,$mail_to, $mail_sub ,$mail_body){

		try {
			$stmt = $db->prepare("INSERT INTO mail(sender_id, reciver_mail, mail_subject, mail_content, mail_date, mail_time, mail_status) VALUES (:sender_id, :reciver_mail, :mail_subject, :mail_content, :mail_date, :mail_time, :mail_status)");
			$stmt->execute(array(
				':sender_id' => $_SESSION['memberID'],
				':reciver_mail' => $mail_to,
				':mail_subject' => $mail_sub,
				':mail_content' => $mail_body,
				':mail_date' => date("d-m-Y"),
				':mail_time' => date("h:i:s"),
				':mail_status' => "draft"
			));
			return true;
		} catch (PDOException $e) {
			echo "$e";
			return false;
		}
	}

	function hablu_update_draft_mail($db,$mail_to, $mail_sub ,$mail_body,$m_id){
		$date = date("d-m-Y");
		$time = date("h:i:s");
		$mail_id = $m_id;
		try {
			$stmt = $db->prepare("UPDATE mail SET reciver_mail = ?, mail_subject= ?, mail_content = ?, mail_date = ?, mail_time = ? WHERE id = ?");
			$stmt->execute(array($mail_to, $mail_sub, $mail_body, $date, $time,$mail_id));
			return true;
		} catch (PDOException $e) {
			echo "$e";
			return false;
		}
	}



	function hablu_gate_user_info($db, $meber_id){
			try {
				$stmt = $db->prepare("SELECT * FROM members WHERE memberID = :memberid");
				$stmt->execute(array(':memberid' => $meber_id));

				$row =$stmt->fetch();
				return $row;

			} catch(PDOException $e) {}
	}


	function hablu_delete_mail($db,$m_id){
		$memberid = $_SESSION['memberID'];
		$mail_status = "trash";
		try {
			$stmt = $db->prepare("UPDATE mail SET mail_status = ? WHERE id = ? and reciver_id=?");
			$stmt->execute(array($mail_status, $m_id,$memberid));
			return true;
		} catch (PDOException $e) {
			echo "$e";
			return false;
		}
	}

	function hablu_delete_permanently_mail($db,$m_id){
		$memberid = $_SESSION['memberID'];
		$mail_status = "deleted";
		try {
			$stmt = $db->prepare("UPDATE mail SET mail_status = ? WHERE id = ? and reciver_id=?");
			$stmt->execute(array($mail_status, $m_id,$memberid));
			return true;
		} catch (PDOException $e) {
			echo "$e";
			return false;
		}
	}

	function hablu_delete_restore_mail($db,$m_id){
		$memberid = $_SESSION['memberID'];
		$mail_status = "inbox";
		try {
			$stmt = $db->prepare("UPDATE mail SET mail_status = ? WHERE id = ? and reciver_id=?");
			$stmt->execute(array($mail_status, $m_id,$memberid));
			return true;
		} catch (PDOException $e) {
			echo "$e";
			return false;
		}
	}


	// if user seen  this update database
	function hablu_mail_seen_update($db,$m_id){
		$memberid = $_SESSION['memberID'];
		$mail_seen = "seen";
		try {
			$stmt = $db->prepare("UPDATE mail SET mail_seen = ? WHERE id = ? and reciver_id=?");
			$stmt->execute(array($mail_seen, $m_id,$memberid));
			return true;
		} catch (PDOException $e) {
			echo "$e";
			return false;
		}
	}

	function humlu_mail_unseen_counter($db,$mail_type)
	{
		$counter = 0;
		foreach ($db->query("SELECT * FROM mail WHERE reciver_id =".$_SESSION['memberID']." AND mail_status = '".$mail_type."' AND mail_seen ='' order by id desc") as $row){
				$counter++;
		}
		return $counter;
	}

	function humlu_mail_counter($db,$mail_type)
	{
		$counter = 0;
		foreach ($db->query("SELECT * FROM mail WHERE reciver_id =".$_SESSION['memberID']." AND mail_status = '".$mail_type."' order by id desc") as $row){
				$counter++;
		}
		return $counter;
	}

	function humlu_mail_counter_for_sender($db,$mail_type)
	{
		$counter = 0;
		foreach ($db->query("SELECT * FROM mail WHERE sender_id =".$_SESSION['memberID']." AND mail_status = '".$mail_type."' order by id desc") as $row){
				$counter++;
		}
		return $counter;
	}

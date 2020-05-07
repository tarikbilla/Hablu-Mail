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


	function hablu_create_new_nail($db,$mail_to, $mail_sub ,$mail_body, $reciver_id){

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



function hablu_gate_user_info($db, $meber_id){
		try {
			$stmt = $db->prepare("SELECT * FROM members WHERE memberID = :memberid");
			$stmt->execute(array(':memberid' => $meber_id));

			$row =$stmt->fetch();
			return $row;

		} catch(PDOException $e) {}
}

	
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



	function hublu_change_password($db, $pass){
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
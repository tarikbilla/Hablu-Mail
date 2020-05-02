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
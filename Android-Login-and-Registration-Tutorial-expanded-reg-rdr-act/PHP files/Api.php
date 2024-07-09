<?php 

	require_once 'DbConnect.php';
	
	$response = array();
	
	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
			
			case 'signup':
				if(isTheseParametersAvailable(array('username','fullname','email','password','gender','purok','barangay','town','meterid'))){
					$username = $_POST['username']; 
					$fullname = $_POST['fullname'];
					$email = $_POST['email']; 
					$password = md5($_POST['password']);
					$gender = $_POST['gender']; 
					$purok = $_POST['purok'];
					$barangay  = $_POST['barangay'];
					$town = $_POST['town'];
					$meterid = $_POST['meterid'];
					
					$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
					$stmt->bind_param("ss", $username, $email);
					$stmt->execute();
					$stmt->store_result();
					
					if($stmt->num_rows > 0){
						$response['error'] = true;
						$response['message'] = 'User already registered';
						$stmt->close();
					}else{
						$stmt = $conn->prepare("INSERT INTO users (username, fullname, email, password, gender, purok, barangay, town, meterid) VALUES (?,?,?,?,?,?,?,?,?)");
						$stmt->bind_param("sssssssss", $username, $fullname, $email, $password, $gender, $purok, $barangay, $town, $meterid);

						if($stmt->execute()){
							$stmt = $conn->prepare("SELECT id, id, username, fullname, email, gender, purok, barangay, town, meterid FROM users WHERE username = ?"); 
							$stmt->bind_param("s",$username);
							$stmt->execute();
							$stmt->bind_result($userid, $id, $username, $fullname, $email, $gender, $purok, $barangay, $town, $meterid);
							$stmt->fetch();
							
							$user = array(
								'id'=>$id, 
								'username'=>$username, 
								'fullname'=>$fullname,
								'email'=>$email,
								'gender'=>$gender,
								'purok'=>$purok,
								'barangay'=>$barangay,
								'town'=>$town,
								'meterid'=>$meterid
							);
							
							$stmt->close();
							
							$response['error'] = false; 
							$response['message'] = 'User registered successfully'; 
							$response['user'] = $user; 
						}
					}
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'required parameters are not available'; 
				}
				
			break; 
			
			case 'login':
				
				if(isTheseParametersAvailable(array('username', 'password'))){
					
					$username = $_POST['username'];
					$password = md5($_POST['password']); 
					
					$stmt = $conn->prepare("SELECT id, username, fullname, email, gender, purok, barangay, town, meterid, customerbalance FROM users WHERE username = ? AND password = ?");
					$stmt->bind_param("ss",$username, $password);
					
					$stmt->execute();
					
					$stmt->store_result();
					
					if($stmt->num_rows > 0){
						
						$stmt->bind_result($id, $username, $fullname, $email, $gender, $purok, $barangay, $town, $meterid, $customerbalance);
						$stmt->fetch();
						
						$user = array(
							'id'=>$id, 
							'username'=>$username, 
							'fullname'=>$fullname,
							'email'=>$email,
							'gender'=>$gender,
							'meterid'=>$meterid,
							'purok'=>$purok,
							'barangay'=>$barangay,
							'town'=>$town,
							'customerbalance'=>$customerbalance
						);
						
						$response['error'] = false; 
						$response['message'] = 'Login successfull'; 
						$response['user'] = $user; 
					}else{
						$response['error'] = false; 
						$response['message'] = 'Invalid username or password';
					}
				}
			break; 
			
			default: 
				$response['error'] = true; 
				$response['message'] = 'Invalid Operation Called';
		}
		
	}else{
		$response['error'] = true; 
		$response['message'] = 'Invalid API Call';
	}
	
	echo json_encode($response);
	
	function isTheseParametersAvailable($params){
		
		foreach($params as $param){
			if(!isset($_POST[$param])){
				return false; 
			}
		}
		return true; 
	}
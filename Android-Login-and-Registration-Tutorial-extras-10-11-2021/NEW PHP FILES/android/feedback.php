<?php 

	require_once 'DbConnect.php';
	
	$response = array();
	
	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
			
			case 'feedback':
				if(isTheseParametersAvailable(array('meterid','message','reportdate'))){

					$meterid = $_POST['meterid'];
					$message = $_POST['message'];
					//$reportdate = $_POST['reportdate'];
					
					$stmt = $conn->prepare("SELECT id FROM customer_feed_back WHERE meterid = ?");
					$stmt->bind_param("s", $meterid);
					$stmt->execute();
					$stmt->store_result();
					
					if($stmt->num_rows > 0){
						$response['error'] = true;
						$response['message'] = 'ID already exists';
						$stmt->close();
					}else{
						$stmt = $conn->prepare("INSERT INTO customer_feed_back (meterid,message) VALUES (?,?)");
						$stmt->bind_param("ss", $meterid, $message);

						if($stmt->execute()){
							$stmt = $conn->prepare("SELECT meterid, message FROM customer_feed_back WHERE meterid = ?"); 
							$stmt->bind_param("s",$meterid);
							$stmt->execute();
							$stmt->bind_result($meterid, $message);
							$stmt->fetch();
							
							$feedback = array(

								'meterid'=>$meterid,
								'message'=>$message
							);
							
							$stmt->close();
							
							$response['error'] = false; 
							$response['message'] = 'User feedback successfully created!'; 
							$response['user'] = $user; 
						}
					}
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'required parameters are not available'; 
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
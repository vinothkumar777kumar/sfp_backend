<?php namespace App\Controllers;
use \Firebase\JWT\JWT;
use App\Controllers\AuthController;
use CodeIgniter\RESTful\ResourceController;


header('Access-Control-Allow-Origin: *');        
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization, Token, App-version,Access-Control-Allow-Headers");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Max-Age: 3600'); 

// default BaseController
class SponsorsController extends ResourceController
{
	protected $modelName = 'App\Models\SponsorsModel';
	
	public function __construct(){
$this->protect = new AuthController();
	}

	public function getallsponsors()
	{
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
		// 	try {
		// 		$decode = JWT::decode($token,$secret_key,array('HS256'));
		// 		if($decode){
							$teams = $this->model->getallaponsor();
							$output = [
								'status' => 'success',
								'data' => $teams
							];
							return $this->respond($output, 200);
				
		// 		}
		// 	} catch (\Exception $e) {
		// 		$output = [
		// 				'message' => 'Access denied',
		// 				'error' => $e->getMessage()
		// 			];
		// 			return $this->respond($output, 401);
		// 	}
		// }
	}

	public function addsponsor(){
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		$token = $arr[1];
		if($token){
			try {
				$decode = JWT::decode($token,$secret_key,array('HS256'));
				if($decode){
	helper(['form', 'url']);
	$upload_dir = 'uploads/profile/';
	$this->validation = \Config\Services::validation();
	if ($this->request->getMethod() == 'post') {
		$data = $this->request->getPost();
		if(!empty($_FILES['profile_image']['name'])){
						$team_img_name = $_FILES['profile_image']['name'];
						$team_img_tmp_name = $_FILES["profile_image"]["tmp_name"];
						$team_error = $_FILES["profile_image"]["error"];
						if($team_error > 0){
							$response = array(
								"status" => "error",
								"error" => true,
								"message" => "Error uploading the file!"
							);
						}else 
						{
							$team_random_name = date('dmyhms')."-".strtolower($team_img_name);
							$team_random_name = preg_replace('/\s+/', '-', $team_random_name);
							$team_upload_name = $upload_dir.''.$team_random_name;

							if(move_uploaded_file($team_img_tmp_name , $team_upload_name)) {
								$response = array(
									"status" => "success",
									"error" => false,
									"message" => "File uploaded successfully",
									"url" => $team_upload_name
								);
							}else
							{
								$response = array(
									"status" => "error",
									"error" => true,
									"message" => "Error uploading the file!"
								);
							}
						}
					}
		$sponsor_data = [
			'profile_image' => $team_random_name,
			'name'=> $data['name'],
			'last_name'=> $data['last_name'],
			'mobile' => $data['mobile'],
			'email' => $data['email'],
			'address_one' => $data['address_one'],
			'address_two'=> $data['address_two'],
			'city'=> $data['city'],
			'state'=> $data['state'],
			'zip_code'=> $data['zip_code'],
			'status' => $data['status'],
			'role_type' => $data['role_type']
		];
		
	$get_id = $this->model->addsponsor($sponsor_data);
	// return
                        if($get_id){
                        	 $student = json_decode($data['student'],true);
                        	foreach($student as $t){							
	                        $students_array[] = [
	                            'student_id'=> $t['id'],
	                            'sponsor_id' => $get_id
							];
						}
						$res = $this->model->assignstudenttosponsor($students_array);
						if($res){
                            $output = [
                                'message' => 'Sponsor Added Successfully',
                                'id' => $get_id,
                                'status' => 'success'
                            ];
                                return $this->respond($output,200);
                            }
                        }else{
                            $output = [
                                'error' => $this->db->error(),
                                'status' => 'fail'
                            ];
                                return $this->respond($output,502);
                        }

		
	} else {
		return $this->fail('Only post request is allowed');
	}
}
} catch (\Exception $e) {
	$output = [
			'message' => 'Access denied',
			'error' => $e->getMessage()
		];
		return $this->respond($output, 401);
}
}
    }

      public function editsponsor($id)
	{
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
		// 	try {
		// 		$decode = JWT::decode($token,$secret_key,array('HS256'));
		// 		if($decode){
					$getteams = $this->model->editsponsor($id);
					$getall_student = $this->model->getallstudent();
					
					$output = [
						'status' => 'success',
						'data' => $getteams,
						'allstudent' => $getall_student
					];
				return $this->respond($output, 200);
					// $output = [
					// 	'message' => 'Access granted'
					// ];
					// return $this->respond($output, 200);
		// 		}
		// 	} catch (\Exception $e) {
		// 		$output = [
		// 				'message' => 'Access denied',
		// 				'error' => $e->getMessage()
		// 			];
		// 			return $this->respond($output, 401);
		// 	}
		// }
    }

    public function updatsponsor(){
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		$token = $arr[1];
		if($token){
			try {
				$decode = JWT::decode($token,$secret_key,array('HS256'));
				if($decode){
	helper(['form', 'url']);
	$upload_dir = 'uploads/profile/';
	$this->validation = \Config\Services::validation();
	if ($this->request->getMethod() == 'post') {
		$data = $this->request->getPost();
		if(!empty($_FILES['profile_image']['name'])){
						$teamone_img_name = $_FILES['profile_image']['name'];
                      $teamoneimg_tmp_name = $_FILES["profile_image"]["tmp_name"];
                      $teamone_error = $_FILES["profile_image"]["error"];
                      if($teamone_error > 0){
                          $response = array(
                              "status" => "error",
                              "error" => true,
                              "message" => "Error uploading the file!"
                          );
                      }else 
                      {
						  $teamonerandom_name = date('dmyhms')."-".strtolower($teamone_img_name);
                          $upload_name = $upload_dir.''.$teamonerandom_name;
                          $upload_name = preg_replace('/\s+/', '-', $upload_name);

                          if(move_uploaded_file($teamoneimg_tmp_name , $upload_name)) {
                              $response = array(
                                  "status" => "success",
                                  "error" => false,
                                  "message" => "File uploaded successfully",
                                  "url" => $upload_name
                              );
                          }else
                          {
                              $response = array(
                                  "status" => "error",
                                  "error" => true,
                                  "message" => "Error uploading the file!"
                              );
                          }
                      }
                    }else{
                        $teamonerandom_name = $data['profile_image'];
                    }
	$sponsor_data = [
		'profile_image' => $teamonerandom_name,
			'name'=> $data['name'],
			'last_name'=> $data['last_name'],
			'mobile' => $data['mobile'],
			'email' => $data['email'],
			'address_one' => $data['address_one'],
			'address_two'=> $data['address_two'],
			'city'=> $data['city'],
			'state'=> $data['state'],
			'zip_code'=> $data['zip_code'],
			'status' => $data['status'],
			'role_type' => $data['role_type']
		];
		
			
			$update_id = $data['id'];
			// echo json_encode($userdata);
			$res =  $this->model->updatesponsor($update_id,$sponsor_data);
		if($res){
			// $assigndata = $this->model->deletesponsorstudent($data['id']);
			   //  	 $student = json_decode($data['student'],true);
      //                   	foreach($student as $t){							
	     //                    $students_array[] = [
	     //                        'student_id'=> $t['id'],
	     //                        'sponsor_id' => $data['id']
						// 	];
						// }
						// $update = $this->model->assignstudenttosponsor($students_array);
						// if($update){
                            $output = [
                                'message' => 'Sponsor Update Successfully',
                                'status' => 'success'
                            ];
                                return $this->respond($output,200);
                            // }
                        }else{
                            $output = [
                                'error' => $this->db->error(),
                                'status' => 'fail'
                            ];
                                return $this->respond($output,502);
                        }

		
	} else {
		return $this->fail('Only post request is allowed');
	}
}
} catch (\Exception $e) {
	$output = [
			'message' => 'Access denied',
			'error' => $e->getMessage()
		];
		return $this->respond($output, 401);
}
}
    }

     public function updatestudentassignsponsor(){
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		$token = $arr[1];
		if($token){
			try {
				$decode = JWT::decode($token,$secret_key,array('HS256'));
				if($decode){
	helper(['form', 'url']);
	$upload_dir = 'uploads/profile/';
	$this->validation = \Config\Services::validation();
	if ($this->request->getMethod() == 'post') {
		$data = $this->request->getJSON();
			$assigndata = $this->model->deletestudent($data->id);
			    	 $sponsor = json_decode($data->sponsor,true);
                        	foreach($sponsor as $s){							
	                        $sponsor_array[] = [
	                            'student_id'=> $data->id,
	                            'sponsor_id' => $s['id']
							];
						}
						$update = $this->model->assignstudenttosponsor($sponsor_array);
						if($update){
                            $output = [
                                'message' => 'Sponsor Assiged Successfully',
                                'status' => 'success'
                            ];
                                return $this->respond($output,200);
                            }
                      

		
	} else {
		return $this->fail('Only post request is allowed');
	}
}
} catch (\Exception $e) {
	$output = [
			'message' => 'Access denied',
			'error' => $e->getMessage()
		];
		return $this->respond($output, 401);
}
}
    }

     public function deletesponsor($id){
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		$token = $arr[1];
		if($token){
			try {
				$decode = JWT::decode($token,$secret_key,array('HS256'));
				if($decode){
                    $delete = $this->model->deletesponsor($id);
                
					if($delete){
					$output = [
                        'status' => 'success',
                        'message' => 'Sponsor Deleted Successfully'
					];
					return $this->respond($output, 200);
									}else{
										$output = [
											'status' => 'fail',
											'error' => $delete
										];
					return $this->respond($output, 401);   
									}
										// $output = [
										// 	'message' => 'Access granted'
										// ];
										// return $this->respond($output, 200);
									}
			} catch (\Exception $e) {
				$output = [
						'message' => 'Access denied',
						'error' => $e->getMessage()
					];
					return $this->respond($output, 401);
			}
		}
	}

	public function getdashboarddata()
	{
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
		// 	try {
		// 		$decode = JWT::decode($token,$secret_key,array('HS256'));
		// 		if($decode){
							$student_count = $this->model->getstudentcount();
							// return json_encode($student_count[0]->count);
							$sponsors_count = $this->model->getsponsorscount();
							$student_pending_approvalcount = $this->model->getpendingapprovalcount();
							// return json_encode($student_pending_approvalcount);
							$bank_balance = $this->model->getbankbalance();
							// return json_encode($bank_balance);
							$output = [
								'status' => 'success',
								'students_count' => $student_count[0]->count,
								'sponsors_count' => $sponsors_count[0]->count,
								'student_pendingapproval_count' => count($student_pending_approvalcount),
								'bank_balance' => $bank_balance[0]->bank_balance
							];
							return $this->respond($output, 200);
				
		// 		}
		// 	} catch (\Exception $e) {
		// 		$output = [
		// 				'message' => 'Access denied',
		// 				'error' => $e->getMessage()
		// 			];
		// 			return $this->respond($output, 401);
		// 	}
		// }
	}

	
	    public function getsponsorstudent($id)
	{
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
		// 	try {
		// 		$decode = JWT::decode($token,$secret_key,array('HS256'));
		// 		if($decode){
					$getteams = $this->model->getsponsorstudent($id);
					
					$output = [
						'status' => 'success',
						'data' => $getteams
					];
				return $this->respond($output, 200);
					// $output = [
					// 	'message' => 'Access granted'
					// ];
					// return $this->respond($output, 200);
		// 		}
		// 	} catch (\Exception $e) {
		// 		$output = [
		// 				'message' => 'Access denied',
		// 				'error' => $e->getMessage()
		// 			];
		// 			return $this->respond($output, 401);
		// 	}
		// }
    }

      public function deletesponsorstudent($id){
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		$token = $arr[1];
		if($token){
			try {
				$decode = JWT::decode($token,$secret_key,array('HS256'));
				if($decode){
                    $delete = $this->model->deletesponsorsinglestudent($id);
                
					if($delete){
					$output = [
                        'status' => 'success',
                        'message' => 'Sponsor Deleted Successfully'
					];
					return $this->respond($output, 200);
									}else{
										$output = [
											'status' => 'fail',
											'error' => $delete
										];
					return $this->respond($output, 401);   
									}
										// $output = [
										// 	'message' => 'Access granted'
										// ];
										// return $this->respond($output, 200);
									}
			} catch (\Exception $e) {
				$output = [
						'message' => 'Access denied',
						'error' => $e->getMessage()
					];
					return $this->respond($output, 401);
			}
		}
	}


	public function paysponsorship(){
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		$token = $arr[1];
		if($token){
			try {
				$decode = JWT::decode($token,$secret_key,array('HS256'));
				if($decode){
	helper(['form', 'url']);
	$upload_dir = 'uploads/profile/';
	$this->validation = \Config\Services::validation();
	if ($this->request->getMethod() == 'post') {
		$data = $this->request->getJSON();
		
		$paydata = [
			'student_id' => $data->student_id,
			'sponsor_id' => $data->sponsor_id,
			'pay_date'=> $data->pay_date,
			'paid'=> $data->paid,
			'total_fees'=> $data->total_fees,
			'paid_status'=> $data->paid_status
		];
		
	$res = $this->model->paysponsorship($paydata);
	// return
                        if($res){
                        	$bankdata = $this->model->getbankbalance();
                        	// $sponsordata = $this->model->getsponsordata($data->sponsor_id);
                        		$bal = [
                        			'bank_balance' => $bankdata[0]->bank_balance - $data->paid
                        		];
                        		// return json_encode($bal);
                        		$bank_upd = $this->model->updatebankbal($bankdata[0]->id,$bal);
                        		// $upd = $this->model->updateopeningbal($data->sponsor_id,$bal);
                        		if($bank_upd){
                            $output = [
                                'message' => 'Paid Successfully',
                                'status' => 'success'
                            ];
                                return $this->respond($output,200);
                            }
                            
                        }else{
                            $output = [
                                'error' => $this->db->error(),
                                'status' => 'fail'
                            ];
                                return $this->respond($output,502);
                        }

		
	} else {
		return $this->fail('Only post request is allowed');
	}
}
} catch (\Exception $e) {
	$output = [
			'message' => 'Access denied',
			'error' => $e->getMessage()
		];
		return $this->respond($output, 401);
}
}
    }

    public function getpaidsponsorshipdata($id){
$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
		// 	try {
		// 		$decode = JWT::decode($token,$secret_key,array('HS256'));
		// 		if($decode){
					$getteams = $this->model->getstudentsponsorshippaiddata($id);
					
					$output = [
						'status' => 'success',
						'data' => $getteams
					];
				return $this->respond($output, 200);
					// $output = [
					// 	'message' => 'Access granted'
					// ];
					// return $this->respond($output, 200);
		// 		}
		// 	} catch (\Exception $e) {
		// 		$output = [
		// 				'message' => 'Access denied',
		// 				'error' => $e->getMessage()
		// 			];
		// 			return $this->respond($output, 401);
		// 	}
		// }
    }

    // sponsor wallet 
    public function getsponsorswallettransactiondetails($sponsor_id)
	{
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
		// 	try {
		// 		$decode = JWT::decode($token,$secret_key,array('HS256'));
		// 		if($decode){
							$data = $this->model->getsponsorswallettransactiondetails($sponsor_id);
							$output = [
								'status' => 'success',
								'data' => $data
							];
							return $this->respond($output, 200);
				
		// 		}
		// 	} catch (\Exception $e) {
		// 		$output = [
		// 				'message' => 'Access denied',
		// 				'error' => $e->getMessage()
		// 			];
		// 			return $this->respond($output, 401);
		// 	}
		// }
	}

		public function addsponsorwallet(){
			$secret_key = $this->protect->privateKey();
			$token  = null;
			$authHeader = $this->request->getHeader('Authorization');
			$arr = explode(" ", $authHeader);
			$token = $arr[1];
			if($token){
				try {
					$decode = JWT::decode($token,$secret_key,array('HS256'));
					if($decode){
						helper(['form', 'url']);
						$upload_dir = 'uploads/profile/';
						$this->validation = \Config\Services::validation();
						if ($this->request->getMethod() == 'post') {
							$data = $this->request->getJSON();

							$wallet_data = [
								'sponsor_id' => $data->sponsor_id,
								'amount'=> $data->amount,
								'date' => $data->date,
								'status' => $data->status
							];
		
							$res = $this->model->addwallet($wallet_data);
							// return
                        		if($res){
		                        	 $output = [
		                                'message' => 'Added Successfully',
		                                'status' => 'success'
		                            ];
                            return $this->respond($output,200);
                        	// $sponsor_data = $this->model->getsponsoropeningbaldetails($data->sponsor_id);
                        	// if(!empty($sponsor_data)){
                        	// 	$bal = [
                        	// 		'opening_bal' => $sponsor_data[0]->opening_bal + $data->amount
                        	// 	];
                        	// 	$upd = $this->model->updateopeningbal($data->sponsor_id,$bal);

if($upd){
// return json_encode($bal['opening_bal']);
	$email = \Config\Services::email();
							// $logo_path = base_url().'/assets/images/logo.jpg';
			 $logo_path = 'https://www.ndscs.edu/sites/default/files/2019-06/Student-Sponsorship_logo.jpg';
							$email->attach($logo_path);
							$to = $sponsor_data[0]->email;
							$subject = 'Sponsorship Amount Transaction';
  $message = 'Hi '.$sponsor_data[0]->name.' '.$sponsor_data[0]->last_name.',<br><br>Your transaction amount  $ '.$data->amount.'.<br><br> Your total balance is  $ '.$bal['opening_bal'].'.<br><br>Thanks<br>Team';
							
							$email->setFrom('Info@email.com', 'Info');
							$email->setTo($to);
							// $email->setCC('another@example.com');
							// $email->setBCC('and@another.com');
							
							$email->setSubject($subject);
							$email->setMessage($message);
                            $output = [
                                'message' => 'Update Successfully',
                                'status' => 'success'
                            ];
                            $output = [
                                'message' => 'Update Successfully',
                                'status' => 'success'
                            ];
                            if($email->send()){
                                $output['mail_sent'] = true;
                            }else{
                                $output['mail_sent'] = false;
                            }

                            
                                
                            }
                        	// }
						
						
                        }else{
                            $output = [
                                'error' => $this->db->error(),
                                'status' => 'fail'
                            ];
                                return $this->respond($output,502);
                        }

		
	} else {
		return $this->fail('Only post request is allowed');
	}
}
} catch (\Exception $e) {
	$output = [
			'message' => 'Access denied',
			'error' => $e->getMessage()
		];
		return $this->respond($output, 401);
}
}
    }

     public function editsponsorwallet($id)
	{
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
		// 	try {
		// 		$decode = JWT::decode($token,$secret_key,array('HS256'));
		// 		if($decode){
					$data = $this->model->editsponsorwallet($id);				
					$output = [
						'status' => 'success',
						'data' => $data
					];
				return $this->respond($output, 200);
					// $output = [
					// 	'message' => 'Access granted'
					// ];
					// return $this->respond($output, 200);
		// 		}
		// 	} catch (\Exception $e) {
		// 		$output = [
		// 				'message' => 'Access denied',
		// 				'error' => $e->getMessage()
		// 			];
		// 			return $this->respond($output, 401);
		// 	}
		// }
    }

    
    public function getsponsoralltransaction($sponsor_id)
	{
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
		// 	try {
		// 		$decode = JWT::decode($token,$secret_key,array('HS256'));
		// 		if($decode){
					$data = $this->model->getsponsortransaction($sponsor_id);				
					$output = [
						'status' => 'success',
						'data' => $data
					];
				return $this->respond($output, 200);
					// $output = [
					// 	'message' => 'Access granted'
					// ];
					// return $this->respond($output, 200);
		// 		}
		// 	} catch (\Exception $e) {
		// 		$output = [
		// 				'message' => 'Access denied',
		// 				'error' => $e->getMessage()
		// 			];
		// 			return $this->respond($output, 401);
		// 	}
		// }
    }

    public function getallsponsortransaction()
	{
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
		// 	try {
		// 		$decode = JWT::decode($token,$secret_key,array('HS256'));
		// 		if($decode){
					$data = $this->model->getsponsoralltransaction();				
					$output = [
						'status' => 'success',
						'data' => $data
					];
				return $this->respond($output, 200);
					// $output = [
					// 	'message' => 'Access granted'
					// ];
					// return $this->respond($output, 200);
		// 		}
		// 	} catch (\Exception $e) {
		// 		$output = [
		// 				'message' => 'Access denied',
		// 				'error' => $e->getMessage()
		// 			];
		// 			return $this->respond($output, 401);
		// 	}
		// }
    }

    public function updatsponsorwallet(){
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		$token = $arr[1];
		if($token){
			try {
				$decode = JWT::decode($token,$secret_key,array('HS256'));
				if($decode){
	helper(['form', 'url']);
	if ($this->request->getMethod() == 'post') {
		$data = $this->request->getJSON();
	
	
		$wallet_data = [
			'sponsor_id' => $data->sponsor_id,
			'amount'=> $data->amount,
			'date' => $data->date,
			'status' => $data->status
		];
		
			
			$update_id = $data->id;
			// echo json_encode($userdata);
			$res =  $this->model->updatesponsorwallet($update_id,$wallet_data);
		if($res){
			$output = [
                                'message' => 'Update Successfully',
                                'status' => 'success'
                            ];
                                return $this->respond($output,200);
// 	$sponsor_data = $this->model->getsponsoropeningbaldetails($data->sponsor_id);
//                         	if(!empty($sponsor_data)){
//                         		$red_amt = $sponsor_data[0]->opening_bal - $data->prev_amt;
//                         		$bal = [
//                         			'opening_bal' => $red_amt + $data->amount
//                         		];
//                         		// return json_encode($bal);
//                         		$upd = $this->model->updateopeningbal($data->sponsor_id,$bal);
// if($upd){
//                             $output = [
//                                 'message' => 'Update Successfully',
//                                 'status' => 'success'
//                             ];
//                                 return $this->respond($output,200);
//                             }
//                         	}
                           
                        }else{
                            $output = [
                                'error' => $this->db->error(),
                                'status' => 'fail'
                            ];
                                return $this->respond($output,502);
                        }

		
	} else {
		return $this->fail('Only post request is allowed');
	}
}
} catch (\Exception $e) {
	$output = [
			'message' => 'Access denied',
			'error' => $e->getMessage()
		];
		return $this->respond($output, 401);
}
}
    }

    public function deletesponsorwallet($id){
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		$token = $arr[1];
		if($token){
			try {
				$decode = JWT::decode($token,$secret_key,array('HS256'));
				if($decode){
					$wall_data = $this->model->editsponsorwallet($id);
					$sponsor_data = $this->model->getsponsoropeningbaldetails($wall_data[0]->sponsor_id);
					if($sponsor_data[0]->opening_bal > $wall_data[0]->amount){
						$red_amt = $sponsor_data[0]->opening_bal - $wall_data[0]->amount;
                        		$bal = [
                        			'opening_bal' => $red_amt
                        		];
                        		// return json_encode($bal);
                        		$upd = $this->model->updateopeningbal($wall_data[0]->sponsor_id,$bal);
							if($upd){
								$delete = $this->model->deletesponsorwallet($id);
								if($delete){
										$output = [
                        'status' => 'success',
                        'message' => 'Deleted Successfully'
					];
					return $this->respond($output, 200);
								}
				
					}
									}else{
										$output = [
                        'status' => 'info',
                        'message' => 'The main balance is less than the amount you intend to delete'
					];
					return $this->respond($output, 200); 
									}
										// $output = [
										// 	'message' => 'Access granted'
										// ];
										// return $this->respond($output, 200);
									}
			} catch (\Exception $e) {
				$output = [
						'message' => 'Access denied',
						'error' => $e->getMessage()
					];
					return $this->respond($output, 401);
			}
		}
	}

	 public function getallsponsoravailablebalance()
	{
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
		// 	try {
		// 		$decode = JWT::decode($token,$secret_key,array('HS256'));
		// 		if($decode){
							$data = $this->model->getallsponsoravailablebalance();
							$output = [
								'status' => 'success',
								'data' => $data
							];
							return $this->respond($output, 200);
				
		// 		}
		// 	} catch (\Exception $e) {
		// 		$output = [
		// 				'message' => 'Access denied',
		// 				'error' => $e->getMessage()
		// 			];
		// 			return $this->respond($output, 401);
		// 	}
		// }
	}

	  public function approvalsponsorfinanced(){
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		$token = $arr[1];
		if($token){
			try {
				$decode = JWT::decode($token,$secret_key,array('HS256'));
				if($decode){
					helper(['form', 'url']);
					if ($this->request->getMethod() == 'post') {
						$data = $this->request->getJSON();
						$wallet_data = [
							'status' => $data->status
						];
						$update_id = $data->id;
						// echo json_encode($userdata);
						$res =  $this->model->updatesponsoramounttransactionstatus($update_id,$wallet_data);
						if($res){
							$bankdata = $this->model->getbankbalance();
                        	if(!empty($bankdata)){
                        		$bal = [
                        			'bank_balance' => $bankdata[0]->bank_balance + $data->amount
                        		];
                        		// return json_encode($bal);
                        		$bank_upd = $this->model->updatebankbal($bankdata[0]->id,$bal);
if($bank_upd){
	// $sponsor_data = $this->model->getsponsoropeningbaldetails($data->sponsor_id);
 //                        	if(!empty($sponsor_data)){
 //                        		$spon_bal = [
 //                        			'opening_bal' => $sponsor_data[0]->opening_bal + $data->amount
 //                        		];
                        		// return json_encode($bal);
                        		// $upd = $this->model->updateopeningbal($data->sponsor_id,$spon_bal);
// if($upd){
                            $output = [
                                'message' => 'Approved Successfully',
                                'status' => 'success'
                            ];
                                return $this->respond($output,200);
                            // }
                        	}
                        
                            }
                        	
                           
                        }else{
                            $output = [
                                'error' => $this->db->error(),
                                'status' => 'fail'
                            ];
                                return $this->respond($output,502);
                        }

		
	} else {
		return $this->fail('Only post request is allowed');
	}
}
} catch (\Exception $e) {
	$output = [
			'message' => 'Access denied',
			'error' => $e->getMessage()
		];
		return $this->respond($output, 401);
}
}
    }

    public function getbanktransaction(){
    	$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
		// 	try {
		// 		$decode = JWT::decode($token,$secret_key,array('HS256'));
		// 		if($decode){
							$data = $this->model->getbanktransactiondetails();
							$bank_details = $this->model->getbankbalance();
							$output = [
								'status' => 'success',
								'data' => $data,
								'bank_details' => $bank_details
							];
							return $this->respond($output, 200);
				
		// 		}
		// 	} catch (\Exception $e) {
		// 		$output = [
		// 				'message' => 'Access denied',
		// 				'error' => $e->getMessage()
		// 			];
		// 			return $this->respond($output, 401);
		// 	}
		// }
    }


}
?>
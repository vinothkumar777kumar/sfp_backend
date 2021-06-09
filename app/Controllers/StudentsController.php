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
class StudentsController extends ResourceController
{
	protected $modelName = 'App\Models\StudentsModel';
	
	public function __construct(){
$this->protect = new AuthController();
	}

		public function index(){
 // $email = \Config\Services::email();
	// 						// $logo_path = base_url().'/assets/images/logo.jpg';
 // $logo_path = 'https://www.ndscs.edu/sites/default/files/2019-06/Student-Sponsorship_logo.jpg';
	// 						$email->attach($logo_path);
	// 						$to = 'gowtham@mailinator.com';
	// 						$subject = 'Sponsorship Approved';
 //                            $message = "Hi Gowtham ,<br><br>you has been approved student sponsorship<br><br>"
 //                            ."<br><br>Thanks<br>Team";
							
	// 						$email->setFrom('kvinoth77kumar@gmail.com', 'Info');
	// 						$email->setTo($to);
	// 						// $email->setCC('another@example.com');
	// 						// $email->setBCC('and@another.com');
							
	// 						$email->setSubject($subject);
	// 						$email->setMessage($message);
	// 							if($email->send()){
	// 							echo 'ok';
	// 						}else{
	// 							$data = $email->printDebugger(['headers']);
	// 							print_r($data);
	// 							}
	}

	public function getallstudent()
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
							$teams = $this->model->orderBy('created_at', 'DESC')->where('role_type',3)->findAll();
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

	
	public function getallpendingapprovalstudents()
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
							// $data = $this->model->orderBy('created_at', 'DESC')->where('pending',1)->findAll();
		$data = $this->model->getpendingapprovalstudent();
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

	

    	public function approvalstudent($student_id){
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
	$this->validation = \Config\Services::validation();
	if ($this->request->getMethod() == 'post') {
		$data = $this->request->getJSON();
		// return json_encode($data->student_id);
	$student_data = [
		'approval' => 1,
		'pending' => 0,
		'reject' => 0
		];
		
			
			// echo json_encode($userdata);
			$res =  $this->model->updatestatus($student_id,$student_data);
			// $res =  $this->model->where(['id' => $data->student_id])->set($student_data)->update();
		if($res){
			$stu_data = $this->model->getstudentdata($student_id);
			// return json_encode($stu_data[0]->email);
			 $email = \Config\Services::email();
							// $logo_path = base_url().'/assets/images/logo.jpg';
			 $logo_path = 'https://www.ndscs.edu/sites/default/files/2019-06/Student-Sponsorship_logo.jpg';
							$email->attach($logo_path);
							$to = $stu_data[0]->email;
							$subject = 'Sponsorship Approved';
                            $message = 'Hi '.$stu_data[0]->name.' '.$stu_data[0]->last_name.",<br><br>You has been approved student sponsorship.<br><br>"
                            ."<br><br>Thanks<br>Team";
							
							$email->setFrom('Info@email.com', 'Info');
							$email->setTo($to);
							// $email->setCC('another@example.com');
							// $email->setBCC('and@another.com');
							
							$email->setSubject($subject);
							$email->setMessage($message);
                            $output = [
                                'message' => 'Student Sponsorship Approval Successfully',
                                'status' => 'success'
                            ];
                            if($email->send()){
                                $output['mail_sent'] = true;
                            }else{
                                $output['mail_sent'] = false;
                            }
                                return $this->respond($output,200);
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

    	public function pendingstudent($student_id){
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
		// 	try {
		// 		$decode = JWT::decode($token,$secret_key,array('HS256'));
		// 		if($decode){
	helper(['form', 'url']);
	$this->validation = \Config\Services::validation();
	if ($this->request->getMethod() == 'post') {
		
	$student_data = [
		'pending' => 1,
		'approval' => 0,
		'reject' => 0
		];
		
			
			// echo json_encode($userdata);
		$res =  $this->model->updatestatus($student_id,$student_data);
			// $res =  $this->model->where(['id' => $student_id])->set($student_data)->update();
		if($res){
						$stu_data = $this->model->getstudentdata($student_id);
			// return json_encode($stu_data[0]->email);
			 $email = \Config\Services::email();
							// $logo_path = base_url().'/assets/images/logo.jpg';
			 $logo_path = 'https://www.ndscs.edu/sites/default/files/2019-06/Student-Sponsorship_logo.jpg';
							$email->attach($logo_path);
							$to = $stu_data[0]->email;
							$subject = 'Sponsorship Pending';
                            $message = 'Hi '.$stu_data[0]->name.' '.$stu_data[0]->last_name.",<br><br>You has been pending student sponsorship.<br><br>"
                            ."<br><br>Thanks<br>Team";
							
							$email->setFrom('Info@email.com', 'Info');
							$email->setTo($to);
							// $email->setCC('another@example.com');
							// $email->setBCC('and@another.com');
							
							$email->setSubject($subject);
							$email->setMessage($message);
                            $output = [
                                'message' => 'Student Sponsorship Pending Successfully',
                                'status' => 'success'
                            ];
                            if($email->send()){
                                $output['mail_sent'] = true;
                            }else{
                                $output['mail_sent'] = false;
                            }
                                return $this->respond($output,200);
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
// }
// } catch (\Exception $e) {
// 	$output = [
// 			'message' => 'Access denied',
// 			'error' => $e->getMessage()
// 		];
// 		return $this->respond($output, 401);
// }
// }
    }

    public function rejectstudent($student_id){
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
	$this->validation = \Config\Services::validation();
	if ($this->request->getMethod() == 'post') {
		
	$student_data = [
		'pending' => 0,
		'approval' => 0,
		'reject' => 1
		];
		
			
			// echo json_encode($userdata);
		$res =  $this->model->updatestatus($student_id,$student_data);
			// $res =  $this->model->where(['id' => $student_id])->set($student_data)->update();
		if($res){
								$stu_data = $this->model->getstudentdata($student_id);
			// return json_encode($stu_data[0]->email);
			 $email = \Config\Services::email();
							// $logo_path = base_url().'/assets/images/logo.jpg';
			 $logo_path = 'https://www.ndscs.edu/sites/default/files/2019-06/Student-Sponsorship_logo.jpg';
							$email->attach($logo_path);
							$to = $stu_data[0]->email;
							$subject = 'Sponsorship Rejected';
                            $message = 'Hi '.$stu_data[0]->name.' '.$stu_data[0]->last_name.",<br><br>I am sorry.your has been rejected sponsorship.<br><br>"
                            ."<br><br>Thanks<br>Team";
							
							$email->setFrom('Info@email.com', 'Info');
							$email->setTo($to);
							// $email->setCC('another@example.com');
							// $email->setBCC('and@another.com');
							
							$email->setSubject($subject);
							$email->setMessage($message);
                            $output = [
                                'message' => 'Student Sponsorship Rejected Successfully',
                                'status' => 'success'
                            ];
                            if($email->send()){
                                $output['mail_sent'] = true;
                            }else{
                                $output['mail_sent'] = false;
                            }
                                return $this->respond($output,200);
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

	public function addstudent(){
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
		// team logo
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
					// return json_encode($_FILES['profile_image']['name']);
		$personal_data = [
			'profile_image' => $team_random_name,
			'name'=> $data['name'],
			'last_name'=> $data['last_name'],
			'gender'=> $data['gender'],
			'dateofbirth'=> $data['dateofbirth'],
			'email'=> $data['email'],
			'mobile'=> $data['mobile'],
			'address_one'=> $data['address_one'],
			'address_two'=> $data['address_two'],
			'city'=> $data['city'],
			'state'=> $data['state'],
			'zip_code'=> $data['zip_code'],
			'role_type'=> $data['role_type'],
			'status' => $data['status'],
			'referred_by' => $data['referred_by'],
			'referred_contact' => $data['referred_contact']
		];

		// return json_encode($data);
		
	$student_id = $this->model->addpersonaldetails($personal_data);
                        if($student_id){
                        	// parentdetails
                        		$parent_data = [
                        			'student_id' => $student_id,
									'fatherorguardian_name'=> $data['fatherorguardian_name'],
									'parent_lastname'=> $data['parent_lastname'],
									'parent_age' => $data['parent_age'],
									'parent_occupation'=> $data['parent_occupation'],
									'fatherorgardian_mobile'=> $data['fatherorgardian_mobile'],
									'parent_address_one'=> $data['parent_address_one'],
									'parent_address_two'=> $data['parent_address_two'],
									'parent_city'=> $data['parent_city'],
									'parent_state'=> $data['parent_state'],
									'parent_zip_code'=> $data['parent_zip_code'],
									'work_status'=> $data['work_status'],
									'name_of_organizations'=> $data['name_of_organizations'],
									'contact_of_organizations'=> $data['contact_of_organizations'],
									'organizations_address_one'=> $data['organizations_address_one'],
									'organizations_address_two'=> $data['organizations_address_two'],
									'organizations_city'=> $data['organizations_city'],
									'organizations_state'=> $data['organizations_state'],
									'organizations_pincode'=> $data['organizations_pincode'],
									'why_need_sponsorship' => $data['why_need_sponsorship']
								];
								$parent_id = $this->model->addparentdetails($parent_data);
								if($parent_id){
										$college_data = [
											'student_id' => $student_id,
											'collegeofstudy'=> $data['collegeofstudy'],
											'contact_person'=> $data['contact_person'],
											'contact_person_mobile'=> $data['contact_person_mobile'],
											'college_phone'=> $data['college_phone'],
											'college_email'=> $data['college_email'],
											'college_address_one'=> $data['college_address_one'],
											'college_address_two'=> $data['college_address_two'],
											'college_city'=> $data['college_city'],
											'college_state'=> $data['college_state'],
											'college_zip_code'=> $data['college_zip_code'],
											'course_name'=> $data['course_name'],
											'study_duration'=> $data['study_duration'],
											'current_semester'=> $data['current_semester'],
											'academic_year'=> $data['academic_year'],
											'join_date'=> $data['join_date'],
											'transfer_option'=> $data['transfer_option'],
											'bank_name'=> $data['bank_name'],
											'branch_name'=> $data['branch_name'],
											'ifsc_code'=> $data['ifsc_code'],
											'bank_account_no'=> $data['bank_account_no'],
											'dd_favouring'=> $data['dd_favouring'],
											'due_date'=> $data['due_date'],
											'payment_type'=> $data['payment_type']
										];
										$college_id = $this->model->addcollegedetails($college_data);
										if($college_id){
										$fees_data = json_decode($data['fees_type'],true);
										foreach($fees_data as $f){	
					$fees_arr[] = [
						'student_id' => $student_id,
						'fees_type'=> $f['fees_type'],
						'fees_per_semester' => $f['fees_per_semester']
					];
				
				}
										$res = $this->model->addfees($fees_arr);
										  $output = [
										                                'message' => 'Student Details Saved Successfully',
										                                'status' => 'success'
										                            ];
                                return $this->respond($output,200);
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

      public function editstudent($id)
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
					// $getteams = $this->model->find($id);
		$getuser = $this->model->editstudentdata($id);
					$sponsor = $this->model->getstudentsponsordata($id);
					$output = [
						'status' => 'success',
						'data' => $getuser,
						'studentassignsponsor' => $sponsor
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

     public function getstudentassignedsponsordata($id)
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
					// $getteams = $this->model->find($id);
		$studentdata = $this->model->getstudentdata($id);
					$sponsor = $this->model->getstudentsponsordata($id);
					$output = [
						'status' => 'success',
						'data' => $studentdata,
						'studentassignsponsor' => $sponsor
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
    // student update details
    public function updatestudentprofile(){
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
$personal_data = [
			'profile_image' => $teamonerandom_name,
			'name'=> $data['name'],
			'last_name'=> $data['last_name'],
			'gender'=> $data['gender'],
			'dateofbirth'=> $data['dateofbirth'],
			'email'=> $data['email'],
			'mobile'=> $data['mobile'],
			'address_one'=> $data['address_one'],
			'address_two'=> $data['address_two'],
			'city'=> $data['city'],
			'state'=> $data['state'],
			'zip_code'=> $data['zip_code'],
			'role_type'=> $data['role_type'],
			'status' => $data['status'],
			'referred_by' => $data['referred_by'],
			'referred_contact' => $data['referred_contact']
		];
		
			
			$student_id = $data['id'];
			// return json_encode($student_id);
			$res =  $this->model->where(['id' => $student_id])->set($personal_data)->update();
		if($res){
			// return json_encode($student_id);
				// parentdetails
                        		$parent_data = [
                        			'student_id' => $student_id,
									'fatherorguardian_name'=> $data['fatherorguardian_name'],
									'parent_lastname'=> $data['parent_lastname'],
									'parent_age' => $data['parent_age'],
									'parent_occupation'=> $data['parent_occupation'],
									'fatherorgardian_mobile'=> $data['fatherorgardian_mobile'],
									'parent_address_one'=> $data['parent_address_one'],
									'parent_address_two'=> $data['parent_address_two'],
									'parent_city'=> $data['parent_city'],
									'parent_state'=> $data['parent_state'],
									'parent_zip_code'=> $data['parent_zip_code'],
									'work_status'=> $data['work_status'],
									'name_of_organizations'=> $data['name_of_organizations'],
									'contact_of_organizations'=> $data['contact_of_organizations'],
									'organizations_address_one'=> $data['organizations_address_one'],
									'organizations_address_two'=> $data['organizations_address_two'],
									'organizations_city'=> $data['organizations_city'],
									'organizations_state'=> $data['organizations_state'],
									'organizations_pincode'=> $data['organizations_pincode'],
									'why_need_sponsorship' => $data['why_need_sponsorship']
								];
								$parentdata = $this->model->getparentdata($student_id);
								if(!empty($parentdata)){
								$parent_update =  $this->model->update_parent_details($student_id,$parent_data);	
							}else{
								$parent_update = $this->model->addparentdetails($parent_data);
							}
								// return json_encode($parent_data);
									
									// return json_encode($parentdata);
								// $parent_update =  $this->model->where(['id' => $student_id])->set($parent_data)->update();
									if($parent_update){
										$college_data = [
											'student_id' => $student_id,
											'collegeofstudy'=> $data['collegeofstudy'],
											'contact_person'=> $data['contact_person'],
											'contact_person_mobile'=> $data['contact_person_mobile'],
											'college_phone'=> $data['college_phone'],
											'college_email'=> $data['college_email'],
											'college_address_one'=> $data['college_address_one'],
											'college_address_two'=> $data['college_address_two'],
											'college_city'=> $data['college_city'],
											'college_state'=> $data['college_state'],
											'college_zip_code'=> $data['college_zip_code'],
											'join_date'=> $data['join_date'],
											'course_name'=> $data['course_name'],
											'study_duration'=> $data['study_duration'],
											'current_semester'=> $data['current_semester'],
											'academic_year'=> $data['academic_year'],
											'transfer_option'=> $data['transfer_option'],
											'bank_name'=> $data['bank_name'],
											'branch_name'=> $data['branch_name'],
											'ifsc_code'=> $data['ifsc_code'],
											'bank_account_no'=> $data['bank_account_no'],
											'dd_favouring'=> $data['dd_favouring'],
											'due_date'=> $data['due_date'],
											'payment_type'=> $data['payment_type']
										];
										$collegedata = $this->model->getcollegedata($student_id);
								if(!empty($collegedata)){
								$college_update =  $this->model->update_college_details($student_id,$college_data);	
							}else{
								$college_update = $this->model->addcollegedetails($college_data);
								// $parent_update = $this->model->addparentdetails($parent_data);
							}
										
										if($college_update){
											$fees_data = json_decode($data['fees_type'],true);
						$getfeesdata = $this->model->getfeesdata($student_id);
						// return json_encode($getfeesdata);
						if(!empty($getfeesdata) && is_array($getfeesdata)){
							if($this->model->deletefees($student_id)){
										foreach($fees_data as $f){	
					$fees_arr[] = [
						'student_id' => $student_id,
						'fees_type'=> $f['fees_type'],
						'fees_per_semester' => $f['fees_per_semester']
					];
				
				}
								$res = $this->model->addfees($fees_arr);
				                $output = [
				                    'status' => 'success',
				                    'message' => 'Student Details Update Successfully.'
				                ];
				                return $this->respond($output, 200);
							}
						}else if(empty($getfeesdata)){
											foreach($fees_data as $f){	
					$fees_arr[] = [
						'student_id' => $student_id,
						'fees_type'=> $f['fees_type'],
						'fees_per_semester' => $f['fees_per_semester']
					];
				
				}
							$res = $this->model->addfees($fees_arr);
				                $output = [
				                    'status' => 'success',
				                    'message' => 'Student Details Update Successfully.'
				                ];
				                return $this->respond($output, 200);
						}else{
							      $output = [
					                    'status' => 'faile',
					                    'error' =>  $this->db->error()
					                ];
					                return $this->respond($output, 401); 
						}			
                     
										}
									}
                            // $output = [
                            //     'message' => 'Student Update Successfully',
                            //     'status' => 'success'
                            // ];
                            //     return $this->respond($output,200);
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

    
// admin update student details
    public function updatestudent(){
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
$personal_data = [
			'profile_image' => $teamonerandom_name,
			'name'=> $data['name'],
			'last_name'=> $data['last_name'],
			'gender'=> $data['gender'],
			'dateofbirth'=> $data['dateofbirth'],
			'email'=> $data['email'],
			'mobile'=> $data['mobile'],
			'address_one'=> $data['address_one'],
			'address_two'=> $data['address_two'],
			'city'=> $data['city'],
			'state'=> $data['state'],
			'zip_code'=> $data['zip_code'],
			'role_type'=> $data['role_type'],
			'status' => $data['status'],
			'referred_by' => $data['referred_by'],
			'referred_contact' => $data['referred_contact']
		];
		
			
			$student_id = $data['id'];
			// return json_encode($student_id);
			$res =  $this->model->where(['id' => $student_id])->set($personal_data)->update();
		if($res){
			// return json_encode($student_id);
				// parentdetails
                        		$parent_data = [
                        			'student_id' => $student_id,
									'fatherorguardian_name'=> $data['fatherorguardian_name'],
									'parent_lastname'=> $data['parent_lastname'],
									'parent_age' => $data['parent_age'],
									'parent_occupation'=> $data['parent_occupation'],
									'fatherorgardian_mobile'=> $data['fatherorgardian_mobile'],
									'parent_address_one'=> $data['parent_address_one'],
									'parent_address_two'=> $data['parent_address_two'],
									'parent_city'=> $data['parent_city'],
									'parent_state'=> $data['parent_state'],
									'parent_zip_code'=> $data['parent_zip_code'],
									'work_status'=> $data['work_status'],
									'name_of_organizations'=> $data['name_of_organizations'],
									'contact_of_organizations'=> $data['contact_of_organizations'],
									'organizations_address_one'=> $data['organizations_address_one'],
									'organizations_address_two'=> $data['organizations_address_two'],
									'organizations_city'=> $data['organizations_city'],
									'organizations_state'=> $data['organizations_state'],
									'organizations_pincode'=> $data['organizations_pincode'],
									'why_need_sponsorship' => $data['why_need_sponsorship']
								];
								// return json_encode($parent_data);
									$parent_update =  $this->model->update_parent_details($student_id,$parent_data);
									// return json_encode($parent_update);
								// $parent_update =  $this->model->where(['id' => $student_id])->set($parent_data)->update();
									if($parent_update){
										$college_data = [
											'student_id' => $student_id,
											'collegeofstudy'=> $data['collegeofstudy'],
											'contact_person'=> $data['contact_person'],
											'contact_person_mobile'=> $data['contact_person_mobile'],
											'college_phone'=> $data['college_phone'],
											'college_email'=> $data['college_email'],
											'college_address_one'=> $data['college_address_one'],
											'college_address_two'=> $data['college_address_two'],
											'college_city'=> $data['college_city'],
											'college_state'=> $data['college_state'],
											'college_zip_code'=> $data['college_zip_code'],
											'course_name'=> $data['course_name'],
											'study_duration'=> $data['study_duration'],
											'current_semester'=> $data['current_semester'],
											'academic_year'=> $data['academic_year'],
											'join_date'=> $data['join_date'],
											'transfer_option'=> $data['transfer_option'],
											'bank_name'=> $data['bank_name'],
											'branch_name'=> $data['branch_name'],
											'ifsc_code'=> $data['ifsc_code'],
											'bank_account_no'=> $data['bank_account_no'],
											'dd_favouring'=> $data['dd_favouring'],
											'due_date'=> $data['due_date'],
											'payment_type'=> $data['payment_type']
										];
										$college_update =  $this->model->update_college_details($student_id,$college_data);
										if($college_update){
											$fees_data = json_decode($data['fees_type'],true);
						$getfeesdata = $this->model->getfeesdata($student_id);
						// return json_encode($getfeesdata);
						if(!empty($getfeesdata) && is_array($getfeesdata)){
							if($this->model->deletefees($student_id)){
										foreach($fees_data as $f){	
					$fees_arr[] = [
						'student_id' => $student_id,
						'fees_type'=> $f['fees_type'],
						'fees_per_semester' => $f['fees_per_semester']
					];
				
				}
								$res = $this->model->addfees($fees_arr);
				                $output = [
				                    'status' => 'success',
				                    'message' => 'Student Details Update Successfully.'
				                ];
				                return $this->respond($output, 200);
							}
						}else if(empty($getfeesdata)){
											foreach($fees_data as $f){	
					$fees_arr[] = [
						'student_id' => $student_id,
						'fees_type'=> $f['fees_type'],
						'fees_per_semester' => $f['fees_per_semester']
					];
				
				}
							$res = $this->model->addfees($fees_arr);
				                $output = [
				                    'status' => 'success',
				                    'message' => 'Student Details Update Successfully.'
				                ];
				                return $this->respond($output, 200);
						}else{
							      $output = [
					                    'status' => 'faile',
					                    'error' =>  $this->db->error()
					                ];
					                return $this->respond($output, 401); 
						}			
                     
										}
									}
                            // $output = [
                            //     'message' => 'Student Update Successfully',
                            //     'status' => 'success'
                            // ];
                            //     return $this->respond($output,200);
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

     public function deletestudent($id){
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		$token = $arr[1];
		if($token){
			try {
				$decode = JWT::decode($token,$secret_key,array('HS256'));
				if($decode){
                    $delete = $this->model->delete($id);
                
					if($delete){
					$output = [
                        'status' => 'success',
                        'message' => 'Student Deleted Successfully'
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

	

	public function deleteprofileimage($image_name){
		$path = "uploads/profile/".$image_name;
		if(file_exists($path)){
			unlink($path);
			$output = [
				'message' => 'Profile Image Deleted.',
				'status' => 'success'
			];
				return $this->respond($output,200);
		}
		else{
			// echo $path." is not available";  
			$output = [
				'message' =>  $path." is not available",
				'status' => 'faile'
			];
				return $this->respond($output,401);  
		}
		// return $ul;
	}

	// get student sponsors data stats_rand_ranf()
 public function getstudentsponsordata($student_id)
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
					$data = $this->model->getstudentsponsordata($student_id);
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

	 
}
?>
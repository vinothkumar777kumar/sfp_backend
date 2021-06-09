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
class NotificationController extends ResourceController
{
	protected $modelName = 'App\Models\NotificationModel';
	
	public function __construct(){
		$this->protect = new AuthController();
	}

	public function getsponsorshippaiddata()
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
		$data = $this->model->getallsponsorshippaiddata();
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

	

	public function getnotificationdata($id)
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
		$getteams = $this->model->getnotification($id);
		
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
						$student_data = [
							'profile_image' => $teamonerandom_name,
							'name'=> $data['name'],
							'last_name'=> $data['last_name'],
							'fatherorguardian_name'=> $data['fatherorguardian_name'],
							'gender'=> $data['gender'],
							'dateofbirth'=> $data['dateofbirth'],
							'email'=> $data['email'],
							'mobile'=> $data['mobile'],
							'fatherorgardian_mobile'=> $data['fatherorgardian_mobile'],
							'address_one'=> $data['address_one'],
							'address_two'=> $data['address_two'],
							'city'=> $data['city'],
							'state'=> $data['state'],
							'zip_code'=> $data['zip_code'],
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
							'academic_year'=> $data['academic_year'],
							'join_date'=> $data['join_date'],
							'role_type'=> $data['role_type'],
							'status' => $data['status']
						];
						
						
						$update_id = $data['id'];
			// echo json_encode($userdata);
						$res =  $this->model->where(['id' => $update_id])->set($student_data)->update();
						if($res){
							$output = [
								'message' => 'Student Update Successfully',
								'status' => 'success'
							];
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

	public function sponsorrevelrequest(){
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
						$revel_req = '';
						if($data->revel_request == 'notrevel'){
							$revel_req = 0;
						}else if($data->revel_request == 'revel'){
							$revel_req = 1;
						}
						$revel_data = [
							'student_id' => $data->student_id,
							'sponsor_id' => $data->sponsor_id,
							'revel_status' => $revel_req
						];
		// $stu_data = $this->model->getstudentdata($data->student_id);
			    	// if(!empty($student_data)){
			    	// 	$res =  $this->model->updatestatus($data->student_id,$student_data);
			    	// }
						$insert = $this->model->addrevel($revel_data);
						if($insert){
							$output = [
								'message' => 'Request Successfully Send to Admin',
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


	public function getrevelnotification()
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
		$data = $this->model->getreveldata();
		
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

	public function studentrevelstatusupdate(){
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
						$update_status = [
							'revel_sponsor_details' => $data->revel_status
						];
		// $stu_data = $this->model->getstudentdata($data->student_id);
			    	// if(!empty($student_data)){
						$res =  $this->model->updatestatus($data->student_id,$update_status);
			    	// }
						// $insert = $this->model->addrevel($revel_data);
						if($res){
							$output = [
								'message' => 'Update Successfully',
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

	
}
?>
<?php namespace App\Controllers;
use \Firebase\JWT\JWT;
use App\Controllers\AuthController;
use CodeIgniter\RESTful\ResourceController;


header('Access-Control-Allow-Origin: *');        
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization, Token, App-version,Access-Control-Allow-Headers");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Max-Age: 3600'); 

class Home extends ResourceController
{
	protected $modelName = 'App\Models\HomeModel';
	public function __construct(){
		$this->protect = new AuthController();
	}
	public function index()
	{
	// 	 $email = \Config\Services::email();
	// 						// $logo_path = base_url().'/assets/images/logo.jpg';
 // $logo_path = 'https://www.ndscs.edu/sites/default/files/2019-06/Student-Sponsorship_logo.jpg';
	// 						$email->attach($logo_path);
	// 						$to = 'kvinoth777kumar@gmail.com';
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
		$getuser = $this->model->paymentnotification();
		$today = date('d-m-Y');
		$today_date = date('d');
		$today_month = date('m');
		$today_year = date('Y');
		$oneweekdate = date("Y-m-d", strtotime("-15 days"));
		foreach ($getuser as $key => $value) {
			
			// return json_encode($toemails);
			if($value->due_date != ''){
				if($value->next_notification_date != ''){
					if(strtotime($today) == strtotime($value->next_notification_date)){
						if($value->payment_type == '1'){
							$m = '+'.$value->payment_type.' month';
						}else if($value->payment_type == '6'){
							$m = '+'.$value->payment_type.' month';
						}else if($value->payment_type == '12'){
							$m = '+'.$value->payment_type.' month';
						}else{
							$cal_month = 12/$value->payment_type;
							$m = '+'.$cal_month.' month';
						}
						$nxt_noti_data = [
							'next_notification_date' =>date('d-m-Y',strtotime(date("Y-m-d", strtotime($value->next_notification_date)).$m))
						];
						$update_next_notification = $this->model->updatenotificationdate($value->student_id,$nxt_noti_data);
				// strtotime(date("Y-m-d", strtotime($notification_date)),$m);
				// echo "send notif";
						if($update_next_notification){
							$getsponsor_email = $this->model->getstudentsponsoremail($value->student_id);
							$getadmin_email = $this->model->getadminemail();
							$toemails = array();
							$toemails[] = $value->email;
							if(!empty($getsponsor_email)){
								foreach ($getsponsor_email as $key => $val) {
									$toemails[] = $val->email;
								}
							}
							if(!empty($getadmin_email)){
								foreach ($getadmin_email as $key => $val) {
									$toemails[] = $val->email;
								}
							}
							$email = \Config\Services::email();
							// $logo_path = base_url().'/assets/images/logo.jpg';
							$logo_path = 'https://www.ndscs.edu/sites/default/files/2019-06/Student-Sponsorship_logo.jpg';
							$email->attach($logo_path);
							$to = $toemails;
							$subject = 'Student Fees Payment';
							$pay_date = date('d-m-Y',strtotime(date("Y-m-d", strtotime($value->next_notification_date))."+15 days"));
							$message = 'Hi '.$value->name.' '.$value->last_name.",<br><br>".$value->name.' '.$value->last_name." The days are approaching when you have to pay.<br><br>The day to pay ".$pay_date.".<br><br>"
							."<br><br>Thanks<br>Team";
							
							$email->setFrom('kvinoth77kumar@gmail.com', 'Info');
							$email->setTo($to);
							// $email->setCC('another@example.com');
							// $email->setBCC('and@another.com');
							
							$email->setSubject($subject);
							$email->setMessage($message);
							$email->send();
							// 	if($email->send()){
							// 	echo 'ok';
							// }else{
							// 	$data = $email->printDebugger(['headers']);
							// 	print_r($data);
							// 	}
						}
					}
					
				}else{
					$split_date = explode('-', $value->due_date);
					$joind = $split_date[0].'-'.$split_date[1].'-'.$today_year;
					$notification_date = date('d-m-Y',strtotime(date('d-m-Y',strtotime($joind))."-15 days"));
					
					if(strtotime($today) == strtotime($notification_date)){
						if($value->payment_type == '1'){
							$m = '+'.$value->payment_type.' month';
						}else if($value->payment_type == '6'){
							$m = '+'.$value->payment_type.' month';
						}else if($value->payment_type == '12'){
							$m = '+'.$value->payment_type.' month';
						}else{
							$cal_month = 12/$value->payment_type;
							$m = '+'.$cal_month.' month';
						}
						$nxt_noti_data = [
							'next_notification_date' =>date('d-m-Y',strtotime(date("Y-m-d", strtotime($notification_date)).$m))
						];
						$update_next_notification = $this->model->updatenotificationdate($value->student_id,$nxt_noti_data);
					// strtotime(date("Y-m-d", strtotime($notification_date)),$m);
					// echo "send notif";
						if($update_next_notification){
							$getsponsor_email = $this->model->getstudentsponsoremail($value->student_id);
							$getadmin_email = $this->model->getadminemail();
							$toemails = array();
							$toemails[] = $value->email;
							if(!empty($getsponsor_email)){
								foreach ($getsponsor_email as $key => $val) {
									$toemails[] = $val->email;
								}
							}
							if(!empty($getadmin_email)){
								foreach ($getadmin_email as $key => $val) {
									$toemails[] = $val->email;
								}
							}
							$email = \Config\Services::email();
								// $logo_path = base_url().'/assets/images/logo.jpg';
							$logo_path = 'https://www.ndscs.edu/sites/default/files/2019-06/Student-Sponsorship_logo.jpg';
							$email->attach($logo_path);
							$to = $toemails;
							$subject = 'Student Fees Payment';
							$message = 'Hi '.$value->name.' '.$value->last_name.",<br><br>".$value->name.' '.$value->last_name." The days are approaching when you have to pay.<br><br>The day to pay ".$value->due_date.".<br><br>"
							."<br><br>Thanks<br>Team";
							
							$email->setFrom('kvinoth77kumar@gmail.com', 'Info');
							$email->setTo($to);
								// $email->setCC('another@example.com');
								// $email->setBCC('and@another.com');
							
							$email->setSubject($subject);
							$email->setMessage($message);
							$email->send();
								// 	if($email->send()){
								// 	echo 'ok';
								// }else{
								// 	$data = $email->printDebugger(['headers']);
								// 	print_r($data);
								//
						}
					}
					
				}
			// 	$split_date = explode('-', $value->next_notification_date);
			// 	$joind = $split_date[0].'-'.$split_date[1].'-'.$today_year;
			// 	$notification_date = date('d-m-Y',strtotime(date('d-m-Y',strtotime($joind))."-15 days"));
			// $cal_month = 12/$value->payment_type;
			// 			$m = '+'.$cal_month.' month';
			// 		$stud[] = [
			// 			'today' => $today,
			// 			'next_notifcation_date' => date('d-m-Y',strtotime(date("Y-m-d", strtotime($notification_date)).$m)),
			// 			'cur_due_date' => date('d-m-Y',strtotime(date('d-m-Y',strtotime($value->next_notification_date))."-15 days")),
			// 			'email' => $value->email,
			// 			'due_date' => $value->due_date,
			// 			'payment_type' => $value->payment_type,
			// 			'notification_date' => $value->next_notification_date
			// 		];
			}

		}

		
		// return json_encode($stud);
		// return view('welcome_message');
	}

	public function getUsers($id)
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
		$getuser = $this->model->getstudentdata($id);
					// $getuser = $this->model->find($id);
		$getnotification = $this->model->getsponsorshippaiddata($id);
		$revel_data = $this->model->getreveldata();
		
		$output = [
			'status' => 'success',
			'data' => $getuser,
			'notification_data' => $getnotification,
			'reveldata' => $revel_data
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

	public function update_mypassword(){
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
						$data = [
							'user_id'=> $data->user_id,
							'current_password' => $data->current_password,
							'new_password' => $data->new_password,
							'confirm_password' => $data->confirm_password
						];
						
						
						$res = $this->model->updatepassword($data);
						// return json_encode($res);
						if($res == false){
							$output = [
								'message' => 'Current password does not match',
								'status' => "faile"
							];
							return $this->respond($output, 200);
						}else{
							$output = [
								'message' => 'Password Update Successfully.',
								'status' => "success"
							];
							return $this->respond($output, 200);
						}
						// $res =  $this->model->where(['id' => $update_id])->set($userdata)->update();
						// $data['id'] = $res;
						// echo json_encode(['status'=> 'success','message' => 'User Register Successfully.']);
						// return $this->respondCreated(['status' => 'success', 'message' => 'User Update Successfully.']);

						
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

	public function updatestudentpassword(){
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
						$data = [
							'user_id'=> $data->user_id,
							'new_password' => $data->new_password,
							'confirm_password' => $data->confirm_password
						];
						
						
						$res = $this->model->updatestudentpassword($data);
						// return json_encode($res);
						if($res == false){
							$output = [
								'message' => 'Password Not Update',
								'status' => "faile"
							];
							return $this->respond($output, 200);
						}else{
							$output = [
								'message' => 'Password Update Successfully.',
								'status' => "success"
							];
							return $this->respond($output, 200);
						}
						// $res =  $this->model->where(['id' => $update_id])->set($userdata)->update();
						// $data['id'] = $res;
						// echo json_encode(['status'=> 'success','message' => 'User Register Successfully.']);
						// return $this->respondCreated(['status' => 'success', 'message' => 'User Update Successfully.']);

						
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

	//--------------------------------------------------------------------

}

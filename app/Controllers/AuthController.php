<?php
namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use \App\Libraries\Oauth;
use \Firebase\JWT\JWT;
use \OAuth2\Request;
use CodeIgniter\RESTful\ResourceController;

// use chriskacerguis\RestServer\RestController;


class AuthController extends ResourceController
{
    use ResponseTrait;
    private $Auth;
    public function __construct()
    {
        helper('date');
        $this->Auth = new AuthModel();
        $this->setHeaders();

    }



    public function privateKey()
    {
        $privateKey = <<<EOD
                -----BEGIN RSA PRIVATE KEY-----
                MIICXAIBAAKBgQC8kGa1pSjbSYZVebtTRBLxBz5H4i2p/llLCrEeQhta5kaQu/Rn
                vuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t0tyazyZ8JXw+KgXTxldMPEL9
                5+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4ehde/zUxo6UvS7UrBQIDAQAB
                AoGAb/MXV46XxCFRxNuB8LyAtmLDgi/xRnTAlMHjSACddwkyKem8//8eZtw9fzxz
                bWZ/1/doQOuHBGYZU8aDzzj59FZ78dyzNFoF91hbvZKkg+6wGyd/LrGVEB+Xre0J
                Nil0GReM2AHDNZUYRv+HYJPIOrB0CRczLQsgFJ8K6aAD6F0CQQDzbpjYdx10qgK1
                cP59UHiHjPZYC0loEsk7s+hUmT3QHerAQJMZWC11Qrn2N+ybwwNblDKv+s5qgMQ5
                5tNoQ9IfAkEAxkyffU6ythpg/H0Ixe1I2rd0GbF05biIzO/i77Det3n4YsJVlDck
                ZkcvY3SK2iRIL4c9yY6hlIhs+K9wXTtGWwJBAO9Dskl48mO7woPR9uD22jDpNSwe
                k90OMepTjzSvlhjbfuPN1IdhqvSJTDychRwn1kIJ7LQZgQ8fVz9OCFZ/6qMCQGOb
                qaGwHmUK6xzpUbbacnYrIM6nLSkXgOAwv7XXCojvY614ILTK3iXiLBOxPu5Eu13k
                eUz9sHyD6vkgZzjtxXECQAkp4Xerf5TGfQXGXhxIX52yH+N2LtujCdkQZjXAsGdm
                B2zNzvrlgRmgBrklMTrMYgm1NPcW+bRLGcwgW2PTvNM=
                -----END RSA PRIVATE KEY-----
                EOD;
            return $privateKey;
    }

    public function userlogin()
    {

        // $this->setHeaders();
        $data = [];
        helper(['form', 'url']);
        $this->validation = \Config\Services::validation();
        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getJSON();
            $user_data = [
                'email' => $data->email,
                'password' => $data->password
            ];

            $rules = [
                $user_data['email'] => 'required|valid_email',
                $user_data['password'] => 'required|min_length[8]|max_length[255]'
            ];
            $error = $this->validation->setRules($rules);
            $msg = $this->validation->run($user_data, 'login');
            if (!$msg) {
               $output = [
                    'status' => 401,
                    'error'=> $this->validation->getErrors()
                ];
                return $this->respond($output, 200);
            } else {
                
                $model = new AuthModel();
                $userdata = [
                    'email' => $data->email,
                    'password' => $data->password
                ];
                // return $data->email;
                $email = $data->email;
                $password = $data->password;
                $check_login = $this->Auth->check_login($email);
                // return json_encode($check_login);
                 // print_r($check_login);
                if(empty($check_login)){
                    $output = [
                        'status' => 401,
                        'message' => 'Invalid username or password'
                    ];
                    return $this->respond($output, 401);
                }else if(!empty($check_login) && is_array($check_login)){
                    if(password_verify($password, $check_login['password'])){
                   $secret_key = $this->privateKey();
                    $issuser_claim = "THE_CLAIM";
                    $audience_claim = "THE_AUDIENCE";
                    $issuedat_claim = time();
                    $notbefore_claim = $issuedat_claim + 10;
                    $expire_claim = $issuedat_claim + 3600;

                    $token = [
                        "iss" => $issuser_claim,
                        "aud" => $audience_claim,
                        "iat" => $issuedat_claim,
                        "nbf" => $notbefore_claim,
                        "exp" => $expire_claim,
                        "data" => [
                            'id' => $check_login['id'],
                            'name' => $check_login['name'],
                            'email' => $check_login['email'],
                            'mobile' => $check_login['mobile']
                        ]
                    ];

                    $token = JWT::encode($token,$secret_key);
                    $output = [
                        'status' => 'success',
                        'message' => 'Login Successfully',
                        'token' => $token,
                        'expireat' => $expire_claim,
                        'user_id' => $check_login['id'],
                        'role_type'=>$check_login['role_type'],
                        'revel_sponsor_details' => $check_login['revel_sponsor_details']
                    ];
                    return $this->respond($output, 200); 
                }else {
                   $output = [
                        'status' => 401,
                        'message' => 'Invalid username or password'
                    ];
                    return $this->respond($output, 401);
                }
                }else{
                     $output = [
                        'status' => 401,
                        'message' => $check_login
                    ];
                    return $this->respond($output, 401);
                }
          

            }
        } else {
            return $this->fail('Only post request is allowed');
        }
    }

    /**
     * Set headers
     */
    public function setHeaders()
    {


        if (ENVIRONMENT === 'development') {

            header('Access-Control-Allow-Origin: *');
        } else if (ENVIRONMENT === 'staging') {
            header('Access-Control-Allow-Origin: https://test.myApp.com');
        }
        if (ENVIRONMENT === 'production') {
            header('Access-Control-Allow-Origin: https://myApp.com');
        }
        return json_encode('hi');
        header("Content-type: application/json");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization, Token, App-version");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    }

    public function login()
    {

        // header("Access-Control-Allow-Origin:*");
        //       header("Access-Control-Allow-Methods: PUT,POST,OPTIONS,DELETE,GET");
        //       header("Access-Control-Allow-Headers:access-control-allow-origin");
        // $user = $this->input->post("user");
        // $pwd = $this->input->post("pass");
        $oauth = new Oauth();
        $request = new Request();
        $respond = $oauth->server->handleTokenRequest($request->createFromGlobals());
        $code = $respond->getStatusCode();
        $body = $respond->getResponseBody();
        return $this->respond(json_decode($body), $code);
    }

    public function user_register()
    {

        header('Access-Control-Allow-Origin: *');        
        header("Content-type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization, Token, App-version,Access-Control-Allow-Headers");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header('Access-Control-Max-Age: 3600');
        $data = [];
        helper(['form', 'url']);
        $this->validation = \Config\Services::validation();
        if ($this->request->getMethod() == 'post') {
            // return 'hi';
            $data = $this->request->getJSON();
            $user_data = [
                'name' => $data->name,
                'email' => $data->email,
                'password' => $data->password,
                'mobile' => $data->mobile
            ];
            // return  $user_data['name'];
            $rules = [
                $user_data['name'] => 'required|min_length[3]|max_length[20]',
                $user_data['email'] => 'required|valid_email|is_unique[users.email]',
                $user_data['password'] => 'required|min_length[8]|max_length[255]',
                $user_data['mobile'] => 'required|is_unique[users.mobile]'
            ];
            $error = $this->validation->setRules($rules);
            $msg = $this->validation->run($user_data, 'register');

            // $errors = $this->validation->getErrors();
            // echo json_encode($this->validation->getErrors());
            // return json_encode($msg);
            if (!$msg) {
                return $this->respondCreated(['status' => false, 'error' => $this->validation->getErrors()]);
            } else {
                $model = new AuthModel();
                $secret_key = $this->privateKey();
                $issuser_claim = "THE_CLAIM";
                $audience_claim = "THE_AUDIENCE";
                $issuedat_claim = time();
                $notbefore_claim = $issuedat_claim + 10;
                $expire_claim = $issuedat_claim + 3600;

                $token = [
                    "iss" => $issuser_claim,
                    "aud" => $audience_claim,
                    "iat" => $issuedat_claim,
                    "nbf" => $notbefore_claim,
                    "exp" => $expire_claim,
                    "data" => [
                        'name' =>  $data->name,
                        'email' => $data->email,
                        'mobile' => $data->mobile
                    ]
                ];

                $token = JWT::encode($token,$secret_key);
                $userdata = [
                    'name' => $data->name,
                    'email' => $data->email,
                    'password' => $data->password,
                    'mobile' => $data->mobile,
                    'uniid' => md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time()))
                ];
                
                $res = $model->insert($userdata);
                // $data['id'] = $res;
                // echo json_encode(['status'=> 'success','message' => 'User Register Successfully.']);
                return $this->respondCreated(['status' => 'success', 'message' => 'User Register Successfully.']);

            }
        } else {
            return $this->fail('Only post request is allowed');
        }
    }

    public function register()
    {
        $this->setHeaders();
        $data = [];
        helper(['form', 'url']);
        $this->validation = \Config\Services::validation();
        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getJSON();
            $user_data = [
                'name' => $data->username,
                'email' => $data->email,
                'password' => $data->password,
                'mobile' => $data->mobile
                // 'role_type' => $data->role_type,
                // 'status' => $data->status
            ];
            $rules = [
                $user_data['name'] => 'required|min_length[3]|max_length[20]',
                $user_data['email'] => 'required|valid_email|is_unique[students_tbl.email]',
                $user_data['password'] => 'required|min_length[8]|max_length[255]',
                $user_data['mobile'] => 'required|is_unique[students_tbl.mobile]'
            ];
            $error = $this->validation->setRules($rules);
            $msg = $this->validation->run($user_data, 'register');
            if (!$msg)
            {
                  $output = [
                                'status' => 401,
                                'validation_error' => $this->validation->getErrors(),
                            ];
                            return $this->respond($output, 401);
                // return $this->respondCreated(['status' => false, 'error' => $this->validation->getErrors()]);
            } else {
                    $model = new AuthModel();
                    $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time()));
                    $userdata = [
                        'name' => $data->username,
                        'email' => $data->email,
                        'password' => password_hash($data->password, PASSWORD_DEFAULT),
                        'mobile' => $data->mobile,
                        'role_type' => $data->role_type,
                        'status' => $data->status
                    ];
                    // return json_encode($userdata);
                    if ($this->Auth->register($userdata)) {
       //                  $email = \Config\Services::email();
							// $logo_path = base_url().'/assets/images/logo.jpg';
							// $email->attach($logo_path);
							// $to = $data->email;
							// $subject = 'Account Activation Link';
       //                      $message = 'Hi '.$data->name.",<br><br>Thanks Your account created"
       //                      ."successfully. Please click the below link to activate your account<br><br>"
       //                      ."<a href='http://localhost:4200/login?uniid=".$uniid."'>Activate now</a><br><br>Thanks<br>Team";
							
							// $email->setFrom('Info@email.com', 'Info');
							// $email->setTo($to);
							// // $email->setCC('another@example.com');
							// // $email->setBCC('and@another.com');
							
							// $email->setSubject($subject);
							// $email->setMessage($message);
                            $output = [
                                'status' => 'success',
                                'message' => 'Account Created Successfully.',
                            ];
							// if($email->send()){
       //                          $output['mail_sent'] = true;
       //                      }else{
       //                          $output['mail_sent'] = false;
       //                      }

                          
                            return $this->respond($output, 200);
                           
                    } else {
                       $output = [
                            'status' => '401',
                            'message' => 'Sorry,Register not Successfully',
                        ];
                        return $this->respond($output, 401);
                    }
                }
        } else {
            return $this->fail('Only post request is allowed');
        }
    }

    public function managersignup()
    {
        $this->setHeaders();
        $data = [];
        helper(['form', 'url']);
        $this->validation = \Config\Services::validation();
        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getJSON();
            $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time()));
            $user_data = [
                'name' => $data->name,
                'email' => $data->email,
                'password' => $data->password,
                'mobile' => $data->mobile,
                'role_type' => $data->role_type,
                'status' => $data->status,
                'uniid' => $uniid,
                'activation_date' => date("Y-m-d h:i:s")
            ];
            $rules = [
                $user_data['name'] => 'required|min_length[3]|max_length[20]',
                $user_data['email'] => 'required|valid_email|is_unique[users.email]',
                $user_data['password'] => 'required|min_length[8]|max_length[255]',
                $user_data['mobile'] => 'required|is_unique[users.mobile]'
            ];
            $error = $this->validation->setRules($rules);
            $msg = $this->validation->run($user_data, 'manager_signup');
            if (!$msg)
            {
                  $output = [
                                'status' => 401,
                                'validation_error' => $this->validation->getErrors(),
                            ];
                            return $this->respond($output, 401);
                // return $this->respondCreated(['status' => false, 'error' => $this->validation->getErrors()]);
            } else {
                    $model = new AuthModel();
                    $managerdata = [
                        'name' => $data->name,
                        'email' => $data->email,
                        'password' => password_hash($data->password, PASSWORD_DEFAULT),
                        'mobile' => $data->mobile,
                        'role_type' => $data->role_type,
                        'status' => $data->status,
                        'uniid' => $uniid,
                        'activation_date' => date("Y-m-d h:i:s")
                    ];
                    if ($this->Auth->register($managerdata)) {
                        $email = \Config\Services::email();
							$logo_path = base_url().'/assets/images/logo.jpg';
							$email->attach($logo_path);
							$to = $data->email;
							$subject = 'Account Activation Link';
                            $message = 'Hi '.$data->name.",<br><br>Thanks Your account created"
                            ."successfully. Please click the below link to activate your account<br><br>"
                            ."<a href='http://localhost:4200/admin?uniid=".$uniid."'>Activate now</a><br><br>Thanks<br>Team";
							
							$email->setFrom('Info@email.com', 'Info');
							$email->setTo($to);
							// $email->setCC('another@example.com');
							// $email->setBCC('and@another.com');
							
							$email->setSubject($subject);
							$email->setMessage($message);
                           $output = [
                                'status' => 'success',
                                'message' => 'Account Created Successfully. Please Activate Your Account',
                            ];
                            if($email->send()){
                                $output['mail_sent'] = true;
                            }else{
                                $output['mail_sent'] = false;
                            }
                            return $this->respond($output, 200);
                    } else {
                       $output = [
                            'status' => '401',
                            'message' => 'Sorry,Register not Successfully',
                        ];
                        return $this->respond($output, 401);
                    }
                }
        } else {
            return $this->fail('Only post request is allowed');
        }
    }

    public function forgotpassword()
	{
        // return 'hi';
		// $secret_key = $this->protect->privateKey();
		// $token  = null;
		// $authHeader = $this->request->getHeader('Authorization');
		// $arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
			
			// try {
				// $decode = JWT::decode($token,$secret_key,array('HS256'));
				// if($decode){
                    helper(['form', 'url']);
					// $this->validation = \Config\Services::validation();
					// $encrypter = \Config\Services::encrypter();
                    if ($this->request->getMethod() == 'post') {
                        
                        $data = $this->request->getJSON();
                        // return $data->email;
                        // $team_data = [
						// 	'team_name'=> $data->team_name,
						// 	'team_manager_name'=> $data->team_manager_name,
						// 	'team_manager_mobile'=> $data->team_manager_mobile,
						// 	'team_manager_email'=> $data->team_manager_email,
						// 	// 'team_manager_password'=> base64_encode($encrypter->encrypt($data->team_manager_password)),
                        //     'status' => $data->status
                        // ];
					
					
                        $res = $this->Auth->checkemail($data->email);
                        if($res == null){
                            $output = [
                                'message' => 'Email does not exist',
                                'status' => 'fail'
                            ];
                                return $this->respond($output,404);
                        }else if(!empty($res)){
                            if($this->Auth->updatedAt($res['uniid'])){
                                $email = \Config\Services::email();
                                $logo_path = base_url().'/assets/images/logo.jpg';
                                $email->attach($logo_path);
                                $to = $data->email;
                                $token = $res['uniid'];
                                $subject = 'Reset Password Link';
                                $message = 'Hi '.$res['name'].",<br><br>Your reset password request has been received.please click"
                                ."the below link to reset your password.<br><br>"
                                ."<a href='http://localhost:4200/reset-password?uniid=".$token."'>Click here to Reset Password</a><br><br>Thanks<br>Team";
                                
                                $email->setFrom('Info@email.com', 'Info');
                                $email->setTo($to);
                                // $email->setCC('another@example.com');
                                // $email->setBCC('and@another.com');
                                
                                $email->setSubject($subject);
                                $email->setMessage($message);
                                if($email->send()){
                                    $output = [
                                        'message' => 'Reset password link sent to your registred email.Please verify with in 15mins',
                                        'status' => 'success',
                                        'mail_sent' => true
                                    ];
                                        return $this->respond($output,200);
                                }else{
                                    $err =  $email->printDebugger(['headers']);
                                    $output = [
                                        'message' => $err,
                                        'mail_sent' => false
                                    ];
                                        return $this->respond($output,401);
							// print_r();
                                }
                                
                            }else{
                                $output = [
                                    'message' => 'Sorry! Unable to update.try again later',
                                    'status' => 'success'
                                ];
                                    return $this->respond($output,401);
                            }
                            
                        }
                        // return json_encode($res);
                       
					
                        
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
    
    public function activate($uniid=null){
        $data = [];
        if(!empty($uniid)){
            $userdata = $this->Auth->verifyUniid($uniid);
            if($userdata){
                if($this->verifyExpirytime(($userdata->activation_date))){
                    if($userdata->status == 0){
                        $status = $this->Auth->updatestatus($uniid);
                        if($status == true){
                            $output = [
                                'message' => 'Your Account Activated Successfully',
                                'status' => 'success'
                            ];
                            return $this->respond($output, 200);
                        }

                    }else{
                        $output = [
                            'message' => 'Your account is already activated',
                            'status' => 'success'
                        ];
                        return $this->respond($output, 200);
                    }

                }else{
                    $output = [
                        'message' => 'sorry! Activation link was expired!',
                        'status' => 'faile'
                    ];
                    return $this->respond($output, 401);
                }

            }else{
                $output = [
                    			'message' => 'sorry! we are unable to find your account',
                    			'status' => 'faile'
                    		];
                    		return $this->respond($output, 401);
            }
        }else{
            $output = [
                'message' => 'sorry!  unable to process your request',
                'status' => 'faile'
            ];
            return $this->respond($output, 401);
        }
    }

    public function resetpassword($uniid=null){
        $data = [];
        if(!empty($uniid)){
            $userdata = $this->Auth->verifyresetpaswdUniid($uniid);
            if(!empty($userdata)){
                if($this->checkExpirydate($userdata['updated_at'])){
                    // $data = $this->checkExpirydate($userdata['updated_at']);
                    // return $data;
                    $data = $this->request->getJSON();
                    $pwd = password_hash($data->password,PASSWORD_DEFAULT);
                    if($this->Auth->updatepassword($uniid,$pwd)){
                        $output = [
                            'message' => 'Password Updated successfully. Login now',
                            'status' => 'success'
                        ];
                        return $this->respond($output, 200);
                    }else{
                        $output = [
                            'message' => 'Sorry! unable to update password. try again',
                            'status' => 'faile'
                        ];
                        return $this->respond($output, 401);

                    }
                }else{
                    $output = [
                        'message' => 'Reset password link was expired.',
                        'status' => 'faile'
                    ];
                    return $this->respond($output, 401);
                }
            }else{
                $output = [
                    'message' => 'sorry! unable to find user account',
                    'status' => 'faile'
                ];
                return $this->respond($output, 401);
            }

        }else{
            $output = [
                'message' => 'sorry! unauthourized access',
                'status' => 'faile'
            ];
            return $this->respond($output, 401);
        }
    }

    public function checkExpirydate($time){
        $update_time = strtotime($time);
        $current_time = time();
        $timediff = $current_time - $update_time;
        // return $timediff;
        if($timediff < 900){
            return true;
        }else{
            return false;
        }
    }

    public function verifyExpirytime($regtime){
        $currtime = now();
        $regtime = strtotime($regtime);
        $difftime = $currtime - $regtime;
        if(3600 > $difftime){
            return true;
        }else{
            return false;
        }
    }

    //--------------------------------------------------------------------
}


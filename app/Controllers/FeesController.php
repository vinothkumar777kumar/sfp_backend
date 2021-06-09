<?php namespace App\Controllers;
use \Firebase\JWT\JWT;
use App\Controllers\AuthController;
use CodeIgniter\RESTful\ResourceController;


header('Access-Control-Allow-Origin: *');        
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization, Token, App-version,Access-Control-Allow-Headers");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Max-Age: 3600'); 

class FeesController extends ResourceController
{
	protected $modelName = 'App\Models\FeesModel';
	
	public function __construct(){
$this->protect = new AuthController();
	}
	// public function index(){
	// 	echo view('welcome_message');
	// 		}
	
	

	
	public function updatefees($id)
	{
		
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
                        	
						$fees_data = json_decode($data->fees_type,true);
						$getfeesdata = $this->model->getfeesdata($id);
						// return json_encode($getfeesdata);
						if(!empty($getfeesdata) && is_array($getfeesdata)){
							if($this->model->deletefees($id)){
								$res = $this->model->addfees($fees_data);
				                $output = [
				                    'status' => 'success',
				                    'message' => 'Fees Update Successfully.'
				                ];
				                return $this->respond($output, 200);
							}
						}else if(empty($getfeesdata)){
							$res = $this->model->addfees($fees_data);
				                $output = [
				                    'status' => 'success',
				                    'message' => 'Fees Added Successfully.'
				                ];
				                return $this->respond($output, 200);
						}else{
							      $output = [
					                    'status' => 'faile',
					                    'error' =>  $this->db->error()
					                ];
					                return $this->respond($output, 401); 
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

    public function getfeestype($id){
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
		// 	try {
		// 		$decode = JWT::decode($token,$secret_key,array('HS256'));
		// 		if($decode){
                    $feesdata = $this->model->getfeesdata($id);

                    // if($feesdata){
                        $output = [
                            'status' => 'success',
                            'data' => $feesdata
                        ];
    return $this->respond($output, 200);
                    // }else{
                    //     $output = [
                    //         'error' => $this->db->error(),
                    //         'status' => 'fail'
                    //     ];
                    //         return $this->respond($output,401);
                    // }
					
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

	

	public function updateproduct($uniid){
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
	$upload_dir = 'uploads/shop/';
	$this->validation = \Config\Services::validation();
	if ($this->request->getMethod() == 'post') {
		$data = $this->request->getPost();
						// return empty($_FILES['bionewsfeed_image']['name']);
						// return $_FILES['bionewsfeed_image']['name'];
						// $img_name = isset($_FILES['bionewsfeed_image']['name']);
						
						if(empty($_FILES['product_image']['name'])){
							$random_name = $data['product_image'];
						}else{
					 $img_name = $_FILES['product_image']['name'];
						$img_tmp_name = $_FILES["product_image"]["tmp_name"];
						$error = $_FILES["product_image"]["error"];
						if($error > 0){
							$response = array(
								"status" => "error",
								"error" => true,
								"message" => "Error uploading the file!"
							);
						}else 
						{
							$random_name = rand(1000,1000000)."-".strtolower($img_name);
							$upload_name = $upload_dir.''.$random_name;
							$upload_name = preg_replace('/\s+/', '-', $upload_name);

							if(move_uploaded_file($img_tmp_name , $upload_name)) {
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
					}
					$prod_data = json_decode($data['product_details'],true);
					$product_array = array();
					
					foreach($prod_data as $h){	
					$product_array[] = [
						'product_image'=> $random_name,
						'unic_id' => $uniid,
						'product_title'=> $data['product_title'],
						'product_desc' => $data['product_desc'],
						'size' => $h['size'],
						'price' => $h['price']
					];
				
				}

				// if($this->model->deleteprod($id)){
				// 	$res = $this->model->addproduct($product_array);
				// }
				
		
			// $res =  $this->model->where(['unic_id' => $uniid])->set($product_array)->updateBatch();
			// $res= $this->model->updateBatch($product_array,'unic_id');
			if($this->model->deleteprod($uniid)){
				$res = $this->model->addproduct($product_array);
                $output = [
                    'status' => 'success',
                    'message' => 'Product Update Successfully.'
                ];
                return $this->respond($output, 200);
            }else{
                $output = [
                    'status' => 'faile',
                    'error' =>  $this->db->error()
                ];
                return $this->respond($output, 401); 
            }
			
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
    



    
   

	



	public function editproduct($id){
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
		// 	try {
		// 		$decode = JWT::decode($token,$secret_key,array('HS256'));
		// 		if($decode){
                    $getuses = $this->model->editproduct($id);

                    if($getuses){
                        $output = [
                            'status' => 'success',
                            'data' => $getuses
                        ];
    return $this->respond($output, 200);
                    }else{
                        $output = [
                            'error' => $this->db->error(),
                            'status' => 'fail'
                        ];
                            return $this->respond($output,401);
                    }
					
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

	   public function getstudentfeesdata($student_id,$sponsor_id)
	{
		// return json_encode($sponsor_id);
		$secret_key = $this->protect->privateKey();
		$token  = null;
		$authHeader = $this->request->getHeader('Authorization');
		$arr = explode(" ", $authHeader);
		// $token = $arr[1];
		// if($token){
		// 	try {
		// 		$decode = JWT::decode($token,$secret_key,array('HS256'));
		// 		if($decode){
					$feesdata = $this->model->getfeesdata($student_id);
					$sponsordata = $this->model->getsponsordata($sponsor_id);
					$bankdata = $this->model->getbankbalance();
					
					$output = [
						'status' => 'success',
						'data' => $feesdata,
						'sponsordata' => $sponsordata,
						'bankdata' => $bankdata
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

		


	


	//--------------------------------------------------------------------

}

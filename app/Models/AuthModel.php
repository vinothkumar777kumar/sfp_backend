<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class AuthModel extends Model
{
	protected $table = 'students_tbl';
protected $primaryKey = 'id';
	protected $allowedFields = ['name','email','password','mobile','status','role_type','uniid','activation_date'];
	protected $beforeInsert = ['beforeInsert'];
	protected $beforeUpdate = ['beforeUpdate'];
	
	protected function beforeInsert(array $data){
$data = $this->passwordHash($data);
return $data;
	}

	protected function beforeUpdate(array $data){
$data = $this->passwordHash($data);
return $data;
	}


	protected function passwordHash(array $data){
		if(isset($data['data']['password'])){
			$data['data']['password'] = password_hash($data['data']['password'],PASSWORD_DEFAULT);
		}
		return $data;
	}

	public function register($data){
		$data = $this->passwordHash($data);
		$query = $this->db->table('students_tbl')->insert($data);
		return $query ? true : false;
	}

	public function manager_signup($data){
		$data = $this->passwordHash($data);
		$query = $this->db->table('team_manager_tbl')->insert($data);
		return $query ? true : false;
	}

	public function check_login($email){
		$query = $this->table('students_tbl')->where('email', $email)->limit(1)->get()->getRowArray();
						// return $query;
		if(is_null($query)){
			// return 'false';
			$data = [];
			// $data = $this->table($this->table)->where('email', $email)->limit(1)->get()->getRowArray();
		}else if($query['status'] == 0){
			$data = "Please activate your account";
			
		}else{
			$data = $query;
		}
		return $data;
	}

	public function checkemail($email){
		$query = $this->table($this->table)
						->where('email', $email)
						->countAll();
		if($query > 0){
			$data = $this->table($this->table)->where('email', $email)->limit(1)->get()->getRowArray();
		}else{
			$data = [];
		}
		return $data;
	}

	public function updatedAt($uniid){
		$builder = $this->db->table('users');
		$builder->where('uniid',$uniid);
		$builder->update(['updated_at' => date('Y-m-d h:i:s')]);
		if($this->db->affectedRows() == 1){
			return true;
		}else{
			return false;
		}

	}

	public function verifyUniid($uniid){	
		// return $uniid;
		$builder = $this->db->table('users');
		$builder->select('activation_date,uniid,status');
		$builder->where('uniid',$uniid);
		$result = $builder->get();
		return $result->getRow();
		if($builder->countAll()==1){
			return $result->getRow();
		}else{
			return false;
		}
	}

	public function verifyresetpaswdUniid($uniid){
		$builder = $this->db->table('users');
		$builder->select('updated_at,uniid,name');
		$builder->where('uniid',$uniid);
		$result = $builder->get();
		// return $result->getRow();
		if(count($result->getResultArray())==1){
			return $result->getRowArray();
		}else{
			return false;
		}
	}

	public function updatestatus($uniid){
		$db  = \Config\Database::connect();
		$builder = $this->db->table('users');
		$builder->where('uniid',$uniid);
		$builder->update(['status' => 1]);
		if($this->db->affectedRows() == 1){
			return true;
		}else{
			return false;
		}
	}

	public function updatepassword($uniid,$pwd){
		$db  = \Config\Database::connect();
		$builder = $this->db->table('users');
		$builder->where('uniid',$uniid);
		$builder->update(['password' => $pwd]);
		if($this->db->affectedRows() == 1){
			return true;
		}else{
			return false;
		}
	}

	
}
?>

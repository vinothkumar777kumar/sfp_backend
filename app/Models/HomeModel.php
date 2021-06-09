<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class HomeModel extends Model
{
	protected $table = 'students_tbl';
protected $primaryKey = 'id';
	protected $allowedFields = ['name','email','password','mobile','address_one','town','postcode'];
	

	public function updatepassword($data){
		$db  = \Config\Database::connect();

	$builder = $db->table($this->table);
	$builder->select('*');
	$builder->where('id', $data['user_id']);
	$d = $builder->get()->getResult();
// return $d;
	if(password_verify($data['current_password'],$d[0]->password)){		
		$builder = $db->table($this->table);
		$res =  $builder->where(['id' => $data['user_id']])->set('password', password_hash($data['new_password'],PASSWORD_DEFAULT))->update();
		return true;
	}else{
		return false;
	}

	}

	public function updatestudentpassword($data){
		$db  = \Config\Database::connect();	
		$builder = $db->table($this->table);
		$res =  $builder->where(['id' => $data['user_id']])->set('password', password_hash($data['new_password'],PASSWORD_DEFAULT))->update();
		if($res){
			return true;
		}else{
			return false;
		}
		
	

	}

	public function getusers(){
		$db  = \Config\Database::connect();
		$builder = $db->table($this->table);
		$builder->select('*');
		$builder->where('role_type', 3);
		$d = $builder->get()->getResult();
		return $d;
	}

	public function getstudentdata($user_id){
	 $db = \Config\Database::connect();
	$data = $this->db->query("select st.id,st.id as sponsor_id,st.profile_image,st.name,st.last_name,st.gender,
		st.dateofbirth,st.email,st.mobile,st.address_one,st.address_two,st.city,st.state,st.zip_code,
		st.referred_by,st.referred_contact,st.revel_sponsor_details,pt.why_need_sponsorship,pt.id,pt.parent_lastname,pt.parent_age,pt.work_status,pt.name_of_organizations,pt.contact_of_organizations,pt.organizations_address_one,pt.organizations_address_two,pt.organizations_city,pt.organizations_state,pt.organizations_pincode,pt.fatherorguardian_name,pt.parent_occupation,pt.parent_address_one,pt.parent_address_two,pt.parent_city,pt.parent_state,pt.parent_zip_code,pt.fatherorgardian_mobile,ct.id,ct.collegeofstudy,ct.contact_person,ct.contact_person_mobile,ct.college_phone,ct.college_email,ct.college_address_one,ct.college_address_two,ct.college_city,ct.college_state,ct.college_zip_code,ct.course_name,ct.study_duration,ct.academic_year,ct.current_semester,ct.join_date,ct.bank_name,ct.branch_name,ct.ifsc_code,ct.bank_account_no,ct.dd_favouring,ct.transfer_option,ct.payment_type,ct.due_date,ft.* FROM students_tbl as st
	         	left join parent_tbl as pt on (st.id = pt.student_id)
	         	left join college_details_tbl as ct on (st.id = ct.student_id)
	         	left join fees_tbl as ft on (st.id = ft.student_id)
		where st.id ='".$user_id."'")->getResult();
		return $data;
}


public function getreveldata(){
		 $db = \Config\Database::connect();
	$data = $this->db->query("select st.id as student_id,sst.profile_image as sponsor_image,st.name as student_firstname,st.last_name as student_lastname,sst.name as sponsor_firstname,sst.last_name as sponsor_lastname,nt.revel_status,nt.created_on FROM notification_tbl as nt
	         	
	         	left join students_tbl as st on (nt.student_id = st.id)
	         	left join students_tbl as sst on (nt.sponsor_id = sst.id)
	         where nt.notification_status ='1'")->getResult();
		return $data;
	}

	
	public function getsponsorshippaiddata($user_id){
	 $db = \Config\Database::connect();
  //       $builder = $db->table('sponsorship_pay_tbl');
  //       $builder->select('students_tbl.');
  //       $builder->join('students_tbl', 'sponsorship_pay_tbl.student_id = students_tbl.id','left');
  //       $builder->where('studentsassigntosponsor_tbl.sponsor_id', $id);
  //       $q = $builder->get();
  //       return $q->getResult();
	 $data = $this->db->query("select spt.id,st.profile_image,spt.pay_date,spt.paid,st.name,st.last_name,std.name as sponsorfname,std.last_name as sponsorlname,spt.created_on FROM sponsorship_pay_tbl as spt
		left join students_tbl as st on (spt.student_id = st.id)
		left join students_tbl as std on(spt.sponsor_id = std.id)
		WHERE spt.student_id ='".$user_id."' AND spt.notification_status = '1'ORDER BY spt.created_on desc")->getResult();
		return $data;
}

public function paymentnotification(){
 $db = \Config\Database::connect();
	 $data = $this->db->query("select st.id as student_id,st.name,st.email,st.last_name,scdt.due_date,scdt.payment_type,scdt.next_notification_date,st.role_type FROM students_tbl as st
		left join college_details_tbl as scdt on (st.id = scdt.student_id)
		WHERE st.role_type ='3'")->getResult();
		return $data;	
}


public function updatenotificationdate($student_id,$data){
			$db  = \Config\Database::connect();
	$builder = $db->table('college_details_tbl');
	return $builder->update($data, ['student_id' => $student_id]);
	}

	
	public function getadminemail(){
		$db  = \Config\Database::connect();
		$builder = $db->table('students_tbl');
		$builder->select('*');
		$builder->where('role_type', '1');
		$d = $builder->get()->getResult();
		return $d;
	}

	
	public function getstudentsponsoremail($student_id){
 $db = \Config\Database::connect();
	 $data = $this->db->query("select st.id,st.name,st.email,st.last_name,st.role_type FROM studentsassigntosponsor_tbl as sast
		left join students_tbl as st on (sast.sponsor_id = st.id)
		WHERE sast.student_id ='".$student_id."'")->getResult();
		return $data;	
}

	
}
?>

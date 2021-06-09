<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class StudentsModel extends Model
{
	protected $table = 'students_tbl';
protected $primaryKey = 'id';
	protected $allowedFields = ['profile_image','name','last_name','fatherorguardian_name','gender','dateofbirth','mobile','fatherorgardian_mobile','address_one','address_two','city','state','contact_person','contact_person_mobile','email','collegeofstudy','college_phone','college_email','college_address_one','college_address_two','college_city','college_state','college_zip_code','academic_year','join_date','course_name','study_duration','zip_code','role_type','status','why_need_sponsorship','referred_by','referred_contact'];


public function getstudentsponsordata($student_id){
	         $db = \Config\Database::connect();
	          $data = $this->db->query("select sats.*,stsp.profile_image as profile_image,stsp.mobile as mobile,stsp.email as email,stsp.address_one as address_one,stsp.address_two as address_two,stsp.city as city,stsp.state as state,stsp.zip_code as zip_code,stsp.status as status,stsp.role_type as role_type,stsp.name as sponsorfname,stsp.last_name as sponsorlname,stsp.gender,stsp.dateofbirth FROM studentsassigntosponsor_tbl as sats
		left join students_tbl as stsp on (sats.sponsor_id = stsp.id)
		WHERE sats.student_id ='".$student_id."'")->getResult();
		return $data;
	}

	
	public function getpendingapprovalstudent(){
	         $db = \Config\Database::connect();
	         $data = $this->db->query("select st.id,st.name,st.mobile,st.role_type,st.email,st.collegeofstudy,st.course_name,sast.student_id as is_sponsored_student FROM students_tbl as st
	         	left join studentsassigntosponsor_tbl as sast on (st.id = sast.student_id)
		where st.role_type = 3 and st.approval = 0 and st.pending = 0 and st.reject = 0")->getResult();
	
// 	        $data = $this->db->query("SELECT  st.id,st.name,st.mobile,st.role_type,st.email,st.collegeofstudy,st.course_name
// FROM    students_tbl st
// LEFT JOIN
// studentsassigntosponsor_tbl sst
// ON      sst.student_id = st.id
// WHERE   sst.student_id IS NULL and st.role_type ='3'")->getResult();
        // $builder = $db->table('studentsassigntosponsor_tbl');
        // $builder->select('students_tbl.*');
        // $builder->join('students_tbl', 'studentsassigntosponsor_tbl.student_id <> students_tbl.id','left');
        // $q = $builder->get();
        // return $q->getResult();
	         return $data;
    
	}

	public function updatestatus($id,$data){
			$db  = \Config\Database::connect();
	$builder = $db->table('students_tbl');
	return $builder->update($data, ['id' => $id]);
	}

	public function getstudentdata($student_id){
		
		 $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->where('id', $student_id);
          $q = $builder->get();
        return $q->getResult(); 
	}

	public function assignsponsordata($id){
	         $db = \Config\Database::connect();

	          $data = $this->db->query("select stsp.id,stsp.name,stsp.last_name FROM studentsassigntosponsor_tbl as sats
		left join students_tbl as stsp on (sats.sponsor_id = stsp.id)
		WHERE sats.student_id ='".$id."'")->getResult();
		return $data;
    
	}
	
	public function addpersonaldetails($data){
	$db = \Config\Database::connect();
    $builder = $db->table('students_tbl');
    $builder->insert($data);
    return $db->insertID();
}


public function addparentdetails($data){
	$db = \Config\Database::connect();
    $builder = $db->table('parent_tbl');
    $builder->insert($data);
    return $db->insertID();
}

public function addcollegedetails($data){
	$db = \Config\Database::connect();
    $builder = $db->table('college_details_tbl');
    $builder->insert($data);
    return $db->insertID();
}

 public function addfees($data)
    {
        // return $data[0]['booking_date'];
        $db = \Config\Database::connect();
                $query = $this->db->table('fees_tbl')->insertBatch($data);
                if ($query) {
                    try {
                        return true;
                    } catch (\Exception $e) {
                        $output = [
                            'status' => 'faile',
                            'error' => $e->getMessage(),
                        ];
                        return $this->respond($output, 401);
                    }
                }
                // return $data['start_time'] .' '.$builder[0]['end_time'];
            
        

    }

    public function editstudentdata($user_id){
	 $db = \Config\Database::connect();
	$data = $this->db->query("select st.id,st.profile_image,st.name,st.last_name,st.gender,
		st.dateofbirth,st.email,st.mobile,st.address_one,st.address_two,st.city,st.state,st.zip_code,
		st.referred_by,st.referred_contact,pt.why_need_sponsorship,st.status,st.role_type,pt.id as parent_id,pt.parent_lastname,pt.parent_age,pt.work_status,pt.fatherorguardian_name,pt.parent_occupation,pt.parent_address_one,pt.parent_address_two,pt.parent_city,pt.parent_state,pt.parent_zip_code,pt.fatherorgardian_mobile,pt.name_of_organizations,pt.contact_of_organizations,pt.organizations_address_one,pt.organizations_address_two,pt.organizations_city,pt.organizations_state,pt.organizations_pincode,ct.id as college_id,ct.collegeofstudy,ct.contact_person,ct.contact_person_mobile,ct.college_phone,ct.college_email,ct.college_address_one,ct.college_address_two,ct.college_city,ct.college_state,ct.college_zip_code,ct.course_name,ct.study_duration,ct.academic_year,ct.current_semester,ct.join_date,ct.bank_name,ct.branch_name,ct.ifsc_code,ct.bank_account_no,ct.dd_favouring,ct.transfer_option,ct.payment_type,ct.due_date,ft.id as fees_id,ft.student_id as fees_tbl_student_id,ft.fees_type,
		ft.fees_per_semester FROM students_tbl as st
	         	left join parent_tbl as pt on (st.id = pt.student_id)
	         	left join college_details_tbl as ct on (st.id = ct.student_id)
	         	left join fees_tbl as ft on (st.id = ft.student_id)
		where st.id ='".$user_id."'")->getResult();
		return $data;
}


public function getparentdata($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('parent_tbl');
        // $builder->select('sports_hall_booking_tbl.*');
        // $builder->join('users', 'sports_hall_booking_tbl.user_id = users.id','left');
        $builder->where('student_id', $id);
        $q = $builder->get();
        return $q->getResult();
    }

    public function getcollegedata($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('college_details_tbl');
        // $builder->select('sports_hall_booking_tbl.*');
        // $builder->join('users', 'sports_hall_booking_tbl.user_id = users.id','left');
        $builder->where('student_id', $id);
        $q = $builder->get();
        return $q->getResult();
    }


public function update_parent_details($student_id,$data){
			$db  = \Config\Database::connect();
	$builder = $db->table('parent_tbl');
	return $builder->update($data, ['student_id' => $student_id]);
	}

	public function update_college_details($student_id,$data){
			$db  = \Config\Database::connect();
	$builder = $db->table('college_details_tbl');
	return $builder->update($data, ['student_id' => $student_id]);
	}

	public function getfeesdata($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('fees_tbl');
        // $builder->select('sports_hall_booking_tbl.*');
        // $builder->join('users', 'sports_hall_booking_tbl.user_id = users.id','left');
        $builder->where('student_id', $id);
        $q = $builder->get();
        return $q->getResult();
    }



     public function deletefees($id){
        $db = \Config\Database::connect();
        // return count($id);
        $del = 0;
      
            $builder = $db->table('fees_tbl');
        $builder->where('student_id', $id);
         $builder->delete();
        return true;
   
    }

	


	
}
<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class NotificationModel extends Model
{
	
public function getallsponsorshippaiddata(){
	 $db = \Config\Database::connect();
  //       $builder = $db->table('sponsorship_pay_tbl');
  //       $builder->select('students_tbl.');
  //       $builder->join('students_tbl', 'sponsorship_pay_tbl.student_id = students_tbl.id','left');
  //       $builder->where('studentsassigntosponsor_tbl.sponsor_id', $id);
  //       $q = $builder->get();
  //       return $q->getResult();
	 $data = $this->db->query("select spt.pay_date,spt.paid,st.name,st.last_name,std.name as sponsorfname,std.last_name as sponsorlname FROM sponsorship_pay_tbl as spt
		left join students_tbl as st on (spt.student_id = st.id)
		left join students_tbl as std on(spt.sponsor_id = std.id)
		ORDER BY spt.created_on desc")->getResult();
		return $data;
}


public function getnotification($user_id){
	 $db = \Config\Database::connect();
        // $builder = $db->table('sponsorship_pay_tbl');
  //       $builder->select('students_tbl.');
  //       $builder->join('students_tbl', 'sponsorship_pay_tbl.student_id = students_tbl.id','left');
  //       $builder->where('studentsassigntosponsor_tbl.sponsor_id', $id);
  //       $q = $builder->get();
  //       return $q->getResult();
	$ud = [
    'notification_status' => 0
];
$builder = $db->table('sponsorship_pay_tbl');
	$builder->update($ud, ['student_id' => $user_id]);
	 $data = $this->db->query("select spt.id,st.profile_image,spt.pay_date,spt.paid,st.name,st.last_name,std.name as sponsorfname,std.last_name as sponsorlname,spt.created_on FROM sponsorship_pay_tbl as spt
		left join students_tbl as st on (spt.student_id = st.id)
		left join students_tbl as std on(spt.sponsor_id = std.id)
		WHERE spt.student_id ='".$user_id."'ORDER BY spt.created_on desc")->getResult();
		return $data;
}

public function getstudentdata($student_id){
		
		 $db = \Config\Database::connect();
        $builder = $db->table('notification_tbl');
        $builder->where('student_id', $student_id);
          $q = $builder->get();
        return $q->getResult(); 
	}


	public function addrevel($data){
	$db = \Config\Database::connect();
    $builder = $db->table('notification_tbl');
    $builder->insert($data);
    return true;
}

public function getreveldata(){
		 $db = \Config\Database::connect();
		 	$ud = [
    'notification_status' => 0
];
$builder = $db->table('notification_tbl');
	$builder->update($ud, ['notification_status' => 1]);
	$data = $this->db->query("select st.id as student_id,sst.profile_image as sponsor_image,st.name as student_firstname,st.last_name as student_lastname,sst.name as sponsor_firstname,sst.last_name as sponsor_lastname,nt.revel_status,nt.created_on FROM notification_tbl as nt
	         	
	         	left join students_tbl as st on (nt.student_id = st.id)
	         	left join students_tbl as sst on (nt.sponsor_id = sst.id)")->getResult();
		return $data;
	}

	
	public function updatestatus($id,$data){
			$db  = \Config\Database::connect();
	$builder = $db->table('students_tbl');
	return $builder->update($data, ['id' => $id]);
	}
	
	
}
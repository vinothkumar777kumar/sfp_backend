<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class SponsorsModel extends Model
{
	protected $table = 'sponsors_tbl';
protected $primaryKey = 'id';
	protected $allowedFields = ['name','mobile','email','address'];

	
	public function getstudentcount(){
		$db  = \Config\Database::connect();
		$d = $this->db->query("select count(id) as count FROM students_tbl
		where role_type = 3")->getResult();
		return $d;
		
	}

    public function getpendingapprovalcount(){
        $db  = \Config\Database::connect();
        // $d = $this->db->query("select count(id) as count FROM students_tbl
        // where pending = 1")->getResult();
//         $d = $this->db->query("SELECT  st.id,st.name,st.mobile,st.role_type,st.email,st.collegeofstudy
// FROM    students_tbl st
// LEFT JOIN
// studentsassigntosponsor_tbl sst
// ON      sst.student_id = st.id
// WHERE   sst.student_id IS NULL and st.role_type ='3' and st.approval = '0' and st.pending = '0' and st.reject = '0'")->getResult();
        $d = $this->db->query("SELECT  st.id,st.name,st.mobile,st.role_type,st.email,st.collegeofstudy
FROM    students_tbl st
WHERE  st.role_type ='3' and st.approval = '0' and st.pending = '0' and st.reject = '0'")->getResult();
        return $d;
        
    }

	public function addsponsor($data){
		$db = \Config\Database::connect();
    $builder = $db->table('students_tbl');
    $builder->insert($data);
    return $db->insertID();
		 // $query = $this->db->table('students_tbl')->insert($data);
   //      if ($query) {
   //          try {
   //              return $this->$db->insertID();
   //          } catch (\Exception $e) {
   //              $output = [
   //                  'message' => 'sponsor not addedd',
   //                  'error' => $e->getMessage(),
   //              ];
   //              return $this->respond($output, 401);
   //          }
   //      }
        // return $query ? true : false;
	}

	public function assignstudenttosponsor($data)
    {
        // return $data[0]['booking_date'];
        $db = \Config\Database::connect();         
            
                $query = $this->db->table('studentsassigntosponsor_tbl')->insertBatch($data);
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
           

    }

	
	
	public function getsponsorscount(){
		// $db  = \Config\Database::connect();
		// $b = $db->table('sponsors_tbl')->countAll();
		
		// return $b;
		$db  = \Config\Database::connect();
		$d = $this->db->query("select count(id) as count FROM students_tbl
		where role_type = 2")->getResult();
		return $d;
	}

	public function getallaponsor(){
		$db  = \Config\Database::connect();
        $builder = $db->table('students_tbl');
        // $builder->where('MONTH(created_on)', date('m'));
        $builder->where('role_type', '2');
        $builder->orderBy('created_at', 'desc');
        $q = $builder->get();
        return $q->getResult(); 
	}

	public function getallstudent(){
		$db  = \Config\Database::connect();
        $builder = $db->table('students_tbl');
        // $builder->where('MONTH(created_on)', date('m'));
        $builder->where('role_type', '3');
        $builder->orderBy('created_at', 'desc');
        $q = $builder->get();
        return $q->getResult(); 
	}

	

	public function editsponsor($id){
	// $db  = \Config\Database::connect();
	// $builder = $db->table('students_tbl');
	// $builder->select('*');
	// $builder->where('id', $id);
	// $q = $builder->get()->getResult();
	// return $q;
	         $db = \Config\Database::connect();
        // $builder = $db->table('students_tbl');
        // $builder->select('students_tbl.*,studentsassigntosponsor_tbl.student_id');
        // $builder->join('studentsassigntosponsor_tbl', 'students_tbl.id = studentsassigntosponsor_tbl.sponsor_id','left');
        // $builder->where('students_tbl.id', $id);
        // $q = $builder->get();
        // return $q->getResult();
	          $data = $this->db->query("select sats.*,stsp.profile_image as profile_image,stsp.mobile as mobile,stsp.email as email,stsp.address_one as address_one,stsp.address_two as address_two,stsp.city as city,stsp.state as state,stsp.zip_code as zip_code,stsp.status as status,stsp.role_type as role_type,stst.name as studentfname,stst.last_name as studentlastname,stsp.name as sponsorfname,stsp.last_name as sponsorlname FROM studentsassigntosponsor_tbl as sats
		left join students_tbl as stst on (sats.student_id = stst.id)
		left join students_tbl as stsp on (sats.sponsor_id = stsp.id)
		WHERE sats.sponsor_id ='".$id."'")->getResult();
		return $data;

  //       $data = $this->db->query("select st.*,st.name as studentfname,st.last_name as studentlastname,st.name as sponsorfname,st.last_name as sponsorlname FROM students_tbl as st
		// left join studentsassigntosponsor_tbl as sats on (st.id = sats.sponsor_id)
		// left join studentsassigntosponsor_tbl as sat on (st.id = sat.student_id)
		// WHERE st.id ='".$id."'")->getResult();
		// return $data;
    
	}

	public function updatesponsor($id,$data){
			$db  = \Config\Database::connect();
	$builder = $db->table('students_tbl');
	return $builder->update($data, ['id' => $id]);
	}

	
	public function deletesponsorstudent($sponsor_id){
        $db = \Config\Database::connect();
        $builder = $db->table('studentsassigntosponsor_tbl');
        $builder->where('sponsor_id', $sponsor_id);
        $builder->delete();
        return true;
     }

     
     public function deletestudent($student_id){
        $db = \Config\Database::connect();
        $builder = $db->table('studentsassigntosponsor_tbl');
        $builder->where('student_id', $student_id);
        $builder->delete();
        return true;
     }

     public function deletesponsorsinglestudent($student_id){
        $db = \Config\Database::connect();
        $builder = $db->table('studentsassigntosponsor_tbl');
        $builder->where('student_id', $student_id);
        $builder->delete();
        return true;
     }

     
public function getsponsorstudent($id){
	         $db = \Config\Database::connect();
        $builder = $db->table('studentsassigntosponsor_tbl');
        $builder->select('students_tbl.*');
        $builder->join('students_tbl', 'studentsassigntosponsor_tbl.student_id = students_tbl.id','left');
        $builder->where('studentsassigntosponsor_tbl.sponsor_id', $id);
        $q = $builder->get();
        return $q->getResult();
    
	}

	
		public function paysponsorship($data){
		$db = \Config\Database::connect();
    $builder = $db->table('sponsorship_pay_tbl');
    $builder->insert($data);
    return true;

	}

	
	public function getstudentsponsorshippaiddata($id){
		$db  = \Config\Database::connect();
        $builder = $db->table('sponsorship_pay_tbl');
        // $builder->where('MONTH(created_on)', date('m'));
        $builder->where('student_id', $id);
        $builder->orderBy('created_on', 'desc');
        $q = $builder->get();
        return $q->getResult(); 
	}


     public function deletesponsor($sponsor_id){
        $db = \Config\Database::connect();
        $builder = $db->table('students_tbl');
        $builder->where('id', $sponsor_id);
        $builder->delete();
        return true;
     }

     // sponsor wallet
     
     
     public function getsponsorswallettransactiondetails($sponsor_id){
        $db  = \Config\Database::connect();
        $builder = $db->table('sponsor_wallet_tbl');
        $builder->select('sponsor_wallet_tbl.*,students_tbl.opening_bal');
        // $builder->where('MONTH(created_on)', date('m'));
        $builder->join('students_tbl', 'sponsor_wallet_tbl.sponsor_id = students_tbl.id','left');
        $builder->where('sponsor_id', $sponsor_id);
        $builder->orderBy('created_on', 'desc');
        $q = $builder->get();
        return $q->getResult(); 
    }
     public function getsponsoropeningbaldetails($sponsor_id){
        $db  = \Config\Database::connect();
        $builder = $db->table('students_tbl');
        // $builder->where('MONTH(created_on)', date('m'));
        $builder->where('id', $sponsor_id);
        $q = $builder->get();
        return $q->getResult(); 
    }

    
        public function addwallet($data){
        $db = \Config\Database::connect();
    $builder = $db->table('sponsor_wallet_tbl');
    $builder->insert($data);
    return true;
}


public function updateopeningbal($id,$data){
            $db  = \Config\Database::connect();
    $builder = $db->table('students_tbl');
    return $builder->update($data, ['id' => $id]);
    }

    
    public function editsponsorwallet($id){
        $db  = \Config\Database::connect();
        $builder = $db->table('sponsor_wallet_tbl');
        // $builder->where('MONTH(created_on)', date('m'));
        $builder->where('id', $id);
        $q = $builder->get();
        return $q->getResult(); 
    }

    
      public function getbankbalance(){
        $db  = \Config\Database::connect();
        $builder = $db->table('bank_deatils_tbl');
        $builder->select('*');
        $q = $builder->get();
        return $q->getResult(); 
    }

    public function getsponsortransaction($sponsor_id){
        $db  = \Config\Database::connect();
        $builder = $db->table('sponsor_wallet_tbl');
        // $builder->where('MONTH(created_on)', date('m'));
        $builder->where('sponsor_id', $sponsor_id);
        $builder->orderBy('created_on', 'desc');
        $q = $builder->get();
        return $q->getResult(); 
    }

    public function getsponsoralltransaction(){
           $db  = \Config\Database::connect();
        $builder = $db->table('sponsor_wallet_tbl');
        $builder->select('sponsor_wallet_tbl.*,students_tbl.name,students_tbl.last_name');
        // $builder->where('MONTH(created_on)', date('m'));
        $builder->join('students_tbl', 'sponsor_wallet_tbl.sponsor_id = students_tbl.id','left');
        $builder->orderBy('created_on', 'desc');
        $q = $builder->get();
        return $q->getResult(); 
    }

    
    public function updatesponsorwallet($id,$data){
            $db  = \Config\Database::connect();
    $builder = $db->table('sponsor_wallet_tbl');
    return $builder->update($data, ['id' => $id]);
    }
	
    
    public function deletesponsorwallet($id){
        $db = \Config\Database::connect();
        $builder = $db->table('sponsor_wallet_tbl');
        $builder->where('id', $id);
        $builder->delete();
        return true;
     }

     
     public function getallsponsoravailablebalance(){
        $db  = \Config\Database::connect();
        $builder = $db->table('students_tbl');
        // $builder->where('MONTH(created_on)', date('m'));
        $builder->where('role_type', '2');
        $builder->orderBy('created_on', 'desc');
        $q = $builder->get();
        return $q->getResult(); 
    }

    public function getsponsordata($sponsor_id){
        $db  = \Config\Database::connect();
        $builder = $db->table('students_tbl');
        // $builder->where('MONTH(created_on)', date('m'));
        $builder->where('id', $sponsor_id);
        $q = $builder->get();
        return $q->getResult(); 
    }

    
     public function updatesponsoramounttransactionstatus($id,$data){
            $db  = \Config\Database::connect();
    $builder = $db->table('sponsor_wallet_tbl');
    return $builder->update($data, ['id' => $id]);
    }

    
    public function  updatebankbal($id,$data){
            $db  = \Config\Database::connect();
    $builder = $db->table('bank_deatils_tbl');
    return $builder->update($data, ['id' => $id]);
    }

    public function getbanktransactiondetails(){
                $db  = \Config\Database::connect();
        $builder = $db->table('sponsor_wallet_tbl');
        $builder->select('sponsor_wallet_tbl.*,students_tbl.name,students_tbl.last_name');
        // $builder->where('MONTH(created_on)', date('m'));
        $builder->join('students_tbl', 'sponsor_wallet_tbl.sponsor_id = students_tbl.id','left');
        $q = $builder->get();
        return $q->getResult();    
    }



}
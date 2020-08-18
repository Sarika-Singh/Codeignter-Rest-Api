<?php
  class StaffModel extends CI_Model {
       
      public function __construct(){
          
        $this->load->database();
        
      }
      
      //API call - get a record by id
      public function getstaff($id){  
           $this->db->select('id, first_name, last_name, phone, email, role_type');
           $this->db->from('staff_data');
           $this->db->where('id',$id);
           $query = $this->db->get();
           
           if($query->num_rows() == 1)
           {
               return $query->result_array();
           }
           else
           {
             return 0;
          }
      }
    //API call - get all record
    public function getalldata(){   
        $this->db->select('id, first_name, last_name, phone, email, role_type');
        $this->db->from('staff_data');
        $this->db->order_by("id", "ASC"); 
        $query = $this->db->get();
        if($query->num_rows() > 0){
          return $query->result_array();
        }else{
          return 0;
        }
    }
   
   //API call - delete a record
    public function delete($id){
       $this->db->where('id', $id);
       if($this->db->delete('staff_data')){
          return true;
        }else{
          return false;
        }
   }
   
   //API call - add new  record
    public function add($data){
        if($this->db->insert('staff_data', $data)){
           return true;
        }else{
           return false;
        }
    }
    
    //API call - update a  record
    public function update($id, $data){
       $this->db->where('id', $id);
       if($this->db->update('staff_data', $data)){
          return true;
        }else{
          return false;
        }
    }

    //API cal - get staff by role
      public function getstaffrole($role){   
        $this->db->select('id, first_name, last_name, phone, email, role_type');
        $this->db->from('staff_data');
        $this->db->where('role_type',$role);
        $this->db->order_by("id", "ASC"); 
        $query = $this->db->get();
        if($query->num_rows() > 0){
          return $query->result_array();
        }else{
          return 0;
        }
    }

     //API cal - get staff by date
     public function getstaffbydate($from,$to){   
        $this->db->select('id, first_name, last_name, phone, email, role_type');
        $this->db->from('staff_data');
        // $where = "DATE(entry) BETWEEN ".$from." AND ".$to;
        $this->db->where('DATE(entry)>=',$from);
        $this->db->where('DATE(entry)<=',$to);
        $this->db->order_by("id", "ASC"); 
        $query = $this->db->get();
        if($query->num_rows() > 0){
          return $query->result_array();
        }else{
          return 0;
        }
    }

    //Api call - check unique email
     public function getemail($email){   
        $this->db->select('id, first_name, last_name, phone, email, role_type');
        $this->db->from('staff_data');
        // $where = "DATE(entry) BETWEEN ".$from." AND ".$to;
        $this->db->where('email',$email);
        
        $query = $this->db->get();
        if($query->num_rows() > 0){
          return 1;
        }else{
          return 0;
        }
    } 

    //Api call - check unique phone
     public function getphone($phone){   
        $this->db->select('id, first_name, last_name, phone, email, role_type');
        $this->db->from('staff_data');
        // $where = "DATE(entry) BETWEEN ".$from." AND ".$to;
        $this->db->where('phone',$phone);
        
        $query = $this->db->get();
        if($query->num_rows() > 0){
          return 1;
        }else{
          return 0;
        }
    } 

}
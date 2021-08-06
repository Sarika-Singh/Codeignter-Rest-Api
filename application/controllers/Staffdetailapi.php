<?php
// require(APPPATH.'/libraries/REST_Controller.php');
require APPPATH . 'libraries\REST_Controller.php';
use Restserver\Libraries\REST_Controller;
 
class Staffdetailapi extends REST_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('StaffModel');
    }
    //API - client sends id and on valid id  information is sent back
    function getstaffbyid_get($id){
       
        
        if(!$id){
            $this->response("No ID specified", 400);
            exit;
        }
        $result = $this->StaffModel->getstaff( $id );
        if($result){
            foreach($result as $row)
            {
                $output['first_name'] = $row['first_name'];     
                $output['last_name'] = $row['last_name']; 
                $output['phone'] = $row['phone']; 
                $output['email'] = $row['email'];
                $output['role_type'] = $row['role_type'];     
            }
            echo json_encode($output);
            
        } 
        else{
             $this->response("Invalid ID", 404);
            exit;
        }
    } 
    //API -  Fetch All 
    function staff_get(){
         // $this->response("my first api");
        $result = $this->StaffModel->getalldata();
        // print_r($result);
        if($result){
            // echo json_encode($result);
            $this->response($result, 200); 
        } 
        else{
            $this->response("No record found", 404);
        }
    }
     
    //API - create a staff  in database.
    function addnewStaff_post(){
         $first_name      = $this->post('first_name');
         $last_name     = $this->post('last_name');
         $phone    = $this->post('phone');
         $email  = $this->post('email');
         $password  = base64_encode($this->post('password'));
         $role_type      = $this->post('role_type');
         $status  = 'Active';
        
         if(!$first_name || !$last_name || !$phone || !$email || !$password || !$role_type || !$status){
                // $this->response("Enter complete Staff information to save", 400);
                $array = array(
                'error'       =>  "Enter complete Staff information to save"
            );
        
        
         }else{
            $resultem=$this->StaffModel->getemail($email);
            if($resultem===1)
            {
                $array = array(
                'error'       =>  "Email Already Exist. Try again."
            ); 
            }
            else
            {
                $resultph=$this->StaffModel->getphone($phone);
                if($resultph===1)
                   {
                    $array = array(
                    'error'       =>  "Phone number Already Exist. Try again."
            ); 
                }
                else{

                        $result = $this->StaffModel->add(array("first_name"=>$first_name, "last_name"=>$last_name, "phone"=>$phone, "email"=>$email, "password"=>$password, "role_type"=>$role_type, "status"=>$status));
                        if($result === 0){
                // $this->response("Staff information could not be saved. Try again.", 404);
                             $array = array(
                             'error'       =>  "Staff information could not be saved. Try again."
                                );
                    }else{
                // $this->response("success", 200); 
                       $array = array(
                     'success'       =>  "success"
                         );

                }
            }

             
           
            }
        }
        echo json_encode($array);
    }
    
    //API - update staff 
    function updateStaff_put(){
         
         $first_name      = $this->put('first_name');
         $last_name       = $this->put('last_name');
         $phone           = $this->put('phone');
         $email           = $this->put('email');
         $role_type       = $this->put('role_type');
         $id              = $this->put('id');
         
         if(!$first_name || !$last_name || !$phone || !$email || !$role_type){
                // $this->response("Enter complete Staff information to save", 400);
                $array = array(
                'error'       =>  "Enter complete Staff information to save"
            );
        
        
         }else{
            $result = $this->StaffModel->update($id, array("first_name"=>$first_name, "last_name"=>$last_name, "phone"=>$phone, "email"=>$email, "role_type"=>$role_type));
            if($result === 0){
                // $this->response("Staff information could not be saved. Try again.", 404);
                $array = array(
                'error'       =>  "Staff information could not be saved. Try again."
            );
            }else{
                // $this->response("success", 200);  
                $array = array(
                'success'       =>  "success"
            );
            }
        }
        echo json_encode($array);
    }
    //API - delete staff 
    function deleteStaff_delete($id)
    {
        
        // $id  = $this->delete('id');
        if(!$id){
            // $this->response("Parameter missing", 404);
            $array = array(
                    'id'   =>  $id,
                    'error'   =>  "Parameter missing"
                );
        }
         else{
        if($this->StaffModel->delete($id))
        {
            // $this->response("Success", 200);
            $array = array(
                    'id'   =>  $id,
                    'success'   =>  "Data deleted Successfully"
                );
        } 
        else
        {
            // $this->response("Failed", 400);
            $array = array(
                    'id'   =>  $id,
                    'error'   =>  "Failed"
                );
        }
    }
        echo json_encode($array);
    }

     //FEtch by role
    function staffrole_get($role){
         // $this->response("my first api");
        if(!$role){
            $this->response("No ID specified", 400);
            exit;
        }
        $result = $this->StaffModel->getstaffrole( $role );
        if($result){
            // echo json_encode($result);
            $this->response($result, 200); 
        } 
        else{
            $this->response("No record found", 404);
        }
    }

    //Fetch by date
    function staffbydate_post(){
        $from      = $this->post('from');
         $to     = $this->post('to');
         // $this->response("my first api");
        if(!$from || !$to){
            $this->response("No Date specified", 400);
            exit;
        }
        $result = $this->StaffModel->getstaffbydate( $from,$to );
        if($result){
            // echo json_encode($result);
            $this->response($result, 200); 
        } 
        else{
            $this->response("No record found", 404);
        }
    }
}
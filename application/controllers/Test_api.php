<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_api extends CI_Controller {

	function index()
	{
		$this->load->view('api_view');
	}

	function action()
	{
		if($this->input->post('data_action'))
		{
			$data_action = $this->input->post('data_action');

			if($data_action == "Delete")
			{
				
				$id=$this->input->post('user_id');
				$api_url = "http://localhost/Task/Staffdetailapi/deleteStaff/".$id;
				$client = curl_init($api_url);
				// curl_setopt($client, CURLOPT_POST, false);
				curl_setopt($client, CURLOPT_CUSTOMREQUEST, 'DELETE');
				// curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client); 
				echo $response; 




			}

			if($data_action == "Edit")
			{
				$api_url = "http://localhost/Task/Staffdetailapi/updateStaff";

				$form_data = array(
					'first_name'		=>	$this->input->post('first_name'),
					'last_name'			=>	$this->input->post('last_name'),
					'phone'		        =>	$this->input->post('phone'),
					'email'			    =>	$this->input->post('email'),
					'role_type'         =>	$this->input->post('role_type'),
					'id'				=>	$this->input->post('user_id')
				);

				$client = curl_init($api_url);

				// curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_CUSTOMREQUEST, "PUT");

				curl_setopt($client, CURLOPT_POSTFIELDS, http_build_query($form_data));

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;







			}

			if($data_action == "fetch_single")
			{
				
				$id=$this->input->post('user_id');
				$api_url = "http://localhost/Task/Staffdetailapi/getstaffbyid/".$id;
				$client = curl_init($api_url);

				// curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_CUSTOMREQUEST, 'GET');

				// curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);


				$response = curl_exec($client);

				curl_close($client);

				echo $response;

			}

			if($data_action == "Insert")
			{
				$api_url = "http://localhost/Task/Staffdetailapi/addnewStaff";
			

				$form_data = array(
					'first_name'		=>	$this->input->post('first_name'),
					'last_name'			=>	$this->input->post('last_name'),
					'phone'		        =>	$this->input->post('phone'),
					'password'          =>  $this->input->post('password'),
					'email'			    =>	$this->input->post('email'),
					'role_type'         =>	$this->input->post('role_type'),
					'status'            =>  'Active'
				);

				$client = curl_init($api_url);


				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;


			}





			if($data_action == "fetch_all")
			{
			$role=$this->input->post('query');
			if($role!='')
			{
			$api_url = "http://localhost/Task/Staffdetailapi/staffrole/".$role;
			}
			else
			{
			$api_url = "http://localhost/Task/Staffdetailapi/staff";
			}
				$client = curl_init($api_url);

				// curl_setopt($client, CURLOPT_CUSTOMREQUEST, 'GET');
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);


				$response = curl_exec($client);

				curl_close($client);

				$result = json_decode($response);

				$output = '';

				if($result!= 0)
				{
					foreach($result as $row)
					{
						$output .= '
						<tr>
							<td>'.$row->first_name.'</td>
							<td>'.$row->last_name.'</td>
							<td>'.$row->email.'</td>
							<td>'.$row->phone.'</td>
							<td>'.$row->role_type.'</td>
							<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id.'">Edit</button></td>
							<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id.'">Delete</button></td>
						</tr>

						';
					}
				}
				else
				{
					$output .= '
					<tr>
						<td colspan="4" align="center">No Data Found</td>
					</tr>
					';
				}

				echo $output;
			}
			if($data_action == "fetch_role")
			{
				$role=$this->input->post('role');
				$api_url = "http://localhost/Task/Staffdetailapi/getstaffbyrole/".$role;

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_CUSTOMREQUEST, 'GET');
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);


				$response = curl_exec($client);

				curl_close($client);

				$result = json_decode($response);

				$output = '';

				if($result!= 0)
				{
					foreach($result as $row)
					{
						$output .= '
						<tr>
							<td>'.$row->first_name.'</td>
							<td>'.$row->last_name.'</td>
							<td>'.$row->email.'</td>
							<td>'.$row->phone.'</td>
							<td>'.$row->role_type.'</td>
							<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id.'">Edit</button></td>
							<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id.'">Delete</button></td>
						</tr>

						';
					}
				}
				else
				{
					$output .= '
					<tr>
						<td colspan="4" align="center">No Data Found</td>
					</tr>
					';
				}

				echo $output;
			}
			if($data_action == "bydate")
			{
				
				$api_url = "http://localhost/Task/Staffdetailapi/staffbydate";
				$form_data = array(
					'from'		=>	$this->input->post('from'),
					'to'			=>	$this->input->post('to')
				);

				$client = curl_init($api_url);


				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);


				$response = curl_exec($client);

				curl_close($client);

				$result = json_decode($response);

				$output = '';

				if($result!= 0)
				{
					foreach($result as $row)
					{
						$output .= '
						<tr>
							<td>'.$row->first_name.'</td>
							<td>'.$row->last_name.'</td>
							<td>'.$row->email.'</td>
							<td>'.$row->phone.'</td>
							<td>'.$row->role_type.'</td>
							<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id.'">Edit</button></td>
							<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id.'">Delete</button></td>
						</tr>

						';
					}
				}
				else
				{
					$output .= '
					<tr>
						<td colspan="4" align="center">No Data Found</td>
					</tr>
					';
				}

				echo $output;
			}
		}
	}
	
}

?>
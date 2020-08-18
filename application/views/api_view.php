<html>
<head>
    <title>Staff Details</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    
</head>
<body>
    <div class="container">
        <br />
        <h3 align="center">Staff Details</h3>
        <br />
        <div class="row">
            <div class="col-md-6">
         <select name="searchfilter" id="searchfilter" class="form-control">
            <option value=''>Select Role</option>
                        <option value="project_manager">Project Manager</option>
                        <option value="admin">Admin</option>
                        <option value="task_manager">Task Manager</option>
                        <option value="client">Client</option>
                    </select>
                </div>
                <div class="col-md-6">
                   <div class="col-md-3">

            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" style="width: 100%;"/>
           </div>
           <div class="col-md-3">
            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" style="width: 100%;"/>
             </div>
             
               <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />  
            
                </div>
                </div>
                <br>
        <div class="panel panel-default">
            <div class="panel-heading">

                <div class="row">

                    <div class="col-md-6">
                        <h3 class="panel-title">Staff Details</h3>
                    </div>
                   
                    <div class="col-md-6" align="right">
                        <button type="button" id="add_button" class="btn btn-info btn-xs">Add</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <span id="success_message"></span>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
                    <label>Enter First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" required>
                    <br />
                    <label>Enter Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" required>
                    <br />
                    <label>Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                    <br />
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                    <br />
                    <label id="pass">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    <br />
                    <label>Role</label> 
                    <select name="role_type" id="role_type" class="form-control" required>
                        <option value="project_manager">Project Manager</option>
                        <option value="admin">Admin</option>
                        <option value="task_manager">Task Manager</option>
                        <option value="client">Client</option>
                    </select>
                    <br />
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="user_id" id="user_id" />
                    <input type="hidden" name="data_action" id="data_action" value="Insert" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){

     $(function(){  
                $("#from_date").datepicker(
                    {
                      format: "yyyy-mm-dd"
                    });  
                $("#to_date").datepicker({
                      format: "yyyy-mm-dd"
                    }); 
                   
           }); 
    
    function fetch_data(query='')
    {
        $.ajax({
            url:"<?php echo base_url(); ?>test_api/action",
            method:"POST",
            data:{query:query,data_action:'fetch_all'},
            success:function(data)
            {
                $('tbody').html(data);
            }
        });
    }

    fetch_data();

 $('#searchfilter').change(function(){
  
   var val=$(this).val();
   
    fetch_data(val);
  
 });


    $('#add_button').click(function(){
        $('#user_form')[0].reset();
        $('.modal-title').text("Add User");
        $('#action').val('Add');
        $('#data_action').val("Insert");
        $('#userModal').modal('show');
    });

    $(document).on('submit', '#user_form', function(event){
        event.preventDefault();
        $.ajax({
            url:"<?php echo base_url() . 'test_api/action' ?>",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data)
            {
                if(data.success)
                {
                    $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                    fetch_data();
                    if($('#data_action').val() == "Insert")
                    {
                        $('#success_message').html('<div class="alert alert-success">Data Inserted</div>');
                    }
                }
                 if(data.error)
                {
                    $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                    fetch_data();
                    if($('#data_action').val() == "Insert")
                    {
                        $('#success_message').html('<div class="alert alert-danger">'+data.error+'</div>');
                    }
                }

                

            }
        })
    });

    $(document).on('click', '.edit', function(){
        var user_id = $(this).attr('id');
        $.ajax({
            url:"<?php echo base_url(); ?>test_api/action",
            method:"POST",
            data:{user_id:user_id, data_action:'fetch_single'},
            dataType:"json",
            success:function(data)
            {
                console.log(data);
                $('#userModal').modal('show');

                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
                // document.getElementById('pass').style.display = 'none';
                document.getElementById('password').style.display = 'none';
                document.getElementById("password").required = false;
                $('#role_type').val(data.role_type);
                $('.modal-title').text('Edit User');
                $('#user_id').val(user_id);
                $('#action').val('Edit');
                $('#data_action').val('Edit');
            }
        })
    });

    $(document).on('click', '.delete', function(){
        var user_id = $(this).attr('id');
        
        if(confirm("Are you sure you want to delete this?"))
        {
            $.ajax({
                url:"<?php echo base_url(); ?>test_api/action",
                method:"POST",
                data:{user_id:user_id, data_action:'Delete'},
                dataType:"json",
                success:function(data)
                {
                    console.log(data);
                    if(data.success)
                    {
                        $('#success_message').html('<div class="alert alert-success">Data Deleted</div>');
                        fetch_data();
                    }
                    else{
                        $('#success_message').html('<div class="alert alert-success">data Error</div>');
                        fetch_data();
                    }
                }
            })
        }
    });
    $('#filter').click(function(){
       
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"<?php echo base_url(); ?>test_api/action",  
                          method:"POST",  
                          data:{from:from_date, to:to_date,data_action:'bydate'},  
                          success:function(data)  
                          {  
                           
                             $('tbody').html(data);
                     } 
                    });
                 }
                else  
                {  
                   
                 
                     alert("Please Select Date");  
                    
                    
                } 
                
           });
});
</script>
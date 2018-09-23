<?php 
  if(isset($_GET['update'])){

    $uid = $_GET['update']; 

    $name = $FM->validation($_POST['name']);
    $name =  mysqli_real_escape_string($DB->link,$name);

    $dept_id = $FM->validation($_POST['dept_id']);
    $dept_id =  mysqli_real_escape_string($DB->link,$dept_id);


    $batch = $FM->validation($_POST['batch']);
    $batch =  mysqli_real_escape_string($DB->link,$batch);


    $session = $FM->validation($_POST['session']);
    $session =  mysqli_real_escape_string($DB->link,$session);


    $birthdate = $FM->validation($_POST['birthdate']);
    $birthdate =  mysqli_real_escape_string($DB->link,$birthdate);


    $fathers_name = $FM->validation($_POST['fathers_name']);
    $fathers_name =  mysqli_real_escape_string($DB->link,$fathers_name);

    $mothers_name = $FM->validation($_POST['mothers_name']);
    $mothers_name =  mysqli_real_escape_string($DB->link,$mothers_name);

    $contact = $FM->validation($_POST['contact']);
    $contact =  mysqli_real_escape_string($DB->link,$contact);

    $address = $FM->validation($_POST['address']);
    $address =  mysqli_real_escape_string($DB->link,$address);

    if(empty($name) OR empty($dept_id) OR empty($session) OR empty($batch) OR empty($fathers_name) OR empty($mothers_name) OR empty($contact) OR empty($address)){
      $signal = '<small class="glyphicon glyphicon-remove" aria-hidden="true" style="color:yellow;"></small>';  
       header('Location:index.php?page=Students&signal='.$signal);
    }else{
      $qry = "UPDATE tb_student 
      SET 
      name = '$name',
      dept_id= '$dept_id',
      batch = '$batch',
      session = '$session',
      birthdate = '$birthdate',
      fathers_name = '$fathers_name',
      mothers_name = '$mothers_name',
      contact = '$contact',
      address = '$address' WHERE id='$uid'"; 
      $resultu = $DB->update($qry); 
      if($resultu){
        $signal = '<small class="glyphicon glyphicon-ok" aria-hidden="true" style="color:yellow;"></small>'; 
        header('Location:index.php?page=Students&signal='.$signal);    
      }
    }
  }
?>

<?php
  if(isset($_GET['remove'])){
    $id = $_GET['remove']; 
    //$department_name = $_POST['department_name'];
    
    if(empty($id)){
      $signal = '<small class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;"></small>';  
       header('Location:index.php?page=Students&signal='.$signal);
    }else{
      $qry = "DELETE FROM tb_profile WHERE id='$id'"; 
      $result = $DB->delete($qry); 
      if($result){
  		$qry = "DELETE FROM tb_user WHERE id='$id'";
  		$delres = $DB->delete('tb_user'); 
  		if($delres){
        	$signal = '<small class="glyphicon glyphicon-ok" aria-hidden="true" style="color:red;"></small>';  
        	header('Location:index.php?page=Students&signal='.$signal);
  		}else{
        	$signal = '<small class="glyphicon glyphicon-ok" aria-hidden="true" style="color:red;"></small>';  
        	header('Location:index.php?page=Students&signal='.$signal);
  		}
      }
    }
  }
?>
<?php 
	if(isset($_GET['un'])){
		$username = $_GET['un']; 
		$password = md5($_GET['pw']); 
		$type = $_GET['type']; 
		$fn = $_GET['fn']; 
		$dn = $_GET['dn'];

		$qrySelect = "SELECT * FROM tb_profile WHERE first_name='$fn' AND designation='$dn'"; 
		$resSelect = $DB->select($qrySelect);
		if($resSelect = $resSelect->fetch_assoc()){
			$proId = $resSelect['id']; 
			$qryUser = "INSERT INTO tb_user (username,password,type,profile_id) VALUES ('$username','$password','$type','$proId')"; 
			$resUserTb = $DB->insert($qryUser); 
			if($resUserTb){
		        $signal = '<small class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green;"></small>'; 
		        header('Location:index.php?page=Faculties&signal='.$signal); 
			}
		}
	}
?>
<?php 
  if(isset($_GET['save'])){

    $username = $FM->validation($_POST['username']);
    $username =  mysqli_real_escape_string($DB->link,$username);

    $password = $FM->validation($_POST['password']);
    $password =  mysqli_real_escape_string($DB->link,$password);
    $c_password = $FM->validation($_POST['c_password']);
    $c_password =  mysqli_real_escape_string($DB->link,$c_password);

    $type = $FM->validation($_POST['type']);
    $type =  mysqli_real_escape_string($DB->link,$type);

if($password = $c_password){
    $first_name = $FM->validation($_POST['first_name']);
    $first_name =  mysqli_real_escape_string($DB->link,$first_name);

    $last_name = $FM->validation($_POST['last_name']);
    $last_name =  mysqli_real_escape_string($DB->link,$last_name);

    $designation = $FM->validation($_POST['designation']);
    $designation = ucwords(mysqli_real_escape_string($DB->link,$designation));

    $education = $FM->validation($_POST['education']);
    $education =  mysqli_real_escape_string($DB->link,$education);


    $phone = $FM->validation($_POST['phone']);
    $phone =  mysqli_real_escape_string($DB->link,$phone);


    $email = $FM->validation($_POST['email']);
    $email =  mysqli_real_escape_string($DB->link,$email);

    $dept_id = $FM->validation($_POST['dept_id']);
    $dept_id =  mysqli_real_escape_string($DB->link,$dept_id);


    if(empty($first_name) OR empty($last_name) OR empty($designation) OR empty($education) OR empty($phone) OR empty($email) OR empty($dept_id)){
       $signal = '<small class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;">1</small>';  
       header('Location:index.php?page=Faculties&signal='.$signal);
    }else{
      $qry = "INSERT INTO tb_profile (first_name,last_name,designation,education,phone,email,dept_id) VALUES ('$first_name','$last_name','$designation','$education','$phone','$email','$dept_id')"; 
      $result = $DB->insert($qry); 
      if($result){
        $signal = '<small class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green;">2</small>'; 
        header('Location:index.php?page=Faculties&un='.$username.'&pw='.$password.'&type='.$designation.'&fn='.$first_name.'&dn='.$designation);    
      }
    }
}else{
    $signal = '<small class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;">3</small>';  
    header('Location:index.php?page=Faculties&signal='.$signal);
}

  }
?>
<section class="container-fluid section-content">
  <section class="container">
    <h3>Faculty Control Panel &nbsp; <?php if(isset($_GET['signal'])){ echo $_GET['signal']; }?>
      <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addStudent">
          + Add Member
      </button>
    </h3><hr/>
<!--/=================================================================/-->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<form class="form-horizontal" action="index.php?page=Faculties&save" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Faculty Member</h4>
      </div>
      <div class="modal-body">

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">First Name</label>
    <div class="col-sm-9">
      <input name="first_name" type="text" class="form-control" id="inputEmail3" placeholder="Enter First Name !">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Last Name</label>
    <div class="col-sm-9">
      <input name="last_name" type="text" class="form-control" id="inputEmail3" placeholder="Enter Last Name !">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Designation</label>
    <div class="col-sm-9">
      <input name="designation" type="text" class="form-control" id="inputEmail3">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Education</label>
    <div class="col-sm-9">
      <input name="education" type="text" class="form-control" id="inputEmail3" placeholder="Enter Father's Name !">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Phone</label>
    <div class="col-sm-9">
      <input name="phone" type="text" class="form-control" id="inputEmail3" placeholder="Enter Mother's Name !">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
    <div class="col-sm-9">
      <input name="email" type="email" class="form-control" id="inputEmail3" placeholder="Enter Contact No. !">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Department</label>
    <div class="col-sm-9">
      <select name="dept_id" class="form-control">
        <option value="">Select Department</option>
<?php 
  $qry = "SELECT * FROM tb_department WHERE status=0";
  $result = $DB->select($qry); 
  if($result){
    while($dept = $result->fetch_array()){
?>
        <option value="<?php echo $dept['id']; ?>"><?php echo $dept['department_name']; ?></option>
<?php 
    }//end of dept while..
  }//end of dept if..
?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Username</label>
    <div class="col-sm-9">
      <input name="username" type="text" class="form-control" id="inputEmail3" placeholder="Enter Username !">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Password</label>
    <div class="col-sm-9">
      <input name="password" type="password" class="form-control" id="inputEmail3" placeholder="Enter Password !">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Confirm Password</label>
    <div class="col-sm-9">
      <input name="c_password" type="password" class="form-control" id="inputEmail3" placeholder="confirm Password !">
    </div>
  </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">+ Add Student</button>
      </div>
</form>
    </div>
  </div>
</div>
<!--/=================================================================/-->


<table id="mytableId" class="display table table-responsive">
    <thead>
        <tr>
            <th>Serial No</th>
            <th>Member Name</th>
            <th>Details</th>
            <th style="width:30%;text-align: center;" >Action</th>
        </tr>
    </thead>
    <tbody>

<?php 
  $qry = "SELECT * FROM tb_profile";
  $result = $DB->select($qry); 
  if($result){
    $i = 0; 
    while($profile = $result->fetch_array()){
      $i++;
?>
       <tr>
            <td><?php echo $i; ?></td>
            <td style="font-size:1.4em; font-weight: bold; color:teal;">
            	<?php echo $profile['first_name'].'&nbsp;'.$profile['last_name']; ?><br/>
            	<span style="font-size: 0.6em; color:black;">Designation: <?php echo $profile['designation']; ?></span><br/>
            	<span style="font-size: 0.6em; color:black;">Education: <?php echo $profile['education']; ?></span>
            </td>
            <td>
              <?php 
                $deptid = $profile['dept_id']; 
                $qryd = "SELECT department_name FROM tb_department WHERE id='$deptid'"; 
                $rest = $DB->select($qryd); 
                if($rest){
                  $dept = $rest->fetch_assoc(); 
              ?>
                  <b>Department#</b> <?php echo $dept['department_name']; ?><br/>    
              <?php }//dept showing.. ?>
              
              <b>Phone#</b><?php echo $profile['phone']; ?><br/>
              <b>Email#</b> <?php echo $profile['email']; ?><br/>
            </td>
            <td style="text-align: center;">
              <button class="btn btn-sm btn-warning"  data-toggle="modal" data-target="#updateFaculties<?php echo $profile['id']; ?>">Update</button>
              <a href="index.php?page=Faculties&remove=<?php echo $profile['id']; ?>" class="btn btn-sm btn-danger">Remove</a>

        <!-- Modal -->
        <div class="modal fade" id="updateFaculties<?php echo $profile['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
        <form class="form-horizontal" action="index.php?page=Faculties&update=<?php echo $profile['id']; ?>" method="post">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Student Info</h4>
              </div>
              <div class="modal-body" style="min-height: 10vh;">

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9">
              <input name="id" type="hidden" class="form-control" id="inputEmail3" value="<?php echo $profile['id']; ?>">
              <input name="name" type="text" class="form-control" id="inputEmail3" value="<?php echo $profile['name']; ?>">
            </div>
          </div> 

<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Department</label>
    <div class="col-sm-9">
      <select name="dept_id" class="form-control">
        <option value="">Select Department</option>
<?php 
  $qryd = "SELECT * FROM tb_department WHERE status=0";
  $resd = $DB->select($qryd); 
  if($result){
    while($deptd = $resd->fetch_array()){
?>
        <option value="<?php echo $deptd['id']; ?>" <?php if($student['dept_id'] == $deptd['id']){ echo 'selected'; } ?> ><?php echo $deptd['department_name']; ?></option>
<?php 
    }//end of dept while..
  }//end of dept if..
?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Batch</label>
    <div class="col-sm-9">
      <input name="batch" type="text" class="form-control" id="inputEmail3" value="<?php echo $student['batch']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Session</label>
    <div class="col-sm-9">
      <input name="session" type="text" class="form-control" id="inputEmail3" value="<?php echo $student['session']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Birthdate</label>
    <div class="col-sm-9">
      <input name="birthdate" type="date" class="form-control" id="inputEmail3" value="<?php echo $student['birthdate']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Father's Name</label>
    <div class="col-sm-9">
      <input name="fathers_name" type="text" class="form-control" id="inputEmail3" value="<?php echo $student['fathers_name']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Mother's Name</label>
    <div class="col-sm-9">
      <input name="mothers_name" type="text" class="form-control" id="inputEmail3" value="<?php echo $student['mothers_name']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Contact No</label>
    <div class="col-sm-9">
      <input name="contact" type="text" class="form-control" id="inputEmail3" value="<?php echo $student['contact']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Address</label>
    <div class="col-sm-9">
      <textarea name="address" placeholder="Enter Address !" class="form-control" rows="2">
        <?php echo $student['address']; ?>
      </textarea>
    </div>
  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">+ Update Students</button>
              </div>
        </form>
            </div>
          </div>
        </div>
            </td>
        </tr>


<?php 
    }//end of while
  }//end of if..
?>
 


    </tbody>
</table>
<br/>
<script>
$(document).ready( function () {
    $('#mytableId').DataTable();
} );
</script>


  </section>
</section>

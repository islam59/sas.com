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
      $qry = "DELETE FROM tb_student WHERE id='$id'"; 
      $result = $DB->delete($qry); 
      if($result){
        $signal = '<small class="glyphicon glyphicon-ok" aria-hidden="true" style="color:red;"></small>';  
        header('Location:index.php?page=Students&signal='.$signal);
      }
    }
  }
?>
<?php 
  if(isset($_GET['save'])){

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
      $signal = '<small class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;"></small>';  
       header('Location:index.php?page=Students&signal='.$signal);
    }else{
      $qry = "INSERT INTO tb_student (name,dept_id,batch,session,birthdate,fathers_name,mothers_name,contact,address) VALUES ('$name','$dept_id','$batch','$session','$birthdate','$fathers_name','$mothers_name','$contact','$address')"; 
      $result = $DB->insert($qry); 
      if($result){
        $signal = '<small class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green;"></small>'; 
        header('Location:index.php?page=Students&signal='.$signal);    
      }
    }
  }
?>
<section class="container-fluid section-content">
  <section class="container">
    <h3>Student Control Panel &nbsp; <?php if(isset($_GET['signal'])){ echo $_GET['signal']; }?>
      <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addStudent">
          + Add Students
      </button>
    </h3><hr/>
<!--/=================================================================/-->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<form class="form-horizontal" action="index.php?page=Students&save" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Student</h4>
      </div>
      <div class="modal-body">

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
    <div class="col-sm-9">
      <input name="name" type="text" class="form-control" id="inputEmail3" placeholder="Enter Student Name !">
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
    <label for="inputEmail3" class="col-sm-3 control-label">Batch</label>
    <div class="col-sm-9">
      <input name="batch" type="text" class="form-control" id="inputEmail3" placeholder="Enter Batch !">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Session</label>
    <div class="col-sm-9">
      <input name="session" type="text" class="form-control" id="inputEmail3" placeholder="Enter Session !">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Birthdate</label>
    <div class="col-sm-9">
      <input name="birthdate" type="date" class="form-control" id="inputEmail3">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Father's Name</label>
    <div class="col-sm-9">
      <input name="fathers_name" type="text" class="form-control" id="inputEmail3" placeholder="Enter Father's Name !">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Mother's Name</label>
    <div class="col-sm-9">
      <input name="mothers_name" type="text" class="form-control" id="inputEmail3" placeholder="Enter Mother's Name !">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Contact No</label>
    <div class="col-sm-9">
      <input name="contact" type="text" class="form-control" id="inputEmail3" placeholder="Enter Contact No. !">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Address</label>
    <div class="col-sm-9">
      <textarea name="address" placeholder="Enter Address !" class="form-control" rows="2"></textarea>
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
            <th>Student Name</th>
            <th>Details</th>
            <th style="width:30%;text-align: center;" >Action</th>
        </tr>
    </thead>
    <tbody>

<?php 
  $qry = "SELECT * FROM tb_student";
  $result = $DB->select($qry); 
  if($result){
    $i = 0; 
    while($student = $result->fetch_array()){
      $i++;
?>
       <tr>
            <td><?php echo $i; ?></td>
            <td style="font-size:1.4em; font-weight: bold;"><?php echo $student['name']; ?></td>
            <td>
              <?php 
                $deptid = $student['dept_id']; 
                $qryd = "SELECT department_name FROM tb_department WHERE id='$deptid'"; 
                $rest = $DB->select($qryd); 
                if($rest){
                  $dept = $rest->fetch_assoc(); 
              ?>
                  <b>Department#</b> <?php echo $dept['department_name']; ?><br/>    
              <?php }//dept showing.. ?>
              
              <b>Batch#</b><?php echo $student['batch']; ?><br/>
              <b>Session#</b> <?php echo $student['session']; ?><br/>
              <b>Father#</b><?php echo $student['fathers_name']; ?><br/>
              <b>Mother#</b><?php echo $student['mothers_name']; ?><br/>
              <b>Gardian Contact#</b><?php echo $student['contact']; ?><br/>
              <b>Address#</b><?php echo $student['address']; ?><br/><br/>
            </td>
            <td style="text-align: center;">
              <button class="btn btn-sm btn-warning"  data-toggle="modal" data-target="#updateStudent<?php echo $student['id']; ?>">Update</button>
              <a href="index.php?page=Students&remove=<?php echo $student['id']; ?>" class="btn btn-sm btn-danger">Remove</a>

        <!-- Modal -->
        <div class="modal fade" id="updateStudent<?php echo $student['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
        <form class="form-horizontal" action="index.php?page=Students&update=<?php echo $student['id']; ?>" method="post">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Student Info</h4>
              </div>
              <div class="modal-body" style="min-height: 10vh;">

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9">
              <input name="id" type="hidden" class="form-control" id="inputEmail3" value="<?php echo $student['id']; ?>">
              <input name="name" type="text" class="form-control" id="inputEmail3" value="<?php echo $student['name']; ?>">
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

<?php 
  if(isset($_GET['update'])){
    $id = $_POST['id']; 
    $department_name = $_POST['department_name']; 

    if(empty($id) OR empty($department_name)){
      $signal = '<small class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;"></small>';  
      header('Location:index.php?page=Departments&signal='.$signal);
    }else{
      $qry = "UPDATE tb_department SET department_name = '$department_name' WHERE id='$id'"; 
      $result = $DB->update($qry); 

      if($result){
        $signal = '<small class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green;"></small>';  
        header('Location:index.php?page=Departments&signal='.$signal);   
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
       header('Location:index.php?page=Departments&signal='.$signal);
    }else{
      $qry = "DELETE FROM tb_department WHERE id='$id'"; 
      $result = $DB->delete($qry); 
      if($result){
        $signal = '<small class="glyphicon glyphicon-ok" aria-hidden="true" style="color:red;"></small>';  
        header('Location:index.php?page=Departments&signal='.$signal);
      }
    }
  }
?>
<?php 
	if(isset($_GET['save'])){
		$dept_id = $FM->validation($_POST['dept_id']);
		$dept_id =  mysqli_real_escape_string($DB->link,$dept_id);

    $course_id = $FM->validation($_POST['course_id']);
    $course_id =  mysqli_real_escape_string($DB->link,$course_id);

    $profile_id = $FM->validation($_POST['profile_id']);
    $profile_id =  mysqli_real_escape_string($DB->link,$profile_id);

    $room_no = $FM->validation($_POST['room_no']);
    $room_no =  mysqli_real_escape_string($DB->link,$room_no);

    $class_date = $FM->validation($_POST['class_date']);
    $class_date =  mysqli_real_escape_string($DB->link,$class_date);

    $class_time = $FM->validation($_POST['class_time']);
    $class_time =  mysqli_real_escape_string($DB->link,$class_time);

		if(empty($dept_id) OR empty($course_id) OR empty($profile_id) OR empty($room_no) OR empty($class_date) OR empty($class_time)){
			$signal = '<small class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;"></small>';  
       header('Location:index.php?page=Attendance&signal='.$signal);
		}else{
			$qry = "INSERT INTO tb_schedule (dept_id,course_id,profile_id,room_no,class_date,class_time) VALUES ('$dept_id','$course_id','$profile_id','$room_no','$class_date','$class_time')"; 

			$result = $DB->insert($qry); 
			if($result){
				$signal = '<small class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green;"></small>'; 
        header('Location:index.php?page=Attendance&signal='.$signal);  	
			}
		}
	}
?>
<section class="container-fluid section-content">
	<section class="container">
		<h3>Schedule Control Panel &nbsp; <?php if(isset($_GET['signal'])){ echo $_GET['signal']; }?>
			<button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addSchedule">
  				+ Add Schedule
			</button>
		</h3><hr/>
<!--/=================================================================/-->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="addSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<form class="form-horizontal" action="index.php?page=Attendance&save" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Schedule</h4>
      </div>
      <div class="modal-body">

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
    <label for="inputEmail3" class="col-sm-3 control-label">Course</label>
    <div class="col-sm-9">
      <select name="course_id" class="form-control">
        <option value="">Select Course</option>
<?php 
  $qryc = "SELECT * FROM tb_course WHERE status=0";
  $resultc = $DB->select($qryc); 
  if($resultc){
    while($c = $resultc->fetch_array()){
?>
        <option value="<?php echo $c['id']; ?>"><?php echo $c['course_name']; ?></option>
<?php 
    }//end of c while..
  }//end of c if..
?>
      </select>
    </div>
  </div>


  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Teacher</label>
    <div class="col-sm-9">
      <select name="profile_id" class="form-control">
        <option value="">Select Teacher</option>
<?php 
  $qryp = "SELECT * FROM tb_profile WHERE status=0";
  $resultp = $DB->select($qryp); 
  if($resultp){
    while($p = $resultp->fetch_array()){
?>
        <option value="<?php echo $p['id']; ?>"><?php echo $p['first_name'].''.$p['last_name']; ?></option>
<?php 
    }//end of c while..
  }//end of c if..
?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Room No</label>
    <div class="col-sm-9">
      <input type="text" name="room_no" class="form-control" placeholder="Room No!">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Class Date</label>
    <div class="col-sm-9">
      <input type="date" name="class_date" class="form-control">
    </div>
  </div>


  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Class Time</label>
    <div class="col-sm-9">
      <input type="text" name="class_time" class="form-control">
    </div>
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">+ Add Schedule</button>
      </div>
</form>
    </div>
  </div>
</div>
<!--/=================================================================/-->

<div class="col-md-12 col-sm-12 col-lg-12">
  <div class="row">
<?php 
  $qrySCH = "SELECT * FROM tb_schedule"; 
  $resSCH = $DB->select($qrySCH); 
  if($resSCH){
    while($dataSCH = $resSCH->fetch_array()){
?>
<button class="btn btn-lg btn-primary" style="border-radius: 0; box-shadow: 0px 0px 5px red;">
  <?php 
    $profile = $dataSCH['profile_id']; 
    $qprofile = "SELECT * FROM tb_profile WHERE id='$profile'"; 
    $rprofile = $DB->select($qprofile);
    if($rprofile = $rprofile->fetch_assoc()){
      echo $rprofile['first_name'].' '.$rprofile['last_name'];
    }
  ?><br/>
  <span style="color:red;"><?php echo $dataSCH['class_time']; ?></span><br/>
  <?php echo $dataSCH['class_date']; ?>
</button>
<?php 
    }
  }
?>
  </div>
</div>


	</section>
</section>

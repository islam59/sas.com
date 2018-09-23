<?php 
  if(isset($_GET['update'])){
    $id = $_POST['id']; 
    $course_name = $_POST['course_name']; 

    if(empty($id) OR empty($course_name)){
      $signal = '<small class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;"></small>';  
      header('Location:index.php?page=Course&signal='.$signal);
    }else{
      $qry = "UPDATE tb_course SET course_name = '$course_name' WHERE id='$id'"; 
      $result = $DB->update($qry); 

      if($result){
        $signal = '<small class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green;"></small>';  
        header('Location:index.php?page=Course&signal='.$signal);   
      }
    }

  }
?>
<?php
  if(isset($_GET['remove'])){
    $id = $_GET['remove']; 
    //$course_name = $_POST['course_name'];
    
    if(empty($id)){
      $signal = '<small class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;"></small>';  
       header('Location:index.php?page=Course&signal='.$signal);
    }else{
      $qry = "DELETE FROM tb_course WHERE id='$id'"; 
      $result = $DB->delete($qry); 
      if($result){
        $signal = '<small class="glyphicon glyphicon-ok" aria-hidden="true" style="color:red;"></small>';  
        header('Location:index.php?page=Course&signal='.$signal);
      }
    }
  }
?>
<?php 
	if(isset($_GET['save'])){
		$course_name = $FM->validation($_POST['course_name']);
		$course_name =  mysqli_real_escape_string($DB->link,$course_name);

		if(empty($course_name)){
			$signal = '<small class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;"></small>';  
       header('Location:index.php?page=Course&signal='.$signal);
		}else{
			$qry = "INSERT INTO tb_course (course_name) VALUES ('$course_name')"; 
			$result = $DB->insert($qry); 
			if($result){
				$signal = '<small class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green;"></small>'; 
        header('Location:index.php?page=Course&signal='.$signal);  	
			}
		}
	}
?>
<section class="container-fluid section-content">
	<section class="container">
		<h3>Course Control Panel &nbsp; <?php if(isset($_GET['signal'])){ echo $_GET['signal']; }?>
			<button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addCourse">
  				+ Add Course
			</button>
		</h3><hr/>
<!--/=================================================================/-->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="addCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<form class="form-horizontal" action="index.php?page=Course&save" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Department</h4>
      </div>
      <div class="modal-body">

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Course Name</label>
    <div class="col-sm-9">
      <input name="course_name" type="text" class="form-control" id="inputEmail3" placeholder="Enter Department Name !">
    </div>
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">+ Add Course</button>
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
            <th>Course Name</th>
            <th style="width:30%;text-align: center;" >ACTIONS</th>
        </tr>
    </thead>
    <tbody>

<?php 
  $qry = "SELECT * FROM tb_course";
  $result = $DB->select($qry); 
  if($result){
    $i = 0; 
    while($course = $result->fetch_array()){
      $i++;
?>
       <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $course['course_name']; ?></td>
            <td style="text-align: center;">
              <button class="btn btn-sm btn-warning"  data-toggle="modal" data-target="#updateDepartment<?php echo $course['id']; ?>">Update</button>
              <a href="index.php?page=Course&remove=<?php echo $course['id']; ?>" class="btn btn-sm btn-danger">Remove</a>

        <!-- Modal -->
        <div class="modal fade" id="updateDepartment<?php echo $course['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
        <form class="form-horizontal" action="index.php?page=Course&update" method="post">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Course</h4>
              </div>
              <div class="modal-body" style="min-height: 10vh;">

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Course Name</label>
            <div class="col-sm-9">
              <input name="id" type="hidden" class="form-control" id="inputEmail3" value="<?php echo $course['id']; ?>">
              <input name="course_name" type="text" class="form-control" id="inputEmail3" value="<?php echo $course['course_name']; ?>">
            </div>
          </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">+ Update Course</button>
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

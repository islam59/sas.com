<?php /*
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

  }*/
?>
<?php /*
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
  }*/
?>
<?php /*
	if(isset($_GET['save'])){
		$department_name = $FM->validation($_POST['department_name']);
		$department_name =  mysqli_real_escape_string($DB->link,$department_name);

		if(empty($department_name)){
			$signal = '<small class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;"></small>';  
       header('Location:index.php?page=Departments&signal='.$signal);
		}else{
			$qry = "INSERT INTO tb_department (department_name) VALUES ('$department_name')"; 
			$result = $DB->insert($qry); 
			if($result){
				$signal = '<small class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green;"></small>'; 
        header('Location:index.php?page=Departments&signal='.$signal);  	
			}
		}
	}*/
?>
<section class="container-fluid section-content">
	<section class="container">
		<h3>Department Control Panel &nbsp; <?php if(isset($_GET['signal'])){ echo $_GET['signal']; }?>
			<button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addDepartment">
  				+ Add Departments
			</button>
		</h3><hr/>
<!--/=================================================================/-->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="addDepartment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<form class="form-horizontal" action="index.php?page=Departments&save" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Department</h4>
      </div>
      <div class="modal-body">

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Department</label>
    <div class="col-sm-10">
      <input name="department_name" type="text" class="form-control" id="inputEmail3" placeholder="Enter Department Name !">
    </div>
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">+ Add Department</button>
      </div>
</form>
    </div>
  </div>
</div>
<!--/=================================================================/-->




<?php 
  $qry = "SELECT * FROM tb_schedule";
  $result = $DB->select($qry); 
  if($result){
    $i = 0; 
    while($dept = $result->fetch_array()){
      $i++;
?>
	<div class="col-sm-6 col-xs-6 col-md-2 col-lg-2 col-xl-2">;lsadfkj</div>
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

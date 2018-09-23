<?php 
	include 'Library/Session.php'; 
	Session::init();

	include 'Configuration/config.php'; 
	include 'Library/Database.php'; 

	include 'Helpers/Format.php'; 

	$DB = new Database(); 
	$FM = new Format(); 
?>
<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$username = $FM->validation($_POST['username']);
		$password = $FM->validation(md5($_POST['password']));

		$username =  mysqli_real_escape_string($DB->link,$username);
		$password =  mysqli_real_escape_string($DB->link,$password);

		$query = "SELECT * FROM tb_user WHERE username='$username' AND password = '$password' AND status=0";
		$result = $DB->select($query);

		if($result != false){
			$value = mysqli_fetch_array($result);
			$row = mysqli_num_rows($result);
			if($row > 0){
				Session::set("login",true);
				Session::set("username", $value['username']);
				//Session::set("email", $value['email']);
				Session::set("userId", $value['id']);
				Session::set("type", $value['type']);
							 
					if(Session::get('type')){
						header("Location:index.php");	
					}else{
						$msg = '<span style="color:red;">Login Failed !</span>';
					 	header("Location:Login.php?msg=".$msg);		
					}			 
				}else{
					$msg = '<span style="color:red;">Invalid Username Or Password !</span>';
					header("Location:Login.php?msg=".$msg);
				}
		}else{
			$msg = "<span style='color:red; font-size:18px;'>Invalid Username Or Password!.</span>";
			header("Location:Login.php?msg=".$msg);
		}
	}
?>

<?php 
	include 'Included/Header.php';
?>

<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
<form method="post" action="Login.php" style="margin-top:30vh; box-shadow:0px 0px 5px black; padding:10% 8%;">
  <div class="form-group">
    <input name="username" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username !">
  </div>
  <div class="form-group">
    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button name="login" type="submit" class="btn btn-primary">Login</button>
  <?php 
  	if(isset($_GET['msg'])){ echo $_GET['msg']; }
  ?>
</form>
</div>
<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>

<?php
	include 'Included/Footer.php';
?>
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
  if(!isset($_SESSION['login'])){
    header('Location:Login.php'); 
  }
?>

<?php 
  if(!isset($_GET['page'])){
    header('Location:index.php?page=Home'); 
  }else{
    $page = $_GET['page']; 
  }

/*
  FOR HOME & BLANK ENTRY !!!
*/ 
  if($page=='Logout'){
    header('Location:Logout.php'); 
  }else{
    include 'Included/Header.php'; 
    include 'Included/Menu.php'; 
    include 'Pages/'.$page.'.php'; 
    include 'Included/Footer.php'; 
  }

?>
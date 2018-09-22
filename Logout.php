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
	Session::destroy();
?>
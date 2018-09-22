<?php 
	if(isset($page)){
?>
<section class="clearfix container-fluid ">
	<div class="section-footer">
	Copyright &copy; 2018 | Powered By &mdash; Shad Masuq Siddeqe
	</div>
</section>
<?php 
	}
?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script>
$(document).ready( function () {
    $('#mytableId').DataTable();
} );
</script>

  </body>
</html>
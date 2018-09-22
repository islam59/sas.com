<section class="container-fluid section-header">

<nav class="navbar navbar-default menu">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="" style="color:white; font-weight: bold; ">SAS &mdash; <?php echo $page; ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li <?php if($page=='Home'){ echo 'style="background:red;"'; } ?>><a href="index.php?page=Home" Style="color:white;">Home</a></li>
        <li <?php if($page=='Students'){ echo 'style="background:red;"'; } ?>><a href="index.php?page=Students" Style="color:white;">Students</a></li>
        <li <?php if($page=='Faculties'){ echo 'style="background:red;"'; } ?>><a href="index.php?page=Faculties" Style="color:white;">Faculties</a></li>
        <li <?php if($page=='Attendance'){ echo 'style="background:red;"'; } ?>><a href="index.php?page=Attendance" Style="color:white;">Attendance</a></li>
        <li <?php if($page=='Results'){ echo 'style="background:red;"'; } ?>><a href="index.php?page=Results" Style="color:white;">Results</a></li>
        <li <?php if($page=='Settings'){ echo 'style="background:red;"'; } ?>><a href="index.php?page=Settings" Style="color:white;">Settings</a></li>
        <li <?php if($page=='Departments'){ echo 'style="background:red;"'; } ?>><a href="index.php?page=Departments" Style="color:white;">Departments</a></li>
        <li <?php if($page=='Logout'){ echo 'style="background:red;"'; } ?>><a href="index.php?page=Logout" Style="color:white;">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

</section>
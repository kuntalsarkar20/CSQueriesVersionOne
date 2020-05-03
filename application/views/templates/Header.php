<?php
$profileNavMenu='<li><a href="'.base_url().'signup" id="linkcolor"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
	        <li><a href="'.base_url().'login" id="linkcolor"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
if(isset($_SESSION['username'])){
	$profileNavMenu='<li class="dropdown">
	          <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="linkcolor"><img src="'. base_url().'assets/images/aboutPictures/having_doubts.png" alt="Profile Picture" style="width:50px; height:50px; border-radius:20%;"> '.$_SESSION['username'].' <span class="caret"></span></a>
	          <ul class="dropdown-menu navBar">
	            <li><a href="'.base_url().$_SESSION['username'].'/dashboard" id="linkcolor">Dash Board</a></li>
	            <li><a href="'.base_url().$_SESSION['username'].'/myContents" id="linkcolor">My Contents</a></li>
	            <li><a href="'.base_url().$_SESSION['username'].'" id="linkcolor">Profile</a></li>
	            <li><a href="'.base_url().'userManagement/profile/logout" id="linkcolor">LogOut</a></li>
	          </ul>
	        </li>';
} 
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!--modal-->
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!--Animate on Scroll CDN Sources -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<!--End AOS CDN Sources -->
    <link rel="stylesheet" type="text/css" href="/Questions/assets/css/StyleSheet.css"><!-- Our Style Sheet -->
    <!--CKEditor CDN Sources -->
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top navBar">
	  <div class="container"> <!--To make the navbar full screen add -fluid here -->
	    <div class="navbar-header" style="padding: 12px;">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>                        
	      </button>
	      <a class="navbar-brand" href="<?php echo base_url(); ?>" id="linkcolor">CSQueries</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav" style="padding: 12px;">
	        <li><a href="<?php echo base_url(); ?>" id="linkcolor">Home</a></li>
	        <li class="dropdown">
	          <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="linkcolor">Category <span class="caret"></span></a>
	          <ul class="dropdown-menu navBar">
	            <?php 
			        foreach ($category as $row) {
			        	echo '<li><a href="'.base_url().'Category/'.$row['CategoryName'].'/" id="linkcolor">'.$row['CategoryName'].'</a></li>';
					}
				?>
	          </ul>
	        </li>
	      </ul>
	      <form class="navbar-form navbar-left" style="padding: 12px;">
		      <div class="input-group">
		        <input type="text" class="form-control" placeholder="Search" name="search">
		        <div class="input-group-btn">
		          <button class="btn btn-default" type="submit">
		            <i class="glyphicon glyphicon-search"></i>
		          </button>
		        </div>
		      </div>
		    </form>
	      <ul class="nav navbar-nav navbar-right">
	        <?php echo $profileNavMenu; ?>
	      </ul>
	    </div>
	  </div>
	</nav>

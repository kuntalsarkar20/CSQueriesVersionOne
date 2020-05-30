<?php
$profileNavMenu='<ul class="nav navbar-nav navbar-right">
			<li><a href="'.base_url().'signup" id="linkcolor"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
	        <li><a href="'.base_url().'login" id="linkcolor"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	        </ul>';
if(isset($_SESSION['username'])){
	$profileNavMenu='<ul class="nav navbar-nav navbar-right">
	<li class="dropdown">
	          <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="linkcolor"><img src="'. base_url().'assets/images/UserProfilePictures/'.$_SESSION['authorPicture'].'" alt="Profile Picture" style="width:30px; height:30px; border-radius:20%;"> '.$_SESSION['username'].' <span class="caret"></span></a>
	          <ul class="dropdown-menu navBar">
	            <li><a href="'.base_url().$_SESSION['username'].'/dashboard" id="linkcolor">Dash Board</a></li>
	            <li><a href="'.base_url().$_SESSION['username'].'/myContents" id="linkcolor">My Contents</a></li>
	            <li><a href="'.base_url().$_SESSION['username'].'" id="linkcolor">Profile</a></li>
	            <li><a href="'.base_url().'userManagement/profile/logout" id="linkcolor">LogOut</a></li>
	          </ul>
	        </li>
	        </ul>';
} 
if(!isset($ContentKeyWords)){
	$ContentKeyWords = '';
}
if(!isset($MetaDescription)){
	$MetaDescription = '';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="keywords" content="<?php echo $ContentKeyWords; ?>">
  	<meta name="description" content="<?php echo $MetaDescription; ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<!--modal-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!--Animate on Scroll CDN Sources -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<!--End AOS CDN Sources -->
	<!--Tags Input StyleSheets -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
	<!--End Tags Input Plugin StyleSheets, Scripts for this plugin in placed at footer-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/StyleSheet.css"><!-- Our Style Sheet -->
    <!--CKEditor CDN Sources -->
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <!--Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">
    <!-- JS for cookie accept bar and cookie accept function -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/SetCookie.js"></script>
    <style type="text/css">
    	#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#myBtn:hover {
  background-color: #555;
}
/* Ensure the size of the image fit the container perfectly */
.img-profile {
  display: block;

  /* This rule is very important, please don't ignore this */
  max-width: 100%;
}
/*#scroll {
    position:fixed;
    right:10px;
    bottom:10px;
    cursor:pointer;
    width:50px;
    height:50px;
    background-color:#3498db;
    text-indent:-9999px;
    display:none;
    -webkit-border-radius:60px;
    -moz-border-radius:60px;
    border-radius:60px
}
#scroll span {
    position:absolute;
    top:50%;
    left:50%;
    margin-left:-8px;
    margin-top:-12px;
    height:0;
    width:0;
    border:8px solid transparent;
    border-bottom-color:#ffffff;
}
#scroll:hover {
    background-color:#e74c3c;
    opacity:1;filter:"alpha(opacity=100)";
    -ms-filter:"alpha(opacity=100)";
}*/
    </style>
    <script type="text/javascript">
    	$(document).ready(function(){ 
    $(window).scroll(function(){ 
        if ($(this).scrollTop() > 100) { 
            $('#scroll').fadeIn(); 
        } else { 
            $('#scroll').fadeOut(); 
        } 
    }); 
    $('#scroll').click(function(){ 
        $("html, body").animate({ scrollTop: 0 }, 600); 
        return false; 
    }); 
});
    </script>
</head>
<body>
	<!-- <a href="#" id="scroll" style="display: none;"><span></span></a> -->
	<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
	<nav class="navbar navbar-inverse navbar-fixed-top navBar">
	  <div class="container"> <!--To make the navbar full screen add -fluid here -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>                        
	      </button>
	      <a class="navbar-brand" href="<?php echo base_url(); ?>" id="linkcolor">CSQueries</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">
	        <li><a href="<?php echo base_url(); ?>" id="linkcolor"><span class="glyphicon glyphicon-home"></span> Home</a></li>
	        <li class="dropdown">
	          <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="linkcolor"><span class="glyphicon glyphicon-list-alt"></span> Category <span class="caret"></span></a>
	          <ul class="dropdown-menu navBar">
	            <?php 
			        foreach ($category as $row) {
			        	echo '<li><a href="'.base_url().'Category/'.$row['CategoryName'].'/" id="linkcolor">'.$row['Category'].'</a></li>';
					}
				?>
	          </ul>
	        </li>
	      </ul>
	      <form class="navbar-form navbar-left" method="post">
		      <div class="input-group">
		        <input type="text" class="form-control" placeholder="Search" name="search" required>
		        <div class="input-group-btn">
		          <button class="btn btn-default" type="submit" name="searchBtn">
		            <i class="glyphicon glyphicon-search"></i>
		          </button>
		        </div>
		      </div>
		    </form>
		    <?php
		    if(isset($_POST['searchBtn'])){
		    	$searchString = $this->security->xss_clean($_POST['search']);
		    	$searchString = preg_replace('/[^A-Za-z0-9\-+]/', '+', $searchString);
		    	redirect(base_url().'Search/'.$searchString);
		    }
		    ?>
	      <!-- <ul class="nav navbar-nav navbar-right"> -->
	        <?php echo $profileNavMenu; ?>
	      <!-- </ul> -->
	    </div>
	  </div>
	</nav>

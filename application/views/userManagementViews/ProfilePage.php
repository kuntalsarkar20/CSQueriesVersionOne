<?php
if(isset($_SESSION['username']) && isset($_SESSION['AuthId'])){
	if($_SESSION['username'] == $username){
		$editInfoButton = '<a href="" id="link" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil"></span> Edit Info</a>';
		$editPic = '<a href="" id="link" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil" style="top:-30px;left: 20px;color: black;"></span></a>';
		$editCollege = '<a href="" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-pencil" style="float: right;font-size: 20px;"></span></a>';
		$editLanguage = '<a href="" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-pencil" style="float: right;font-size: 20px;"></span></a>';
		$usrname = $username;
	}else{
		$editInfoButton = '';
		$editPic = '';
		$editCollege = '';
		$editLanguage = '';
		$usrname = $username;
	}
}else{
	$editInfoButton = '';
	$editPic = '';
	$editCollege = '';
	$editLanguage = '';
	$usrname = $username;
}
foreach ($userDetails as $row) {
	$authorName= $row['Name'];
	$clg= $row['AuthorCollege'];
	$degree= $row['Degree'];
	$YearOfGraduation= $row['YearOfGraduation'];
	$numberOfQuest = $row['userUploadedQuestionNo'];
}
?>

<section style="background-color:#f3f7f7;padding:50px 0px;">
	<div class="container" style="padding: 20px;">
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-12" style="padding:10px 20px;" id="detail">
			 <?php echo $editPic; ?>
			 <img src="<?php echo base_url(); ?>assets/images/aboutPictures/having_doubts.png" alt="Profile Picture" style="width:30%;height:100px;">
			 <h1 style="font-size: 30px;font-family:Helvetica;" class="profile-h1"><B><?php echo $authorName; ?></B></h1>
			 <h2 class="profile-h2" style="font-family:OpenSans;font-size: 20px;">@<?php echo $usrname; ?></h2>
			  <?php echo $editInfoButton; ?>
			  <hr>
			  <h2 class="profile-h2"><li>Expected gradutaion in <?php echo $degree; ?> at <?php echo $YearOfGraduation; ?></li><br></h2>
		</div>
			<div class="col-lg-8 col-md-8 col-sm-12">
				<div class="col-sm-12 profile-boxes">
					<div class="row">
						<div class="col-sm-12">
							<h1 class="profile-h1"><span class="glyphicon glyphicon-star"></span>Badges</h1>
							 <h2 class="profile-h2"><span class="glyphicon glyphicon-star" style="font-size: 30px;color:green;">
							 <span class="glyphicon glyphicon-star" style="font-size: 30px;">
							 	<span class="glyphicon glyphicon-star" style="font-size: 30px;"></h2>
							 	<h2 class="profile-h2">Number of Question Contributed: <?php echo $numberOfQuest; ?></h2>	
						</div>
					</div><hr><br>
				</div>
			</div>
		<div class="col-lg-8 col-md-8 col-sm-12" style="padding: 20px 15px 0px 15px;">
			<div class=" col-sm-12 profile-boxes" style="padding: 20px;" >
				<h1 class="profile-h1"> <span class="glyphicon glyphicon-education"></span> Education</h1>
				 <h2 class="profile-h2"><span class="glyphicon glyphicon-asterisk"></span><b> <?php echo $clg; ?></b>
				<br><?php echo $editCollege; ?> &nbsp; &nbsp;	<?php echo $degree; ?></h2>
				<br><hr>
			</div>
		</div>	
		<div class="col-lg-4 col-md-4 col-sm-12">
			<p>&nbsp;</p>
		</div>			
			<div class="col-lg-8 col-md-8 col-sm-12" style="padding:20px 10px 15px 15px;">
				<div class="col-sm-12 profile-boxes">
					<div class="row">
						<div class="col-sm-12" style="padding:0px 30px;">
							<h1 class="profile-h1"> <span class="glyphicon glyphicon-list-alt"></span> CS Topics Known:<?php echo $editLanguage; ?></h1>
							<h2 class="profile-h2"><li>C</li>
							<li>C++</li>
							<li>Java</li>
							<li>Data Structure</li></h2>
							<br><hr><br>
						</div>
					</div>
				</div>
		</div>
	</div>
	 <!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		     	<div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          	<h1 style="text-align: center;font-family: arial;">Edit Info</h1><hr>
					    <form action="/action_page.php">
						    <div class="form-group">
						      <label for="uname">Username:</label>
						      <input type="name" class="form-control" id="uname" placeholder="Enter Username" name="uname">
						    </div>
						    <div class="form-group">
						      <label for="name">First Name:</label>
						      <input type="name" class="form-control" id="uname" placeholder="Enter first Name" name="name">
						    </div>
						    <div class="form-group">
						      <label for="name">Last Name:</label>
						      <input type="name" class="form-control" id="uname" placeholder="Enter Your Name" name="name">
						    </div>
						    <div class="form-group">
						      <label for="pwd">Password:</label>
						      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
						    </div>
						    <center><button type="submit" class="btn btn-default">Change</button></center>
						</form>
			        </div>
		      	</div>
		    </div>
		</div>
		  <!-- Modal -->
		<div class="modal fade" id="myModal2" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		     	<div class="modal-content">
			        <div class="modal-header">
		          		<button type="button" class="close" data-dismiss="modal">&times;</button>
		          		<h1 style="text-align: center;font-family: arial">Edit Education</h1><hr>
					    <form action="/action_page.php">
						    <div class="form-group">
						      <label for="sch">School/College:</label>
						      <input type="name" class="form-control" id="name" placeholder="Enter School or College Name" name="name" value='<?php echo $clg; ?>'>
						    </div>
						    <div class="form-group">
						      <label for="name">Degree:</label>
						      <input type="name" class="form-control" id="cname" placeholder="like B-Tech,CS" name="cname" value="<?php echo $degree; ?>">
						    </div>
						    <div class="form-group">
						      <label for="name">Graduation Year (if not then expected):</label>
						      <input type="number" class="form-control" id="year" placeholder="Enter Year" name="year" value="<?php echo $YearOfGraduation; ?>">
						    </div>
						    <center><button type="submit" class="btn btn-default">Change</button></center>
						</form>
			        </div>
		      	</div>
		    </div>
		</div>
	</div>
</section>
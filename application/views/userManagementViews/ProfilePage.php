<?php
if(isset($_SESSION['username']) && isset($_SESSION['AuthId'])){
	if($_SESSION['username'] == $username){
		$editInfoButton = '<a href="" id="link" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil"></span> Change Password</a>';
		$editPic = '<a href="" id="link" data-toggle="modal" data-target="#imageUpload"><span class="glyphicon glyphicon-pencil" style="top:-30px;left: 20px;color: white;"></span></a>';
		$editCollege = '<button id="editCollege" style="border:none;background-color:transparent;float:right;"><span class="glyphicon glyphicon-pencil" style="float: right;font-size: 20px;"></span></button>';
		$editLanguage = '<a href="" data-toggle="modal" data-target="#editEducationDetails"><span class="glyphicon glyphicon-pencil" style="float: right;font-size: 20px;"></span></a>';
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
	$email= $row['Email'];
	$YearOfGraduation= $row['YearOfGraduation'];
	$numberOfQuest = $row['userUploadedQuestionNo'];
	$views = $row['totalView'];
	$authorPic = $row['Image'];
}
?>

<section style="background-color:#f3f7f7;padding:50px 0px;">
	<div class="container" style="padding: 20px;">
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-12" style="padding:10px 20px;" id="detail">
			<div class="profilePic-container">
			  <img src="<?php echo base_url().$authorPic; ?>" alt="Avatar" class="profilePic">
			  <div class="profilePic-overlay">
			    <div class="profilePic-overlay-text"><?php echo $editPic; ?></div>
			  </div>
			</div>
			 <h1 style="font-size: 30px;" class="profile-h1"><b><?php echo $authorName; ?></b>
			 	<br>
			 	<span style="font-size: 20px;">@<?php echo $usrname; ?></span></h1>
			 <!-- <h2 class="profile-h2" style="font-family:OpenSans;font-size: 20px;">@<?php echo $usrname; ?></h2> -->
			  <?php echo $editInfoButton; ?>
			  <hr>
			  <h2 class="profile-h2">About<br><br><li>Expected gradutaion in <?php echo $degree; ?> at <?php echo $YearOfGraduation; ?></li><br></h2>
		</div>
			<div class="col-lg-8 col-md-8 col-sm-12">
				<div class="col-sm-12 profile-boxes">
					<div class="row">
						<div class="col-sm-12">
							<h1 class="profile-h1"><span class="glyphicon glyphicon-star"></span> Badges <span class="glyphicon glyphicon-info-sign" style="color:DodgerBlue;"></span></h1>
							 <h2 class="profile-h2">
							 	<?php 
							 		if($numberOfQuest==0){
							 			$badge =0;
							 		}elseif($numberOfQuest>=1 && $numberOfQuest<=5){
							 			$badge = 1;
							 		}elseif ($numberOfQuest>=6 && $numberOfQuest<=15) {
							 			$badge = 2;
							 		}elseif ($numberOfQuest>=16 && $numberOfQuest<=30) {
							 			$badge = 3;
							 		}elseif ($numberOfQuest>=31 && $numberOfQuest<=50) {
							 			$badge = 4;
							 		}elseif ($numberOfQuest>=51) {
							 			$badge = 5;
							 		}
							 		for($i=1;$i<=$badge;$i++){
							 			echo '<span class="glyphicon glyphicon-star" style="font-size: 30px;color:green;"></span>&nbsp;&nbsp;';
							 		}
							 	?>
							 	</h2>
							 	<h2 class="profile-h2">Number of Content Contributed: <?php echo $numberOfQuest; ?>
							 		<span style="float:right;">Total Content Views: <?php echo $views; ?></span>
							 	</h2>	
						</div>
					</div><hr><br>
				</div>
			</div>
		<div class="col-lg-8 col-md-8 col-sm-12" style="padding: 20px 15px 0px 15px;">
			<div class=" col-sm-12 profile-boxes" style="padding: 20px;" >
				<h1 class="profile-h1"> <span class="glyphicon glyphicon-education"></span> Education</h1><?php echo $editCollege; ?>
				 <h2 class="profile-h2"><span class="glyphicon glyphicon-asterisk"></span><b> <?php echo $clg; ?></b>
				<br> &nbsp; &nbsp;	<?php echo $degree.', '.$YearOfGraduation; ?></h2>
				<br><hr>
				<div id="editEducationDetails" style="display:none;">
					<h1 style="text-align: center;font-family: arial">Edit Education</h1><hr>
					    <form action="">
						    <div class="form-group">
						      <label for="sch">School/College:</label>
						      <input type="name" class="form-control" id="clgName" placeholder="Enter School or College Name" value='<?php echo $clg; ?>'>
						    </div>
						    <div class="form-group">
						      <label for="name">Degree:</label>
						      <input type="name" class="form-control" id="degree" placeholder="like B-Tech,CS" value="<?php echo $degree; ?>">
						    </div>
						    <div class="form-group">
						      <label for="name">Graduation Year (if not Completed then expected year):</label>
						      <input type="number" class="form-control" id="graduationYear" placeholder="Enter Year" name="year" value="<?php echo $YearOfGraduation; ?>">
						    </div>
						    <div class="form-group">
						      <label for="sch">About Yourself:</label>
						      <input type="name" class="form-control" id="aboutAuthor" placeholder="Write Something about yourself. Others will be glad to know.">
						    </div>
						    <center><button type="button" id="EditEducationDetails" class="login-input login-submit">Change Details</button></center>
						</form>
				</div>
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
							<h2 class="profile-h2"><li>-</li>
							<li>-</li>
							<li>-</li>
							<li>-</li></h2>
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
			          	<h1 style="text-align: center;font-family: arial;">Change Password</h1><hr>
					    <form method="post">
						    <label for="usrname">Username</label>
								<div class="form-group" id="usernameSuccess">
							        <input class="form-control" type="text" value="<?php echo $usrname; ?>" name="usrname" disabled>
							      <span class="" id="msgForWrongUsername"></span>
							  	</div>
						    <div class="form-group">
						      <label for="name">Email:</label>
						      <input type="text" class="form-control" placeholder="Email" name="name" value="<?php echo $email; ?>" disabled>
						    </div>
						    <div class="form-group">
						      <label for="name">Current Password:</label>
						      <input type="password" class="form-control" placeholder="Enter Your Current Password" id="currentPassword" required>
						    </div>
						    <label for="psw">Password</label>
						    <div class="form-group">
						        <input class="form-control" type="password" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="psw" placeholder="Enter New Password" required>
						  	</div>
						  	<div id="message">
							  <h4>Password must contain the following:</h4>
							  <div class="row">
								  	<div class="col-sm-6">
									  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
									  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
									</div>
									<div class="col-sm-6">
									  <p id="number" class="invalid">A <b>number</b></p>
									  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
									</div>
								</div>
							</div>
						    <div class="form-group">
						      <label for="name">Confirm New Password:</label>
						      <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
						    </div>
						    <p id="msg"></p>
						    <center><button type="button" id="ChangePassword" onclick="changePassword()" class="login-input login-submit">Change Password</button></center>
						</form>
			        </div>
		      	</div>
		    </div>
		</div>
		 <!-- Modal for image upload-->
		<div class="modal fade" id="imageUpload" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		     	<div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          	<h2 style="text-align: center;">Change Picture</h2><hr>
					    <form method="post" enctype="multipart/form-data">
						 	<div class="form-group">
						      <input type="file"></input>
						    </div>
						    <center><button type="button" id="UpdatePicture" onclick="changePassword()" class="login-input login-submit">Update Picture</button></center>
						</form>
			        </div>
		      	</div>
		    </div>
		</div>
	</div>
</section>
<script>
$(document).ready(function(){
  $("#editCollege").click(function(){
    //$("#div1").fadeToggle();
    $("#editEducationDetails").fadeToggle("slow");
    //$("#div3").fadeToggle(3000);
  });
});
</script>
<script type="text/javascript">
	function changePassword(){
	var username = '<?php echo $_SESSION['username']; ?>';
	var currentPassword = document.getElementById('currentPassword').value;
	var newPassword = document.getElementById('psw').value;
	var confirmNewPassword = document.getElementById('confirmPassword').value;
	if(username == '' || currentPassword == '' || newPassword == '' || confirmNewPassword == '' || letter.classList == "invalid"){	//letter variable is declared in PassWordValidation.js file
		alert("No fields can be empty.");
	}else{
		sendUpdatePasswordDetails(username,currentPassword,newPassword,confirmNewPassword);
	}
	function sendUpdatePasswordDetails(username,currentPassword,newPassword,confirmNewPassword){
		$.ajax({
            type:'POST',
            url:'<?php echo base_url("userManagement/accessAccount/matchPasswords"); ?>',
            data:{'username':username,
            'currentPassword':currentPassword,
        	'newPassword': newPassword,
        	'confirmPassword': confirmNewPassword},
            success:function(data){
            	document.getElementById('msg').innerHTML = data;
            	document.getElementById('ChangePassword').style.display = 'none';
            },
            error:function(data){
            	
            }
        });
	}
	}
</script>
<!--For Password Validation -->
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/PassWordValidation.js"></script>

<?php
if(isset($_SESSION['username']) && isset($_SESSION['AuthId'])){
	if($_SESSION['username'] == $username){
		$editInfoButton = '<a href="" id="link" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil"></span> Change Password</a>';
		$editPic = '<a href="" id="link" data-toggle="modal" data-target="#imageUpload"><span class="glyphicon glyphicon-pencil" style="top:-30px;left: 20px;color: white;"></span></a>';
		$editCollege = '<button id="editCollege" style="border:none;background-color:transparent;float:right;"><span class="glyphicon glyphicon-pencil" style="float: right;font-size: 20px;"></span></button>';
		$editLanguage = '<a href="" data-toggle="modal" data-target="#topicsKnown"><span class="glyphicon glyphicon-pencil" style="float: right;font-size: 20px;"></span></a>';
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
	$about = $row['About'];
}
?>
<script type="text/javascript">
	$(document).ready(function() {       
    $('#profilePicture').bind('change', function() {
        var a=(this.files[0].size);
        if(a > 600000) {
            alert('Selected picture must be under 600 KB.');
        };
    });
});
</script>
<section style="background-color:#f3f7f7;padding:50px 0px;">
	<div class="container" style="padding: 20px;">
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-12" style="padding:10px 20px;" id="detail">
			<div class="profilePic-container">
			  <img src="<?php echo base_url().'assets/images/UserProfilePictures/'.$authorPic; ?>" alt="Avatar" class="profilePic">
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
			  <h2 class="profile-h2">About </h2>
			  <ul style="list-style-type:none;"><li> <?php echo $about; ?> </li></ul><br>
		</div>
			<div class="col-lg-8 col-md-8 col-sm-12">
				<div class="col-sm-12 profile-boxes">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<h1 class="profile-h1"><span class="glyphicon glyphicon-star"></span> Badges
								<a href="" data-toggle="modal" data-target="#badgeDetails">
								<span class="glyphicon glyphicon-info-sign" style="color:dodgerblue;"></span>
							</a></h1>
							 <div class="row">
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
							 		$ContributedQus= 0;
							 		for($i=1;$i<=$badge;$i++){
							 			$ContributedQus = $ContributedQus + 5;
							 			// echo '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6"><img src="'.base_url().'assets/images/background/badge.png" style="height:100px; width:100px;"><div class="centered" style="left:72px;;top:30%;">1st</div></div>';
							 			echo '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6" style="padding: 10px 30px 10px 30px;">
											<div class="hexagon-profile" style="height: 100px;width: 100px;background-color:#ff6633;padding: 5px 0px 10px 0px;border-radius: 25px;">
												 <p style="text-align: center;"><span class="glyphicon glyphicon-file"></span><br>
												For Contributing '.$ContributedQus.' Qus</p>
											</div>
										</div>';
							 		}
							 	?>
							 	
							 	
							 	 
								<!-- <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6" style="padding: 10px 30px 10px 30px;">
									<div class="hexagon-profile" style="height: 100px;width: 100px;background-color:#ff6633;padding: 5px 0px 10px 0px;border-radius: 25px;">
										 <p style="text-align: center;"><span class="glyphicon glyphicon-file"></span><br>
										Completed Qus: 10</p>
									</div>
								</div> -->
								</div>

							 	<h2 class="profile-h2">Total Content Views: <?php echo $views; ?></h2>	
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
					<h1 style="text-align: center;font-family: arial">Edit Education & Details</h1><hr>
					    <form action="<?php base_url() ?>userManagement/Profile/editUserDetails" method="POST">
						    <div class="form-group">
						      <label>School/College:</label>
						      <input type="text" class="form-control" name="clgName" placeholder="Enter School or College Name" value='<?php echo $clg; ?>'>
						    </div>
						    <div class="form-group">
						      <label>Degree:</label>
						      <input type="text" class="form-control" name="degree" placeholder="like B-Tech,CS" value="<?php echo $degree; ?>">
						    </div>
						    <div class="form-group">
						      <label>Graduation Year (if not Completed then expected year):</label>
						      <input type="number" class="form-control" name="graduationYear" placeholder="Enter Year" value="<?php echo $YearOfGraduation; ?>">
						    </div>
						    <div class="form-group">
						      <label>About Yourself:</label>
						      <input type="text" class="form-control" name="aboutAuthor" placeholder="Write Something about yourself. Others will be glad to know." value="<?php echo $about; ?>">
						    </div>
						    <button type="submit" name="editDetails" class="login-input login-submit">Change Details</button>
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
							<br>
							<?php
							if(empty($authorExperienced)){
								echo '<span style="background-color: lightgray;padding:3px;font-size: 14px;">No Topics added yet</span>';
							}else{
								foreach($authorExperienced as $row){
									$topics = $row['Topics'];
								}
								$iteration =1;
								$topics= explode(",",$topics);
								// print_r($topic);
								foreach($topics as $row){
									if(count($topics)==$iteration){
										echo '';
									}else{
										echo '<span style="background-color: lightgray;padding:3px;font-size: 14px;">'.$row.'</span>&nbsp;&nbsp;';
									}
									$iteration++;
								}
							}
							?>
							<!-- <span style="background-color: lightgray;padding:3px;font-size: 14px;">Hello how are you</span>&nbsp;
							<span style="background-color: lightgray;padding:3px;font-size: 14px;">Hello what up</span>&nbsp;<span style="background-color: lightgray;padding:3px;font-size: 14px;">Hello how are you</span> &nbsp;<span style="background-color: lightgray;padding:3px;font-size: 14px;">Hello how are you</span> &nbsp;<span style="background-color: lightgray;padding:3px;font-size: 14px;">Hello how are you</span> &nbsp;<span style="background-color: lightgray;padding:3px;font-size: 14px;">Hello how are you</span> -->
							
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
						    <label>Username</label>
							<div class="form-group" id="usernameSuccess">
						        <input class="form-control" type="text" value="<?php echo $usrname; ?>" name="usrname" disabled>
						      <span class="" id="msgForWrongUsername"></span>
						  	</div>
						    <div class="form-group">
						      <label>Email:</label>
						      <input type="text" class="form-control" placeholder="Email" name="name" value="<?php echo $email; ?>" disabled>
						    </div>
						    <div class="form-group">
						      <label>Current Password:</label>
						      <input type="password" class="form-control" placeholder="Enter Your Current Password" id="currentPassword" required>
						    </div>
						    <label>Password</label>
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
						      <label>Confirm New Password:</label>
						      <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
						    </div>
						    <p id="msg"></p>
						    <div style="text-align: center;"><button type="button" id="ChangePassword" onclick="changePassword()" class="login-input login-submit">Change Password</button></div>
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
					    <form method="post" enctype="multipart/form-data" action="<?php base_url() ?>userManagement/Profile/updatePicture">
					    	<div class="container">
					    		<div>
								  <img id="image" class="img-profile" src="<?php echo base_url().'assets/images/UserProfilePictures/'.$authorPic; ?>">
								</div>
					    	</div>
						 	<div class="form-group">
						      <input type="file" name="profilePicture" id="profilePicture" required>
						      <small>Picture Should be within 600 KB.</small>
						    </div>
						    <button type="submit" name="UpdatePicture" class="login-input login-submit">Update Picture</button>
						</form>
			        </div>
		      	</div>
		    </div>
		</div>
		<input type="file" name="image" id="image" onchange="readURL(this);"/>
<div class="image_container">
    <img id="blah" src="#" alt="your image" />
</div>
<div id="cropped_result"></div>        // Cropped image to display (only if u want)
<button id="crop_button">Crop</button> // Will trigger crop event
		<script type="text/javascript" defer>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
            setTimeout(initCropper, 1000);
        }
    }
    function initCropper(){
        var image = document.getElementById('blah');
        var cropper = new Cropper(image, {
          aspectRatio: 1 / 1,
          crop: function(e) {
            console.log(e.detail.x);
            console.log(e.detail.y);
          }
        });

        // On crop button clicked
        document.getElementById('crop_button').addEventListener('click', function(){
            var imgurl =  cropper.getCroppedCanvas().toDataURL();
            var img = document.createElement("img");
            img.src = imgurl;
            document.getElementById("cropped_result").appendChild(img);

            /* ---------------- SEND IMAGE TO THE SERVER-------------------------

                cropper.getCroppedCanvas().toBlob(function (blob) {
                      var formData = new FormData();
                      formData.append('croppedImage', blob);
                      // Use `jQuery.ajax` method
                      $.ajax('/path/to/upload', {
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function () {
                          console.log('Upload success');
                        },
                        error: function () {
                          console.log('Upload error');
                        }
                      });
                });
            ----------------------------------------------------*/
        })
    }
</script>
		<!-- Modal for CSLanguage known-->
		<div class="modal fade" id="topicsKnown" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		     	<div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          	<h2 style="text-align: center;">Topics You may Know</h2><hr>
					    <form method="post" enctype="multipart/form-data" action="<?php base_url() ?>userManagement/Profile/editUserKnownTopics">
						 	<div class="form-group">
						      <select multiple class="form-control" id="topic" name="knownTopics[]" required>
						        <?php 
							        foreach ($category as $row) {
										echo '<option value="'.$row['CategoryName'].'">'.$row['CategoryName'].'</option>';
									}
								?> 
						      </select>
						      <p>Press Shift or Ctrl to select multiple</p>
						  </div>
						    <button type="submit" name="updateKnownTopics" class="login-input login-submit">Update</button>
						</form>
			        </div>
		      	</div>
		    </div>
		</div>
		<!-- Modal for Badges Details-->
		<div class="modal fade" id="badgeDetails" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		     	<div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          	<h3 style="text-align: center;">Badge Details</h3> 
			        </div>
			        <div class="modal-body">
			        	<ul>
			        		<li>1 - 5 Content: 1 Badge</li>
			        		<li>6 - 15 Content: 2 Badges</li>
			        		<li>16 - 30 Content: 3 Badges</li>
			        		<li>31 - 50 Content: 4 Badges</li>
			        		<li>More than 50 Content: 5 Badges (Highest Level)</li>
			        	</ul>
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

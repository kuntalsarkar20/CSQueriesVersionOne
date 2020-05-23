<section style="padding:100px 0px;" id="signup-section">
	<!-- <p>&nbsp;</p>
	<p>&nbsp;</p> -->
	<div class="sk-folding-cube" style="position:fixed;top:40%;left:50%;" id="signup-loader">
	  <div class="sk-cube1 sk-cube"></div>
	  <div class="sk-cube2 sk-cube"></div>
	  <div class="sk-cube4 sk-cube"></div>
	  <div class="sk-cube3 sk-cube"></div>
	</div>
	<div class="container" style="display: none;" id="signup-container">
		<?php
		  if($this->uri->segment(2)=="failed"){
		    echo '<div class="alert alert-danger alert-dismissible fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Failed!</strong> Please check Your Details and try again.
			  </div>';
		  }
		  if(!empty($this->session->flashdata('error'))){
		    echo '<div class="alert alert-danger alert-dismissible fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    '.$this->session->flashdata("error").'
			  </div>';
		  }
		  ?>
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12"></div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="login-container">
					<center><h3 style="font-weight: bold;">Sign Up</h3></center>
				  <form class="form-horizontal" action="<?php echo base_url().'userManagement/accessAccount/insertUserData'; ?>" method="POST">
				    <label for="usrname">Your Name</label>
				    <div class="form-group">
				      <div class="col-sm-12">
				        <input class="form-control" type="text" name="displayName"required>
				      </div>
				  	</div>

				    <label for="usrname">Email Address</label>
				    <div class="form-group">
				      <div class="col-sm-12">
				        <input class="form-control" type="email" name="userEmail"required>
				      </div>
				  	</div>

				    <label for="usrname">Username</label>
					<div class="form-group" id="usernameSuccess">
				      <div class="col-sm-12">
				        <input class="form-control" id="focusedInput" type="text" onkeyup="usernameValidation(this.id,this.value)" name="usrname">
				        <span class="" id="icon"></span>
				      </div>
				      <span class="" id="msgForWrongUsername"></span>
				  	</div>

				    <label for="psw">Password</label>
				    <div class="form-group">
				      <div class="col-sm-12">
				        <input class="form-control" type="password" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="psw" required>
				      </div>
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

				  	<label for="psw">Confirm Password</label>
				    <div class="form-group">
				      <div class="col-sm-12">
				        <input class="form-control" type="password" id="confirm_psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="confirm-psw" required>
				      </div>
				  	</div>
				  	<div class="form-group">
					      <div class="col-sm-12">
						  <label><input type="checkbox" value="" required> I accept all the Terms & Conditions.</label>
						</div>
					</div>
				    
				    <input type="submit" class="login-input login-submit" value="Submit" id="signupbtn" name="submit">
				    <center><p><a href="<?php echo base_url().'Login';?>">Already have an account?</a></p></center>
				  </form>
				</div>

			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	document.getElementById('signup-section').style.minHeight=screen.height+"px";
	setTimeout(signupContainer, 3000)
	function signupContainer(){
		document.getElementById('signup-container').style.display='block';
		document.getElementById('signup-loader').style.display='none';
	}
	function usernameValidation(divId,uvalue){
		if(uvalue==''){
			usernameValidationFailed(divId);
		}else{
			if(typeAndLengthCheck(divId)){
				$.ajax({
                type:'POST',
                url:'<?php echo base_url("userManagement/accessAccount/isUsernameAvailable"); ?>',
                data:{'username':uvalue},
                success:function(data){
                	if(data=="Available"){
						usernameValidationSucess(divId);
						document.getElementById('msgForWrongUsername').innerHTML="";
						document.getElementById('signupbtn').disabled = false;
					}else{
						document.getElementById('msgForWrongUsername').innerHTML="&nbsp;&nbsp;Username not Available.";
						document.getElementById('signupbtn').disabled = true;
						usernameValidationFailed(divId);
					}
                },
                error:function(data){
                	document.getElementById('msgForWrongUsername').innerHTML="&nbsp;&nbsp;Username not Available.";
                	document.getElementById('signupbtn').disabled = true;
					usernameValidationFailed(divId);
                }
            });
			}else{
				document.getElementById('msgForWrongUsername').innerHTML="&nbsp;&nbsp;Username Can only Contain alphaNumeric characters and Underscores and length should be between 4 and 20 Characters.";
				usernameValidationFailed(divId);
				document.getElementById('signupbtn').disabled = true;
			}
		}
	}
	function usernameValidationSucess(divId){
		document.getElementById(divId).id = 'inputSuccess';
		var iconClass = document.getElementById("icon");
		var unameSuccess = document.getElementById("usernameSuccess");

		iconClass.classList.remove("glyphicon-remove");
		unameSuccess.classList.remove("has-error");

		iconClass.classList.add("glyphicon");
		iconClass.classList.add("glyphicon-ok");
		iconClass.classList.add("form-control-feedback");
		unameSuccess.classList.add("has-success");
		unameSuccess.classList.add("has-feedback");
	}
	function usernameValidationFailed(divId){
		document.getElementById(divId).id = 'inputSuccess';
		var iconClass = document.getElementById("icon");
		var unameSuccess = document.getElementById("usernameSuccess");

		iconClass.classList.remove("glyphicon-ok");
		unameSuccess.classList.remove("has-success");


		iconClass.classList.add("glyphicon");
		iconClass.classList.add("glyphicon-remove");
		iconClass.classList.add("form-control-feedback");
		unameSuccess.classList.add("has-error");
		unameSuccess.classList.add("has-feedback");
	}
	function typeAndLengthCheck(divisionId){
		 var lowerCaseLetters = /[a-z]/g;
		 var upperCaseLetters = /[A-Z]/g;
		  var numbers = /[0-9]/g;
		 var usernameValue = document.getElementById(divisionId).value;
		if(usernameValue.length<=15 && usernameValue.length>=4){
			if(usernameValue.match('^[A-Z0-9a-z.\s_-]+$')){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
</script>
<!--For Password Validation -->
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/PassWordValidation.js"></script>
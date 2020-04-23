<?php
include "Header.php";
?>
<section style="padding:100px 0px;">
	<!-- <p>&nbsp;</p>
	<p>&nbsp;</p> -->
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12"></div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="login-container">
					<center><h3 style="font-weight: bold;">Sign Up</h3></center>
				  <form class="form-horizontal">
				    <label for="usrname">Your Name</label>
				    <div class="form-group">
				      <div class="col-sm-12">
				        <input class="form-control" type="text" required>
				      </div>
				  	</div>

				    <label for="usrname">Email Address</label>
				    <div class="form-group">
				      <div class="col-sm-12">
				        <input class="form-control" type="email" required>
				      </div>
				  	</div>

				    <label for="usrname">Username</label>
					<div class="form-group" id="usernameSuccess">
				      <div class="col-sm-12">
				        <input class="form-control" id="focusedInput" type="text" onkeyup="usernameValidation(this.id,this.value)">
				        <span class="" id="icon"></span>
				      </div>
				      <span class="" id="msgForWrongUsername"></span>
				  	</div>

				    <label for="psw">Password</label>
				    <div class="form-group">
				      <div class="col-sm-12">
				        <input class="form-control" type="password" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
				      </div>
				  	</div>

				  	<label for="psw">Confirm Password</label>
				    <div class="form-group">
				      <div class="col-sm-12">
				        <input class="form-control" type="password" id="confirm_psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
				      </div>
				  	</div>
				    
				    <input type="submit" class="login-input login-submit" value="Submit">
				  </form>
				</div>

				<div id="message">
				  <h3>Password must contain the following:</h3>
				  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
				  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
				  <p id="number" class="invalid">A <b>number</b></p>
				  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	function usernameValidation(divId,value){
		if(value==''){
			usernameValidationFailed(divId);
		}else{
			if(typeAndLengthCheck(divId)){
				usernameValidationSucess(divId);
				document.getElementById('msgForWrongUsername').innerHTML="";
			}else{
				document.getElementById('msgForWrongUsername').innerHTML="&nbsp;&nbsp;Username Can only Contain alphaNumeric characters and Underscores and length should be less than 20 Characters.";
				usernameValidationFailed(divId);
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
		if(usernameValue.length<=15){
			if(usernameValue.match(lowerCaseLetters) || usernameValue.match(upperCaseLetters) || usernameValue.match(/_/g)|| usernameValue.match(numbers)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
</script>
<script>
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}
// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }
  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
<?php
include "Footer.php";
?>
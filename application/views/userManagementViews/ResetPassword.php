<section style="padding:100px 0px;" id="resetpass">
	<!-- <p>&nbsp;</p>
	<p>&nbsp;</p> -->
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12"></div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="login-container">
					<center><h3 style="font-weight: bold;">Reset Password</h3></center>
				  <form class="form-horizontal" action="<?php echo base_url().'userManagement/accessAccount/insertUserData'; ?>" method="POST">

				    <label for="usrname">Username</label>
					<div class="form-group" id="usernameSuccess">
				      <div class="col-sm-12">
				        <input class="form-control" type="text" id="usrname">
				        <span class="" id="icon"></span>
				      </div>
				  	</div>
				  	<input type="hidden" value="<?php echo $this->uri->segment(2); ?>" id="hiddenUsrname">

				    <label for="psw">New Password</label>
				    <div class="form-group">
				      <div class="col-sm-12">
				        <input class="form-control" type="password" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
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

				  	<label for="psw">Confirm New Password</label>
				    <div class="form-group">
				      <div class="col-sm-12">
				        <input class="form-control" type="password" id="confirm_psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="confirm-psw" required>
				      </div>
				  	</div>
				    
				    <input type="button" class="login-input login-submit" onclick="sendNewPass()" value="Submit" id="resetPassBtn">
				    <center style="background-color: #5cb85c;"><div class="lds-ellipsis" id="resetPassloader" style="display: none;"><div></div><div></div><div></div><div></div></div></center>
				  </form>
				</div>

			</div>
		</div>
	</div>
</section>
<script>
	document.getElementById('resetpass').style.minHeight=screen.height+'px';
	function sendNewPass(){
		var usrname = document.getElementById('usrname').value;
		var psw = document.getElementById('psw').value;
		var confirmPsw = document.getElementById('confirm_psw').value;
		if(usrname == '' || psw == '' || confirmPsw == ''){
			alert("No fields Can be empty.")
		}else{
			document.getElementById('resetPassBtn').style.display='none';
			document.getElementById('resetPassloader').style.display='block';
			setTimeout(sendNewPassData, 3000)
		}
	}
	function sendNewPassData(){
		var usrname = document.getElementById('usrname').value;
		var psw = document.getElementById('psw').value;
		var confirmPsw = document.getElementById('confirm_psw').value;
		var hiddenUsrname = document.getElementById('hiddenUsrname').value;
		$.ajax({
            type:'POST',
            url:'<?php echo base_url("userManagement/accessAccount/forgotPassLinkPasswordUpdate"); ?>',
            data:{'username':usrname,
            	'hiddenUname':hiddenUsrname,
		        'password':psw,
		    	'confirmPassword':confirmPsw},
            success:function(data){
            	alert(data);
            	document.getElementById('resetPassBtn').style.display='block';
            	document.getElementById('resetPassloader').style.display='none';
            	window.location.href="<?php echo base_url().'login'; ?>";
            },
            error:function(data){
            	
            }
        });
	}

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
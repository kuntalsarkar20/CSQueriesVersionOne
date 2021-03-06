<section style="padding:30px 0px;" id="login-section">
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<div class="sk-folding-cube" style="position:fixed;top:40%;left:50%;" id="login-loader">
	  <div class="sk-cube1 sk-cube"></div>
	  <div class="sk-cube2 sk-cube"></div>
	  <div class="sk-cube4 sk-cube"></div>
	  <div class="sk-cube3 sk-cube"></div>
	</div>
	<div class="container" style="display:none;" id="login-container">
		<?php
		  if($this->uri->segment(2)=="failed"){
		    echo '<div class="alert alert-danger alert-dismissible fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Verification Failed</strong> Please check Your Credentials and try again.
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
					<center><h3 style="font-weight: bold;">Log In</h3></center>
				  <form class="form-horizontal" method="post">

				    <label for="usrname">Username</label>
					<div class="form-group" id="usernameSuccess">
				      <div class="col-sm-12">
				        <input class="form-control" id="usrname" type="text" placeholder="Enter Your Username">
				      </div>
				  	</div>

				    <label for="psw">Password</label>
				    <div class="input-group">
				        <input class="form-control" type="password" id="psw" placeholder="Enter Your Password" required>
				        <span class="input-group-addon"><span style="color: green;" class="glyphicon glyphicon-eye-open" id="passIcon" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();"></span></span>
				  	</div>
				  	<p id="WrongPasswordMsg" style="color:red;"></p>
				  	<div class="form-group">
				      <div class="col-sm-12">
				        <button type="button" id="login_submit" class="login-input login-submit" onclick="showLoader()">Submit</button>
				        <center style="background-color: #5cb85c;"><div class="lds-ellipsis" id="loader" style="display: none;"><div></div><div></div><div></div><div></div></div></center>
				        <p style="float:right;"><a href="#" data-toggle="modal" data-target="#myModal">Forgot Username or Password?</a></p><br><br>
				        <center><p><a href="<?php echo base_url().'Signup';?>">Don't have an account? Sign up Here. It's free</a></p></center>
				      </div>
				  	</div>
				    
				  </form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		     	<div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          	<h3 style="text-align: center;font-family: arial;">Forgot Password ?</h3>
			          	<p>No Problem! Enter your email below and we will send you an email with a link. Follow that link to reset your password. <strong>Remember:</strong> The link will be valid for only next 30 minutes.</p><hr>
					    <form method="post">
						    <div class="form-group">
						      <label>Email:</label>
						      <input type="email" class="form-control" placeholder="Enter your Email" id='useremail' required>
						    </div>
						    <p id="msg"></p>
						    <button type="button" class="login-input login-submit" id="forgotPassBtn" onclick="showLoaderForgotPass()" style="float:right;">Send Reset Link</button>
						    <center style="background-color: #5cb85c;"><div class="lds-ellipsis" id="forgotPassloader" style="display: none;"><div></div><div></div><div></div><div></div></div></center>
						    <center><p><a href="<?php echo base_url().'Login';?>">Back to Login</a></p></center>
						</form>
			        </div>
		      	</div>
		    </div>
		</div>

<!-- Js for show hide password on hover -->
<script type="text/javascript">
function mouseoverPass(obj) {
  var obj = document.getElementById('psw');
  obj.type = "text";
  document.getElementById('passIcon').classList.remove('glyphicon-eye-open');
  document.getElementById('passIcon').classList.add('glyphicon-eye-close');
}
function mouseoutPass(obj) {
  var obj = document.getElementById('psw');
  obj.type = "password";
  document.getElementById('passIcon').classList.remove('glyphicon-eye-close');
  document.getElementById('passIcon').classList.add('glyphicon-eye-open');
}
</script>
<!--End Js for show hide password on hover -->

<script type="text/javascript">
	document.getElementById('login-section').style.minHeight=(screen.height-200)+"px";
	setTimeout(loginContainerLoader, 2000)
	function loginContainerLoader(){
		document.getElementById('login-container').style.display='block';
		document.getElementById('login-loader').style.display='none';
	}
	function showLoaderForgotPass(){
		var email = document.getElementById('useremail').value;
		if(email == ''){
			document.getElementById('msg').innerHTML = 'Please enter an email';
		}else{
		document.getElementById('msg').innerHTML = '';
		document.getElementById('forgotPassBtn').style.display='none';
		document.getElementById('forgotPassloader').style.display='block';
		setTimeout(replyForgotPass, 3000)
		}
	}
	function replyForgotPass(){
		var email = document.getElementById('useremail').value;
		$.ajax({
            type:'POST',
            url:'<?php echo base_url("userManagement/accessAccount/passwordResetLinkGenerate"); ?>',
            data:{'useremail':email},
            success:function(data){
            	document.getElementById('msg').innerHTML = data;
            	document.getElementById('forgotPassBtn').style.display='block';
            },
            error:function(data){
            	
            }
        });
		// document.getElementById('msg').innerHTML = 'Mail Sent SuccessFully';
		document.getElementById('forgotPassloader').style.display='none';
	}
	function showLoader(){
		var uvalue=document.getElementById('usrname').value;
		var pass=document.getElementById('psw').value;
		if(uvalue =='' || pass ==''){
			alert("Username or Password cannot be empty.")
		}else{
			document.getElementById('login_submit').style.display='none';
			document.getElementById('loader').style.display='block';
			setTimeout(validateData, 3000)
			
		}
	}
	function validateData(uvalue,pass){
		var uvalue=document.getElementById('usrname').value;
		var pass=document.getElementById('psw').value;
		$.ajax({
            type:'POST',
            url:'<?php echo base_url("userManagement/accessAccount/checkLoginDetails"); ?>',
            data:{'username':uvalue,
            'password':pass},
            success:function(data){
            	if(data=="InValid"){
     //        		document.getElementById('WrongPasswordMsg').innerHTML = "Username or Password doesn't match";
					// document.getElementById('login_submit').style.display='block';
					// document.getElementById('loader').style.display='none';
					window.location.href="<?php echo base_url();?>login";
				}else{	
					window.location.href="<?php echo base_url();?>"+data;
				}
            },
            error:function(data){
            	
            }
        });
	}
</script>
<section style="padding:80px 0px;" id="login-section">
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<div class="container">
		<?php
		  if($this->uri->segment(2)=="failed"){
		    echo '<div class="alert alert-danger alert-dismissible fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Verification Failed</strong> Please check Your Credentials and try again.
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
				        <input class="form-control" id="usrname" type="text">
				      </div>
				  	</div>

				    <label for="psw">Password</label>
				    <div class="form-group">
				      <div class="col-sm-12">
				        <input class="form-control" type="password" id="psw" required>
				      </div>
				  	</div>

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
						      <label for="name">Email:</label>
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
<script type="text/javascript">
	document.getElementById('login-section').style.minHeight=screen.height+"px";
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
					window.location.href="<?php echo base_url().'login/failed';?>";
				}else{	
					window.location.href="<?php echo base_url();?>"+data;
				}
            },
            error:function(data){
            	
            }
        });
	}
</script>
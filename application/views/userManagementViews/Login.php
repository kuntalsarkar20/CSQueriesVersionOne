<section style="padding:80px 0px;height:700px;">
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
				        <button type="button" id="login_submit" class="login-input login-submit" onclick="showLoader()">Submit</button><p style="float:right;"><a href="#">Forgot Username or Password?</a></p>
				        <center style="background-color: #5cb85c;"><div class="lds-ellipsis" id="loader" style="display: none;"><div></div><div></div><div></div><div></div></div></center>
				      </div>
				  	</div>
				    
				  </form>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
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
            	if(data=="Valid"){
					window.location.href="<?php echo base_url().'uploadcontent';?>";
				}else{
					window.location.href="<?php echo base_url().'login/failed';?>";
				}
            },
            error:function(data){
            	
            }
        });
	}
</script>
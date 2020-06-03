<?php
include "Header.php";
?>
<section style="padding:80px 0px;height:700px;">
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12"></div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="login-container">
					<center><h3 style="font-weight: bold;">Log In</h3></center>
				  <form class="form-horizontal">

				    <label for="usrname">Username</label>
					<div class="form-group" id="usernameSuccess">
				      <div class="col-sm-12">
				        <input class="form-control" id="focusedInput" type="text">
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
		document.getElementById('login_submit').style.display='none';
		document.getElementById('loader').style.display='block';
	}
</script>
<?php
include "Footer.php";
?>
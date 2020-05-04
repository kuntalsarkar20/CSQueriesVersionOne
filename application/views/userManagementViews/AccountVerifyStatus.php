<?php
if($status){
	$msg = '<h3>Thank You For taking part into Verification Process. Your account is Verified.<br>Start Writing</h3>
				<a href="'.base_url().$_SESSION['username'].'"><button type="button" class="btn btn-info">Proceed To Profile</button></a>';
}else{
	$msg = '<h3>Thank You For taking part into Verification Process. Your account is <strong>not Verified</strong> yet.<br>This link is experied.</h3>';
}
?>
<section id="forMinHeight">
	<div id="loader"></div>
	<div class="container" style="padding:80px 0px;" id="loadDiv" style="display:none;" class="animate-bottom">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<center><?php echo $msg; ?></center>
		</div>
	</div>
</section>
<script type="text/javascript">
	document.getElementById('forMinHeight').style.minHeight=screen.height+'px';
  myVar = setTimeout(showPage, 2000);

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("loadDiv").style.display = "block";
}
</script>
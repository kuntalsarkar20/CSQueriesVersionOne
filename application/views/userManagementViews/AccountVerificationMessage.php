<section id="forMinHeight">
	<div class="container" style="padding:80px 0px;">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<center><h3>An Email containing a verification link has been sent to your entered email address. Please click on that link to verify your account and proceed further.</h3>
				<a href="<?php echo base_url().'userManagement/accessAccount/resendVerificationLink' ?>">Resend Link</a></center>
				<blockquote><h4 style="font-weight: bold;">Steps:</h4>
					<ul>
						<li style="font-size: 15px;"> Go to Your Email Inbox -> Open the Email from us(The email should contain a <strong>verification link</strong>).</li>
						<li style="font-size: 15px;">click on that link and you will be redirected to our <strong>Verification</strong> Page.</li>
						<li style="font-size: 15px;">The verification page will contain information about your <strong>verification Status</strong>.</li>
					</ul>
					<h4 style="font-weight: bold;">Note:</h4>
				    <ul>
				    	<li style="font-size: 15px;">If you didn't receive the email <strong>wait for 10-15 minutes</strong>. If still the Email is not delivered then click on the <strong>resend link</strong>.</li>
				    	<li style="font-size: 15px;">After cliclking on <strong>Resend Link</strong> wait for same 10-15 minutes. Check your inbox & Spam folder too.</li>
				    	<li style="font-size: 15px;">If you receive more than one email containing the link(because of clicking resend link) use the <strong>Latest Link</strong> to verify.</li>
				    </ul>
				    <p>If still the problem appears feel free to click on <strong>Contact Us</strong>.</p>
				</blockquote>
		</div>
	</div>
</section>
<script type="text/javascript">
	document.getElementById('forMinHeight').style.minHeight=screen.height+'px';
</script>
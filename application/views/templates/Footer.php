<footer style="background-color: black;padding:20px 0px;color:white;">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12" style="padding:30px;">
						<div class="row" style="background-color:#0d0d0d;border-radius: 0px 0px 0px 0px;padding:20px 0px;">
					<div class="col-lg-4 col-md-4 col-sm-12" style="padding: 0px 0px;">
						<h4>&nbsp;&nbsp; <span class="glyphicon glyphicon-link"></span>Quick Links</h4>
						<ul style="list-style-type:none;">
							<li class="footer-links"><a href="<?php echo base_url(); ?>" ><span class="glyphicon glyphicon-home"></span> Home</a></li>
							<!-- <a href="" class="footer-links"><li><span class="glyphicon glyphicon-list-alt"></span> Category</li></a> -->
							<li class="footer-links"><a href="<?php echo base_url(); ?>Signup"><span class="glyphicon glyphicon-edit"></span> Sign Up</a></li>
							<li class="footer-links"><a href="<?php echo base_url(); ?>Login"><span class="glyphicon glyphicon-user"></span> Log In</a></li>
						</ul>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12" style="padding: 0px 0px;">
						<h4>&nbsp;<span class="glyphicon glyphicon-link"></span>Useful Links</h4>
						<ul style="list-style-type:none">
							<li class="footer-links"><a href="<?php echo base_url(); ?>Contactus"><span class="glyphicon glyphicon-envelope"></span> Contact Us</a></li>
							<li class="footer-links"><a href="<?php echo base_url(); ?>PrivacyPolicy"><span class="glyphicon glyphicon-lock"></span> Privacy Policy</a></li>
							<li class="footer-links"><a href="<?php echo base_url(); ?>TermsAndConditions"><span class="glyphicon glyphicon-warning-sign"></span> Terms And Condition</a></li>
						</ul>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
						<h4 style="color: white;"><span class="glyphicon glyphicon-globe"></span> About Us</h4>
						<p style="color: #337ab7;;">Computer science is the third most popular major amongst international students coming to the United States. Therfe are many reasons that computer science is so popular, including exceptional job security, uncommonly high starting salaries, and diverse job opportunities across industries.</p>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12">
						<p style="color: white;text-align: center;background-color: black;padding:10px;border-radius: 0px 0px 0px 0px;">&copy;<span >2020 All Rights Reserved.</span> &nbsp; &nbsp; <a href="<?php echo base_url(); ?>MeetTheDevelopers" class="footer-links">Meet The Developers</a></p>
					</div>
				</div>
			</div>
			</div>
			</div>
			<a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>
		</footer>
		<div id="cookieConsent">
			<div id="closeCookieConsent">x</div>
			This website is using cookies. <a href="#" target="_blank">More info</a>. <a class="cookieConsentOK">That's Fine</a>
		</div>
<script>
  AOS.init();
</script>
<!--Tags input plugin Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>	
<!-- End tags input -->
<script type="text/javascript">
      // ===== Scroll to Top ==== 
	$(window).scroll(function() {
	if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
	    $('#return-to-top').fadeIn(200);    // Fade in the arrow
	} else {
	    $('#return-to-top').fadeOut(200);   // Else fade out the arrow
	}
	});
	$('#return-to-top').click(function() {      // When arrow is clicked
	$('body,html').animate({
	    scrollTop : 0                       // Scroll to top of body
	}, 500);
	});
</script>
</body>
</html>
<section style="padding: 80px 0px;">
	<div class="container">
		<?php
		  if($this->session->flashdata('success') == "Success"){
		    echo '<div class="alert alert-success alert-dismissible fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Thank You</strong> for your valuable message. We will look forward it within 7 buisness days.
			  </div>';
		  }
		  ?>
		<div class="col-lg-2 col-md-2 col-sm-12">&nbsp;</div>
		<div class="col-lg-8 col-md-8 col-sm-12 categoryBoxes">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12" style="border: px solid black;padding: 0px 0px 0px 0px;">
					<img src="<?php echo base_url(); ?>assets/images/aboutPictures/contactUsPicture.png" alt="contactUsPicture" style="width: 100%;"> 
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12" style="padding: 50px 10px;">
					<h4 style="text-align: center;">Fill the Below Form & describe us your thought. We will love to hear it from you.</h4><br>
					<form class="form-horizontal" action="<?php base_url() ?>Welcome/SendContactUsData" method="post">
					      <div class="col-sm-offset-2 col-sm-8 input-group">
						      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						      <input type="text" class="form-control" placeholder="Enter Your Name" name="PersonName" required>
						   </div>
				    	    <br>
					    	<div class="col-sm-offset-2 col-sm-8 input-group">
						      <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
						      <input type="email" class="form-control" name="PersonEmail"  placeholder="Enter Your Email" required>
						   </div>
					    <br>
					      <div class="col-sm-offset-2 col-sm-8 input-group">
						      <span class="input-group-addon"><i class="glyphicon glyphicon-text-size"></i></span>
						      <textarea class="form-control" rows="5" id="comment" name="Thoughts" placeholder="Comments...." required></textarea>
						   </div>
					    	<br>
				    	<div class="col-sm-offset-2 col-sm-8 input-group" style="text-align: center;"><button type="submit" class="contactus-button" name="SendThought">Submit</button></div>
				 	 </form>
				 </div>
			</div>
		</div>
	</div>
</section>
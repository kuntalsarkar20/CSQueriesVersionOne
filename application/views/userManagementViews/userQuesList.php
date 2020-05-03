<section style="background-color:#f3f7f7;padding: 50px 0px 0px 0px;">
	<div class="col-lg-12 col-md-12 col-sm-12" style="padding: 0px 20px;background-color:white;border-bottom: 1px solid black;">
	<div class="container">
		<ul class="breadcrumb" style="background-color: white;padding:15px 0px 10px 0px;">
		    <li><a href="<?php echo base_url().$_SESSION['username']; ?>">Profile</a></li>
		    <li class="active">My Contents</li>        
		</ul>
	</div>
</div>
	<div class="container">
		<div class="row">
			<?php
				if($this->uri->segment(3)=="UploadSuccess"){
				  	echo '<div class="alert alert-success alert-dismissible fade in">
				  		<p>&nbsp;</p>
					    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					    <strong>Success!</strong> Your content is Uploaded Successfully.
					  </div>';
				  }
				foreach ($questionList as $row) {
					if($row['isPublished']==1){
						$publishStatus= '<span class="label label-info">Published</span>';
					}else{
						$publishStatus= '<span class="label label-warning">Not Published</span>';
					}
					echo '<div class="col-md-offset-1 col-lg-10 col-md-10 col-md-12" style="padding: 20px 10px;">
							<div class="profile-boxes" style="padding: 10px 10px;">
								<h1 class="profile-h1"><b><a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.$row['Question'].'</a> '.$publishStatus.'</b></h1>
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12">
										<h2 class="profile-h2">Topic: '.$row['CategoryName'].'</h2>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-12">
										<h2 class="profile-h2">Uploaded On: '.$row['CreatedAt'].'</h2>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-12">
										<h2 class="profile-h2">Last Updated: '.$row['UpdatedAt'].'</h2>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-12">
										<button class="publish-button" disabled>Edit</button>
									</div>
								</div> <hr>
							</div>
						</div>';
				}
			?>
			<!-- <div class="col-md-offset-1 col-lg-10 col-md-10 col-md-12" style="padding: 20px 10px;">
				<div class="profile-boxes" style="padding: 10px 10px;">
					<h1 class="profile-h1"><b>Qus: Explain the concepts of a Primary key and Foreign Key.</b></h1>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<h2 class="profile-h2">Topic: DBMS</h2>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12">
							<h2 class="profile-h2">Uploaded On: 26.3.20</h2>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12">
							<h2 class="profile-h2">Last Updated: 15.4.20</h2>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12">
							<button class="publish-button">Publish</button>
						</div>
					</div> <hr>
				</div>
			</div> -->
			<br><br>	
	</div> 
</div>
</section>
<?php
foreach ($question as $row) {
	$contentName= $row['Question'];
	$contentDesc= $row['Answer'];
	$creationTime= $row['CreatedAt'];
	$Author= $row['UserName'];
	if($row['isPublished']==0 && !isset($_SESSION['username'])){		//if the question is private and there is session 																then check for if the author and the session username same.
		$contentDesc = "This Question is <b>Private</b> by the Uploader. You can't view Until the user makes it <b>Public</b>.";
	}elseif($row['isPublished']==0 && isset($_SESSION['username'])){
		if($Author != $_SESSION['username']){	//if the author & session username not same then content can't be shown
			$contentDesc = "This Question is <b>Private</b> by the Uploader. You can't view Until the user makes it <b>Public</b>.";
		}
	}
}
?>;
<section style="background-color: #e9eeef91;padding-top: 70px 0px 0px 0px;" id="forMinHeight">
<div class="container">
	<div class="row categoryBoxes">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<br>
			<br>
		<ul class="breadcrumb" style="/*background-color: transparent;*/">
			  <li><a href="<?php echo base_url(); ?>">CSQueries</a></li>
			  <li ><a href="<?php echo base_url().'Category/'.$this->uri->segment(2); ?>"><?php echo $this->uri->segment(2); ?></a></li>
			  <li class="active"></li>
		</ul>
	</div>
		<div class="col-lg-8 col-md-8 col-sm-12" style="padding: 0px 20px;">
			<div class="row">
				<div class="col-sm-12" style="padding:1px 13px;"><h3>&nbsp;&nbsp;<?php echo $contentName; ?></h3>
					<span class="datestyle">-Uploaded By <b><a href="<?php echo base_url().$Author; ?>">@<?php echo $Author; ?></a></b> On <?php echo $creationTime; ?>&nbsp;&nbsp;&nbsp;</span><hr></div>
				<div class="col-sm-12" style="padding: 0px 10px;">
					<div class="col-sm-12 questionstyle"><?php echo $contentDesc; ?> </div>
				</div>
				<p>&nbsp;</p>
				<div class="col-sm-12 allQuestionButtonPlace"><p class="datestyle">Last Updated: Never&nbsp;&nbsp;&nbsp;</p></div>
				<p>&nbsp;</p>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12" style="padding: 0px 20px;">
			<div class="row">
				<div class="col-sm-12" style="padding:1px 10px;"><h3>&nbsp;&nbsp;Related Questions</h3>
				<hr></div>
				<div class="col-sm-12" style="padding: 0px;">
					<div class="col-sm-12" style="padding: 0px;">
						<?php 
					        foreach ($RelatedQuestionFromTopic as $row) {
								echo '<div style="padding:10px 10px;"><b><a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.$row['Question'].'</a></b></div>';
							}
						?>
					</div>
				</div>
				<p>&nbsp;</p> 	
			</div>
		</div>
	</div>
</div>
</section>
<script type="text/javascript">
	document.getElementById('forMinHeight').style.minHeight=screen.height+'px';
</script>

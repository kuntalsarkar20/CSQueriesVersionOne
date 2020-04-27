<?php
foreach ($question as $row) {
	$contentName= $row['Question'];
	$contentDesc= $row['Answer'];
	$creationTime= $row['CreatedAt'];
	$Author= $row['UserName'];
}
?>
<section style="background-color: #e9eeef91;">
<div class="container" style="padding-top: 40px;">
	<div class="row">
		<div class="col-md-8 col-lg-8 col-sm-12" style="padding: 30px;">
			<div class="row categoryBoxes">
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
		<div class="col-md-4 col-lg-4 col-sm-12" style="padding: 30px;">
			<div class="row categoryBoxes">
				<div class="col-sm-12" style="padding:1px;"><h3>&nbsp;&nbsp;Related Questions</h3>
				<div class="col-sm-12" style="padding: 0px 10px;">
					<div class="col-sm-12 questionstyle"><?php 
				        foreach ($RelatedQuestionFromTopic as $row) {
							echo '<div style="padding:10px 20px;"><b><a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.$row['Question'].'</a></b></div>';
						}
					?></div>
				</div>
				<p>&nbsp;</p>
			</div>
		</div>
	</div>
</div>
</section>

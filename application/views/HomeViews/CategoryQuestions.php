<?php
foreach($categoryQuestions as $row){
	$categoryName = $row['CategoryName'];
	$categoryDesc = $row['CategoryDescription'];
}
$links='';
if($countQuestionNumber>10){
	$numberofPage = $countQuestionNumber/10; 	//keeping 10 questions in 1 page
	// $lastPage = $countQuestionNumber%10;
	$startRange = 0;
	for($iteration=1;$iteration<$numberofPage;$iteration++){
		$links = $links.'<li><a href="'.base_url().'Category/'.$categoryName.'/'.$startRange.'">'.$iteration.'</a></li>';
		$startRange = $startRange +10;
	}
	$links = $links.'<li><a href="'.base_url().'Category/'.$categoryName.'/'.$startRange.'">'.$iteration.'</a></li>';
}else{
	$links = '';
}
?>
<section style="padding:80px 0px;background-color: #e9eeef91;">
	<div class="container">	
		<div class="col-lg-1 col-md-1 col-sm-1">
			&nbsp;
		</div>
		<div class="col-lg-10 col-md-10 col-sm-12  categoryBoxes">
			<ul class="breadcrumb" style="background-color: transparent;">
			  <li><a href="<?php echo base_url(); ?>">CSQueries</a></li>
			  <li class="active"><?php echo $categoryName; ?></li>
			</ul>
			<h3><?php echo $categoryName; ?></h3>
			<p><?php echo $categoryDesc; ?></p>
			<hr style="border:2px solid green;">
			<ul class="breadcrumb">
			<li><p style="color:grey;font-size: 14px;">Showing (<?php echo $startLimit.'-'.($startLimit+9); ?>) of about <?php echo $countQuestionNumber; ?> results.(<?php echo round($TimeTaken,6); ?> Seconds)</p></li>
			</ul>	<!--  Each page showing 10 records. so added 9 with start value-->
			<hr>			
			<div class="row">
				<?php
					foreach($categoryQuestions as $row){
						echo '<div class="col-lg-12 col-md-12 col-sm-12">
								<h4><a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.$row['Question'].'</a><span class="datestyle" style="font-size: 15px;"> &nbsp;'.date('d-M-Y',strtotime($row['CreatedAt'])).'</span></h4>
								<p style="color:grey;">Uploaded By: <a href="'.base_url().$row['UserName'].'">@'.$row['UserName'].'</a> <span class="datestyle" style="font-size: 15px;"><span class="glyphicon glyphicon-eye-open"></span> '.$row['Views'].'</span></p>
								<hr>
							</div>';
					}
				?>
				<!-- <div class="col-lg-12 col-md-12 col-sm-12">
					<h4>What is Dbms?<span class="datestyle" style="font-size: 15px;"> &nbsp;17th April,2020</span></h4>
					<p style="color:grey;">Uploaded By: KuntalSarkar <span class="datestyle" style="font-size: 15px;">Views: 10</span></p>
					<hr>
				</div> -->
			</div>
			<center><ul class="pagination pagination-lg"><?php echo $links; ?>
			    <!-- <li><a href="#">1</a></li>
			    <li><a href="#">2</a></li>
			    <li><a href="#">3</a></li>
			    <li><a href="#">4</a></li>
			    <li><a href="#">5</a></li> -->
			</ul></center>
		</div>
	</div>
</section>